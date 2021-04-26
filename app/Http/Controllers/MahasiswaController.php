<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('coba')->only('daftarMahasiswa');
    }
    public function index()
    {
        return view('mahasiswa.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/mahasiswas');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
    public function mahasiswa()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index',['mahasiswas' => $mahasiswas]);
    }
    public function create()
    {
        return view('mahasiswa.create');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim'             => 'required|size:8|unique:mahasiswas,nim',
            'nama'            => 'required|min:3|max:50',
            'jenis_kelamin'   => 'required|in:P,L',
            'jurusan'         => 'required',
            'berkas'          => 'required|file|image|max:5000',
            'alamat'          => '',
            ]);
            // $mahasiswa = new Mahasiswa();
            // $mahasiswa->nim = $validateData['nim'];
            // $mahasiswa->nama = $validateData['nama'];
            // $mahasiswa->jenis_kelamin = $validateData['jenis_kelamin'];
            // $mahasiswa->jurusan = $validateData['jurusan'];
            // $mahasiswa->alamat = $validateData['alamat'];
            // $mahasiswa->save();
            $extFile = $request->berkas->getClientOriginalExtension();
            $namFile = 'mahasiswa-'.$validateData['nim'].".".$extFile;
            $path = $request->berkas->move('image',$namFile);

            $mahasiswa = new Mahasiswa();
            $mahasiswa->nim = $validateData['nim'];
            $mahasiswa->nama = $validateData['nama'];
            $mahasiswa->jenis_kelamin = $validateData['jenis_kelamin'];
            $mahasiswa->jurusan = $validateData['jurusan'];
            $mahasiswa->berkas = $path;
            $mahasiswa->alamat = $validateData['alamat'];
            $mahasiswa->save();

            //Mahasiswa::create($validateData);
            //$request->session()->flash('pesan',"Penambahan data {$validateData['nama']} berhasil");
            return redirect()->route('mahasiswas.mahasiswa')->with('pesan',"Penambahan data {$validateData['nama']} berhasil");
    }
    public function show(Mahasiswa $mahasiswa)
    {
        //$result = Mahasiswa::findOrFail($mahasiswa);
        return view('mahasiswa.show',['mahasiswa' => $mahasiswa]);
    }
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit',['mahasiswa' => $mahasiswa]);
    }
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validateData = $request->validate([
            'nim'             => 'required|size:8|unique:mahasiswas,nim,'.$mahasiswa->id,
            'nama'            => 'required|min:3|max:50',
            'jenis_kelamin'   => 'required|in:P,L',
            'jurusan'         => 'required',
            'alamat'          => '',
            ]);

            Mahasiswa::where('id',$mahasiswa->id)->update($validateData);
            return redirect()->route('mahasiswas.show',['mahasiswa'=>$mahasiswa->id])->with('pesan',"Update data {$validateData['nama']} berhasil");
    }
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')->with('pesan',"Hapus data $mahasiswa->nama berhasil");
    }
    public function fileUpload(){
        return view('file-upload');
    }
    public function prosesFileUpload(Request $request){
        $request->validate([
            'berkas' => 'required|file|image|max:5000',
        ]);
        $extFile = $request->berkas->getClientOriginalExtension();
        $namaFile = 'lisa-'.time().".".$extFile;
        $path = $request->berkas->move('image', $namaFile);
        echo "Varibel path berisi :  $path <br>";

        $pathBaru = asset('storage/'.$namaFile);
        echo "Proses file upload berhasil, File berada di : <a href='$pathBaru'>$pathBaru";

        // $path = $request->berkas->storeAs('public', $namaFile);
        // $pathBaru = asset('storage/'.$namaFile);
        // echo "Proses file upload berhasil, File berada di : <a href='$pathBaru'>$pathBaru";

        // $namaFile = $request->berkas->getClientOriginalName();
        // $path = $request->berkas->storeAs('uploads', $namaFile);
        // echo "Proses file upload berhasil, File berada di : $path";

        // $path = $request->berkas->store('uploads');
        // echo "Proses file upload berhasil, File berada di : $path";

        //echo $request->berkas->getClientOriginalName()."Lolos validasi";

        // if ($request->hasFile('berkas')) {
        //     echo "path(): ".$request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): ".$request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): ".
        //     $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): ".$request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): ".
        //     $request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): ".$request->berkas->getSize();
        // } else {
        //     echo "Tidak ada berkas yang diupload";
        // }
        //dump($request->berkas);
        //return "Pemrosesan file upload disini";
    }
    public function daftarMahasiswa()
    {
        return 'Form Pendaftaran mahasiswa';
    }
    public function tabelMahasiswa()
    {
        return 'Tabel Data Mahasiswa';
    }
    public function blogMahasiswa()
    {
        return 'Halaman Blog Mahasiswa';
    }
    public function session()
    {
        echo '<ul>';
        echo '<li><a href=/buat-session>Buat Session</a></li>';
        echo '<li><a href=/akses-session>Akses Session</a></li>';
        echo '<li><a href=/hapus-session>Hapus Session</a></li>';
        echo '<li><a href=/flash-session>Flash Session</a></li>';
        echo '</ul>';
    }
    public function buatSession()
    {
        session(['hakAkses' => 'admin','nama' => 'Anto']);
        return "Session sudah di buat";
    }
    public function aksesSession(Request $request)
    {
        $isiSession = $request->session()->get('kota','Jakarta');
        echo "Isi session adalah $isiSession";

        if (session()->has('hakAkses')) {
            echo "Session 'hakAkses' terdektesi: ". session('hakAkses');
        }

        //menggunakan helper function
        // echo session('hakAkses');
        // echo session('nama');
        // echo '<hr>';
        // Dari Request Object
        // echo $request->session()->get('hakAkses');
        // echo $request->session()->get('nama');
        // echo '<hr>';
        // Menggunakan facade session
        // echo Session::get('hakAkses');
        // echo Session::get('nama');
    }

    public function hapusSession(Request $request)
    {
        //menghapus 1 session menggunakan helper function
        //session()->forget('hakAkses');
        //menghapus 1 session menggunakan request object
        //$request->session()->forget('hakAkses');
        //menghapus 1 session menggunakan facade function
        //Session::forget('hakAkses');
        //echo "Session hakAkses sudah di hapus";

        //menghapus 1 session menggunakan helper function
        session()->flush();
        //menghapus 1 session menggunakan request object
        $request->session()->flush();
        //menghapus 1 session menggunakan facade function
        Session::flush();
        echo "Session hakAkses sudah di hapus";
    }
    public function flashSession(Request $request)
    {
        //membuat 1 flash session menggunakan helper function
        session()->flash('hakAkses','admin');
        //membuat 1 flash session menggunakan request object
        $request->session()->flush('hakAkses','admin');
        //membuat 1 flash session menggunakan facade function
        Session::flash('hakAkses','admin');
        echo "Flash session hakAkses sudah di buat";
    }
}

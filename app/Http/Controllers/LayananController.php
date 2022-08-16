<?php

namespace App\Http\Controllers;

use App\AttachementRekomendasi;
use App\Permohonan;
use App\Instansi;
use App\PoinRekomendasi;
use App\PointRekomendasi;
use App\StatusPermohonan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use PDF;
use PhpParser\Node\Expr\New_;

class LayananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.layanan.index',[
                'title'=>'LAYANAN',
            ]);
    }

    public function form_nama_sistem()
    {
        return view('pages.layanan.form_nama_sistem',[
                'title'=>'LAYANAN',
                
            ]);
    }

    public function makedraft(Request $request){

        $input = $request->all();
        $permohonan = New Permohonan;
        $permohonan->nama_sistem_eletronik = $input['nama_sistem'];
        $permohonan->user_id =  Auth::user()->id;
        $permohonan->tipe = 'Rekomendasi';
        $permohonan->save();
        return redirect()->route('tracking')->with('message', 'successfully!');
        
    }

    public function form_permohonan($id){
        
        $iduser = Auth::user()->id;
        $user = User::select('role')->where('id',$iduser)->get()->first();
        $permohonan = Permohonan::find($id);

        $filettd = '';
        if($permohonan->ttd == 'y'){

            $file = AttachementRekomendasi::where('rekomendasi_id',$id)
                                ->where('judul','Form Rekomendasi')
                                ->where('deskripsi','Form Rekomendasi Telah ditandatangani')
                                ->first();
            $filettd = $file->filename;
        }
        

        if($permohonan->tipe==='Rekomendasi'){
            return view('pages.layanan.form_rekomendasi',[
                'title'=>'FORMULIR PERMOHOANAN REKOMENDASI',
                'permohonan_id' => $id,
                'data'          => $permohonan,
                'instansis'     => Instansi::all(),
                'attachment'    => AttachementRekomendasi::where('rekomendasi_id',$id)->get(),
                'role'          => $user->role,
                'file_ttd'      => $filettd,
                'statusPermohonan'  =>$permohonan->status,
                
            ]);
            
        } else {
            dd($permohonan->tipe);
        }

    }

    public function simpan_rekomendasi(Request $request){

        $input = $request->all();
        $data = [
            "no_surat" => $input['nosurat'],
            "estimasi_biaya" => $input['estimasibiaya'],
            "instansi" => $input['instansi'],
            "nama_kepala_dinas" => $input['namakepaladinas'],
            "nip_kepala_dinas" =>$input['nipkepaladinas'],
            "deskripsi_investasi" => $input['deskripsiinvestasi'],
            "kondisi_sekarang" => $input['kondisisekarang'],
            "kondisi_diharapkan" => $input['kondisidiharapkan'],
            "manfaat_aplikasi" => $input['manfaataplikasi'],
            "fitur_aplikasi" => $input['fituraplikasi'],
            "kebutuhan_data" => $input['kebutuhandata'],
            "kontak_pic" => $input['kontakpic'],
            "bidang" => $input['bidang'],
            "ruang_lingkup_aplikasi" => $input['ruanglingkupaplikasi'],
            "status"    => 'Submitted'
        ];

        $StatusPermohonan = New StatusPermohonan;
        $StatusPermohonan->secondary_id        = $input['rekomendasi_id'];
        $StatusPermohonan->status_permohonan   = '';
        $StatusPermohonan->nosurat             = '';
        $StatusPermohonan->deskripsi           = '';
        $StatusPermohonan->save();
        
        Permohonan::where('id',$input['rekomendasi_id'])->update($data);
        return redirect()->route('form_permohonan',$input['rekomendasi_id'])->with('message', 'successfully!');

    }

    public function simpan_attachment(Request $request){
        $input  = $request->all();
        $file   = $request->file('file');

        $newfilename = $input['rekomendasi_id'].'_'.$input['judul'].'.'.$file->getClientOriginalExtension();

        $att = New AttachementRekomendasi;
        $att->judul             = $input['judul'];
        $att->deskripsi         = $input['deskripsi'];
        $att->filename          = $newfilename;
        $att->rekomendasi_id    = $input['rekomendasi_id'];
        $att->save();

        if($input['deskripsi']=='Form Rekomendasi Telah ditandatangani'){
            Permohonan::where('id',$input['rekomendasi_id'])->update(['ttd'=>'y']);
        }

        $file->move("storage/app/public/uploads",$newfilename);
        return redirect()->route('form_permohonan',$input['rekomendasi_id'])->with('message', 'successfully!');
      
    }

    public function download($filename)
    {   
        $pathToFile = 'storage/app/public/uploads/'.$filename;
        return response()->download($pathToFile);
    }

    public function deletefile(Request $request)
    {   
        $input = $request->all();

        $path = 'storage/app/public/uploads/'.$input['filename'];
        $isExists = file_exists($path);
        AttachementRekomendasi::where('filename',$input['filename'])->delete();
        if($isExists){
            unlink($path);
        }
        return redirect()->route('form_permohonan',$input['rekomendasi_id'])->with('message', 'successfully!');
        
    }

    public function status_permohonan($id){

        $iduser = Auth::user()->id;
        $user = User::select('role')->where('id',$iduser)->get()->first();
        $permohonan = Permohonan::find($id);
        if($permohonan->tipe==='Rekomendasi'){
                return view('pages.layanan.status_permohonan',[
                    'title'=>'STATUS PERMOHONAN REKOMENDASI',
                    'permohonan_id' => $id,
                    'role'          => $user->role,
                    'ttd'           => $permohonan->ttd,
                    'statusPermohonan' => $permohonan->status,
                    'dataStatus'    => StatusPermohonan::where('secondary_id',$id)->first(),
                    'points'        => PoinRekomendasi::where('permohonan_id',$id)->get(),
                    
                ]);
        } else {
            dd($permohonan->tipe);
        }
    }

    public function print($id){
       
            $pdf = PDF::loadView('pages.layanan.print');
            return $pdf->download('rekomendasi.pdf');
          
    }

    public function simpan_status(Request $request){
        
        $input = $request->all();
        $data = [
            'secondary_id'          => $input['secondary_id'],
            'status_permohonan'     => $input['status_permohonan'],
            'nosurat'               => $input['nosurat'],
            'deskripsi'             => $input['deskripsi'],
        ];
        StatusPermohonan::where('secondary_id',$input['secondary_id'])->update($data);

        if( $input['status_permohonan']=='Disetujui' || $input['status_permohonan']=='Disetujui dengan catatan' ){
            $statusPermohonan = 'Approved';
        } else {
            $statusPermohonan = 'Rejected';
        }
        Permohonan::where('id',$input['secondary_id'])->update(['status'=>$statusPermohonan]);
        return redirect()->route('status_permohonan',$input['secondary_id'])->with('message', 'successfully!');
    }   
    public function simpan_poin_rekomendasi(Request $request){
        $input = $request->all();
        $poinRek = New PoinRekomendasi;
        $poinRek->poin_rekomendasi = $input['poin_rekomendasi'];
        $poinRek->permohonan_id = $input['permohonan_id'];
        $poinRek->save();
        return redirect()->route('status_permohonan',$input['permohonan_id'])->with('message', 'successfully!');
    }

    public function deletepoin(Request $request)
    {
        $input = $request->all();
        $idPoint = $input['id'];
        PoinRekomendasi::where('id',$idPoint)->delete();
        return redirect()->route('status_permohonan',$input['permohonan_id'])->with('message', 'successfully!');
    }
    
  

}
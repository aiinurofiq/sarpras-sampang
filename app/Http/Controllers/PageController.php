<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wilayah;
use App\Berita;
use App\Komponen;
class PageController extends Controller
{
    public function index(Request $request){
        $query = $request->route('query');
        $query = str_replace('-', '_', $query);
        return $this->{$query}($request);
    }
    public function progres($request){
        $query = $request->route('query');
        $kode_wilayah = $request->route('kode_wilayah');
        $id_level_wilayah = $request->route('id_level_wilayah');
        $nama_wilayah = Wilayah::find($kode_wilayah);
        return view('page.'.$query)->with(['id_level_wilayah' => $id_level_wilayah, 'kode_wilayah' => $kode_wilayah, 'nama_wilayah' => $nama_wilayah]);
    }
    public function home($request){
        $query = $request->route('query');
        return view('page.'.$query)->with(['id_level_wilayah' => 1]);
    }
    public function berita($request){
        $query = $request->route('query');
        $berita = Berita::limit(10)->orderBy('created_at', 'DESC')->get();
        return view('page.'.$query)->with(['berita' => $berita]);
    }
    public function detil_berita($slug){
        $berita = Berita::whereSlug($slug)->first();
        return view('page.detil_berita')->with(['post' => $berita]);
    }
    public function rapor_mutu($request){
        $query = $request->route('query');
        $params = [
            'komponen' => Komponen::with('all_nilai_komponen', 'aspek.all_nilai_aspek')->get(),
        ];
        return view('page.'.$query)->with($params);
    }
    public function get_chart()
    {
        $all_komponen = Komponen::with('all_nilai_komponen')->get();
        foreach($all_komponen as $komponen){
            $nilai_komponen[] = number_format($komponen->all_nilai_komponen->avg('total_nilai'),2);
            $nama_komponen[] = $komponen->nama;
        }
        return response()->json(['nama_komponen' => $nama_komponen, 'nilai_komponen' => $nilai_komponen]);
    }
    public function galeri($request){
        $query = $request->route('query');
        return view('page.'.$query)->with(['id_level_wilayah' => 1]);
    }
    public function faq($request){
        $query = $request->route('query');
        return view('page.'.$query)->with(['id_level_wilayah' => 1]);
    }
    public function progres_data($request){
        if(request()->id_level_wilayah){
            $id_level_wilayah = request()->id_level_wilayah;
            if(request()->id_level_wilayah == 2) {
                $wilayah = '_kabupaten';
            } else {
                $wilayah = '_kecamatan';
            }
            
        } else{
            $wilayah = '_provinsi';
            $id_level_wilayah = 1;
        }
        $with = 'sekolah'.$wilayah;
        $with_coe = 'sekolah_coe'.$wilayah;
        $with_instrumen = 'sekolah_instrumen'.$wilayah;
        $with_pakta_integritas = 'sekolah_pakta_integritas'.$wilayah;
        $with_rapor_mutu = 'sekolah_rapor_mutu'.$wilayah;
        $with_waiting = 'sekolah_waiting'.$wilayah;
        $with_proses = 'sekolah_proses'.$wilayah;
        $with_terima = 'sekolah_terima'.$wilayah;
        $with_tolak = 'sekolah_tolak'.$wilayah;
        $data_count = 'sekolah'.$wilayah.'_count';
        $data_count_coe = 'sekolah_coe'.$wilayah.'_count';
        $nama_wilayah = Wilayah::find(request()->kode_wilayah);
        $all_wilayah = Wilayah::whereHas('negara', function($query){
            $query->where('negara_id', 'ID');
        })->where(function($query) use ($id_level_wilayah){
            $query->where('id_level_wilayah', $id_level_wilayah);
            if(request()->kode_wilayah){
                $query->where('mst_kode_wilayah', request()->kode_wilayah);
            }
        })->withCount([$with, $with_coe, $with_instrumen, $with_rapor_mutu, $with_pakta_integritas, $with_waiting, $with_proses, $with_terima, $with_tolak])->orderBy('kode_wilayah')->get();
        /*
        })->withCount([$with, $with_coe])->with([$with => function($query){
            $query->with(['sekolah_sasaran' => function($query){
                $query->with(['terkirim', 'pakta_integritas', 'waiting', 'proses', 'terima', 'tolak']);
            }]);
            $query->with(['user.nilai_akhir']);
            $query->withCount('nilai_instrumen');
        }])->orderBy('kode_wilayah')->get();
        */
        //dd($all_wilayah);
        $params = [
            'id_level_wilayah' => $id_level_wilayah,
            'all_wilayah' => $all_wilayah,
            'count_smk' => $with.'_count',
            'count_smk_coe' => $with_coe.'_count',
            'count_instrumen' => $with_instrumen.'_count',
            'count_rapor_mutu' => $with_rapor_mutu.'_count',
            'count_pakta_integritas' => $with_pakta_integritas.'_count',
            'count_waiting' => $with_waiting.'_count',
            'count_proses' => $with_proses.'_count',
            'count_terima' => $with_terima.'_count',
            'count_tolak' => $with_tolak.'_count',
            'with' => $with,
            'next_level_wilayah' => $id_level_wilayah + 1,
            'nama_wilayah' => $nama_wilayah,
        ];
        //dd($params);
        return view('page.progres-wilayah')->with($params);
    }
    public function get_rapor_mutu($komponen_id){
        $params = [
            'komponen_id' => $komponen_id,
            'test' => 'test',
        ];
        return view('page.rapor_mutu')->with($params);
    }
}

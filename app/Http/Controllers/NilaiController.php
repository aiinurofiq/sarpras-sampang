<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aspek;
use App\Komponen;
use App\Nilai_aspek;
use App\Nilai_komponen;
use App\Nilai_akhir;
class NilaiController extends Controller
{
    public function hitung_nilai(Request $request){
        $callback = function($query) use ($request){
            $query->where('user_id', $request->user_id);
        };
        $all_komponen = Komponen::with(['aspek.jawaban' => $callback,'aspek.instrumen' => function($query) use ($callback){
            $query->whereNull('ins_id');
        }])->get();
        $total_nilai = 0;
        foreach($all_komponen as $komponen){
            $all_nilai_aspek = 0;
            $instrumen_id = $komponen->aspek->map(function($aspek) use ($request, &$all_nilai_aspek){
                $instrumen_id = $aspek->jawaban()->where('user_id', $request->user_id)->select('instrumen_id')->get()->keyBy('instrumen_id')->keys()->all();
                $nilai = $aspek->jawaban()->where('user_id', $request->user_id)->sum('nilai');
                if($nilai){
                    $skor = $aspek->instrumen()->whereIn('instrumen_id', $instrumen_id)->sum('skor');
                    //$nilai_aspek = ($nilai) ? ($nilai * $aspek->bobot) / $skor : 0;
                    //=($nilai*$aspek->bobot)/$skor*100/$aspek->bobot
                    //$nilai_aspek = ($nilai*$aspek->bobot)/$skor*100/$aspek->bobot;
                    $nilai_aspek_dibobot = $nilai * $aspek->bobot / $skor;
                    $nilai_aspek = $nilai * 100 / $skor;
                    $nilai_aspek = number_format($nilai_aspek,2,'.','.');
                    $predikat_aspek = '-';
                    if($nilai_aspek < 21){
                        $predikat_aspek = 'Sangat Kurang';
                    } elseif($nilai_aspek < 41){
                        $predikat_aspek = 'Kurang';
                    } elseif($nilai_aspek < 61){
                        $predikat_aspek = 'Cukup';
                    } elseif($nilai_aspek < 81){
                        $predikat_aspek = 'Baik';
                    } elseif($nilai_aspek >= 81){
                        $predikat_aspek = 'Sangat Baik';
                    }
                    Nilai_aspek::updateOrCreate(
                        [
                            'user_id' => $request->user_id,
                            'aspek_id' => $aspek->id,
                            'komponen_id' => $aspek->komponen_id,
                        ],
                        [
                            'nilai' => $nilai_aspek_dibobot,
                            'total_nilai' => $nilai_aspek,
                            'predikat' => $predikat_aspek,
                        ]
                    );
                }
            });
            $all_nilai_aspek = Nilai_aspek::where('user_id', $request->user_id)->where('komponen_id', $komponen->id)->sum('nilai');
            if($all_nilai_aspek){
                $all_bobot = $komponen->aspek()->sum('bobot');
                $nilai_komponen = ($all_nilai_aspek*100)/$all_bobot;
                $nilai_komponen = number_format($nilai_komponen,2,'.','.');
                $predikat_komponen = '-';
                if($nilai_komponen < 21){
                    $predikat_komponen = 'Sangat Kurang';
                } elseif($nilai_komponen < 41){
                    $predikat_komponen = 'Kurang';
                } elseif($nilai_komponen < 61){
                    $predikat_komponen = 'Cukup';
                } elseif($nilai_komponen < 81){
                    $predikat_komponen = 'Baik';
                } elseif($nilai_komponen >= 81){
                    $predikat_komponen = 'Sangat Baik';
                }
                Nilai_komponen::updateOrCreate(
                    [
                        'user_id' => $request->user_id,
                        'komponen_id' => $komponen->id,
                    ],
                    [
                        'nilai' => $nilai_komponen,//$all_nilai_aspek,
                        'total_nilai' => $nilai_komponen,
                        'predikat' => $predikat_komponen,
                    ]
                );
            }
            $total_nilai += $nilai_komponen;
        }
        $predikat_akhir = '-';
        if($total_nilai < 21){
            $predikat_akhir = 'Sangat Kurang';
        } elseif($total_nilai < 41){
            $predikat_akhir = 'Kurang';
        } elseif($total_nilai < 61){
            $predikat_akhir = 'Cukup';
        } elseif($total_nilai < 81){
            $predikat_akhir = 'Baik';
        } elseif($total_nilai >= 81){
            $predikat_akhir = 'Sangat Baik';
        }
        Nilai_akhir::updateOrCreate(
            [
                'user_id' => $request->user_id,
            ],
            [
                'nilai' => $total_nilai,
                'predikat' => $predikat_akhir,
            ]
        );
        return response()->json(['status' => 'success', 'data' => '']);
    }
}

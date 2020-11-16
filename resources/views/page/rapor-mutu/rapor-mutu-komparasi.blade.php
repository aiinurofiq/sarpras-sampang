@extends('layouts.app_rapor')
@section('title', 'Rapor Mutu SMK')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Filter Provinsi</label>
                                <select class="form-control select2" id="provinsi_id" style="width: 100%;">
                                    <option value="">Semua Provinsi</option>
                                    @foreach($all_wilayah as $wilayah)
                                    <option value="{{$wilayah->kode_wilayah}}">{{$wilayah->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Filter Kabupaten/Kota</label>
                                <select class="form-control select2" id="kabupaten_id" style="width: 100%;">
                                    <option value="">Semua Kab/Kota</option>
                                </select>
                            </div>
                        </div>
                        <!--div class="col-md-3">
                            <div class="form-group">
                                <label>Filter Kecamatan</label>
                                <select class="form-control select2" id="kecamatan_id" style="width: 100%;">
                                    <option value="">Semua Kecamatan</option>
                                </select>
                            </div>
                        </div-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Filter Sekolah</label>
                                <select class="form-control select2" id="sekolah_id" style="width: 100%;">
                                    <option value="">Semua Sekolah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <canvas id="rapor_mutu_verifikasi" style="height: 250px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="card-title">Rapor Mutu Sekolah</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($komponen_kinerja as $kinerja)
                    <div class="col-lg-4 col-md-12">
                        <div class="position-relative p-3 mb-3 card-warna-{{strtolower($kinerja->nama)}} text-center"
                            style="height:125px">
                            {{$kinerja->nama}} <br>
                            <h1 class="kinerja-{{strtolower(Helper::clean($kinerja->nama))}}">
                                {{number_format($kinerja->all_nilai_komponen->avg('total_nilai'),2)}}
                            </h1>
                            <span class="bintang-kinerja">{!!
                                Helper::bintang_icon(number_format($kinerja->all_nilai_komponen->avg('total_nilai'),2),
                                'warning') !!}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    @foreach($komponen_dampak as $dampak)
                    <div class="col-lg-6 col-md-12">
                        <div class="position-relative p-3 mb-3 card-warna-{{strtolower($dampak->nama)}} text-center"
                            style="height:125px">
                            {{$dampak->nama}} <br>
                            <h1 class="dampak-{{strtolower(Helper::clean($dampak->nama))}}">
                                {{number_format($dampak->all_nilai_komponen->avg('total_nilai'),2)}}
                            </h1>
                            <span class="bintang-dampak">{!!
                                Helper::bintang_icon(number_format($dampak->all_nilai_komponen->avg('total_nilai'),2),
                                'warning') !!}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header bg-secondary">
                <h3 class="card-title">Rapor Mutu Verfikasi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($komponen_kinerja as $kinerja)
                    <div class="col-lg-4 col-md-12">
                        <div class="position-relative p-3 mb-3 card-warna-{{strtolower($kinerja->nama)}} text-center"
                            style="height:125px">
                            {{$kinerja->nama}} <br>
                            <h1 class="kinerja-verifikasi-{{strtolower(Helper::clean($kinerja->nama))}}">
                                {{number_format($kinerja->all_nilai_komponen_verifikasi->avg('total_nilai'),2)}}
                            </h1>
                            <span class="bintang-kinerja-verifikasi">{!!
                                Helper::bintang_icon(number_format($kinerja->all_nilai_komponen_verifikasi->avg('total_nilai'),2),
                                'warning') !!}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    @foreach($komponen_dampak as $dampak)
                    <div class="col-lg-6 col-md-12">
                        <div class="position-relative p-3 mb-3 card-warna-{{strtolower($dampak->nama)}} text-center"
                            style="height:125px">
                            {{$dampak->nama}} <br>
                            <h1 class="dampak-verifikasi{{strtolower(Helper::clean($dampak->nama))}}">
                                {{number_format($dampak->all_nilai_komponen_verifikasi->avg('total_nilai'),2)}}
                            </h1>
                            <span class="bintang-dampak-verifikasi">{!!
                                Helper::bintang_icon(number_format($dampak->all_nilai_komponen_verifikasi->avg('total_nilai'),2),
                                'warning') !!}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .card-warna-{{strtolower($komponen[0]->nama)}} {
      background:#d9434e !important;
      color:white;
  }
  .card-warna-{{strtolower($komponen[1]->nama)}} {
      background:#1fac4d !important;
      color:white;
  }
  .card-warna-{{strtolower($komponen[2]->nama)}} {
      background:#48cfc1 !important;
      color:white;
  }
  .card-warna-{{strtolower($komponen[3]->nama)}} {
      background:#9398ec !important;
      color:white;
  }
  .card-warna-{{strtolower($komponen[4]->nama)}} {
      background:#d27b25 !important;
      color:white;
  }
</style>
@endsection
@section('js_file')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://www.chartjs.org/dist/2.9.4/Chart.min.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
@endsection
@section('js')
<script>
    $('.select2').select2();
$('#provinsi_id').change(function(){
    $('#rekap_coe').show();
    $('#rekap_sekolah').hide();
    $('#scatterChart').hide();
    $('#btn_toggle').hide();
	var ini = $(this).val();
	if(ini == ''){
        $.get( "{{route('get_chart_komparasi')}}", function( data ) {
            tampilChart(data)
        });
		return false;
	}
	$.ajax({
		url: '{{route('api.filter_wilayah')}}',
		type: 'post',
		data: {
            id_level_wilayah: 1,
            kode_wilayah: ini.trim(),
        },
		success: function(response){
            $('.avg_kinerja').html(response.output.all_kinerja.rerata);
            $('.avg_dampak').html(response.output.all_dampak.rerata);
            $.each(response.output.all_kinerja.nama, function (i, item) {
                var a = $('h1').hasClass('kinerja-'+item);
                $('h1.kinerja-'+item).html(response.output.all_kinerja.nilai[i]);
                $('h1.kinerja-verifikasi-'+item).html(response.output.all_kinerja.nilai_verifikasi[i]);
            })
            $.each(response.output.all_dampak.nama, function (i, item) {
                var a = $('h1').hasClass('dampak-'+item);
                $('h1.dampak-'+item).html(response.output.all_dampak.nilai[i]);
                $('h1.dampak-verifikasi-'+item).html(response.output.all_dampak.nilai[i]);
            })
            $.each($('.bintang-kinerja'), function(i, val) {
                $(this).html(response.output.all_kinerja.bintang[i])
            })
            $.each($('.bintang-kinerja-verifikasi'), function(i, val) {
                $(this).html(response.output.all_kinerja.bintang_verifikasi[i])
            })
            $.each($('.bintang-dampak'), function(i, val) {
                $(this).html(response.output.all_dampak.bintang[i])
            })
            $.each($('.bintang-dampak-verifikasi'), function(i, val) {
                $(this).html(response.output.all_dampak.bintang_verifikasi[i])
            })
            $.each($('.avg'), function(i, val) {
                $(this).html(response.nilai_komponen_kotak[i].nilai)
            })
            $.each($('.bintang'), function(i, val) {
                $(this).html(response.nilai_komponen_kotak[i].bintang)
            })
            $.each(response.nilai_komponen_kotak, function (i, item) {
                $.each(item.nilai_aspek, function (key, val) {
                    var a = $('h1').hasClass(key);
                    $('h1.'+key).html(val);
                })
            })
            tampilChart(response)
            $('#kabupaten_id').html('<option value="">Semua Kab/Kota</option>');
			$.each(response.output.result, function (i, item) {
				$('#kabupaten_id').append($('<option>', { 
					value: item.value,
					text : item.text
				}));
			});
		}
	});
});
$('#kabupaten_id').change(function(){
    $('#rekap_coe').show();
    $('#rekap_sekolah').hide();
    $('#scatterChart').hide();
    $('#btn_toggle').hide();
	var ini = $(this).val();
	if(ini == ''){
		return false;
	}
	$.ajax({
		url: '{{route('api.filter_wilayah')}}',
		type: 'post',
		data: {
            id_level_wilayah: 2,
            kode_wilayah: ini.trim(),
        },
		success: function(response){
            $('.avg_kinerja').html(response.output.all_kinerja.rerata);
            $('.avg_dampak').html(response.output.all_dampak.rerata);
            $.each(response.output.all_kinerja.nama, function (i, item) {
                var a = $('h1').hasClass('kinerja-'+item);
                $('h1.kinerja-'+item).html(response.output.all_kinerja.nilai[i]);
            })
            $.each(response.output.all_dampak.nama, function (i, item) {
                var a = $('h1').hasClass('dampak-'+item);
                $('h1.dampak-'+item).html(response.output.all_dampak.nilai[i]);
            })
            $.each($('.bintang-kinerja'), function(i, val) {
                $(this).html(response.output.all_kinerja.bintang[i])
            })
            $.each($('.bintang-dampak'), function(i, val) {
                $(this).html(response.output.all_dampak.bintang[i])
            })
            $.each($('.avg'), function(i, val) {
                $(this).html(response.nilai_komponen_kotak[i].nilai)
            })
            $.each($('.bintang'), function(i, val) {
                $(this).html(response.nilai_komponen_kotak[i].bintang)
            })
            $.each(response.nilai_komponen_kotak, function (i, item) {
                $.each(item.nilai_aspek, function (key, val) {
                    var a = $('h1').hasClass(key);
                    $('h1.'+key).html(val);
                })
            })
            tampilChart(response)
            $('#kecamatan_id').html('<option value="">Semua Kecamatan</option>');
			$.each(response.output.result, function (i, item) {
				$('#kecamatan_id').append($('<option>', { 
					value: item.value,
					text : item.text
				}));
            });
            $('#sekolah_id').html('<option value="">Semua Sekolah</option>');
			$.each(response.output.all_sekolah, function (i, item) {
				$('#sekolah_id').append($('<option>', { 
					value: item.value,
					text : item.text
				}));
			});
		}
	});
});
$('#kecamatan_id').change(function(){
    $('#rekap_coe').show();
    $('#rekap_sekolah').hide();
    $('#scatterChart').hide();
    $('#btn_toggle').hide();
	var ini = $(this).val();
	if(ini == ''){
		return false;
	}
	$.ajax({
		url: '{{route('api.filter_wilayah')}}',
		type: 'post',
		data: {
            id_level_wilayah: 3,
            kode_wilayah: ini.trim(),
        },
		success: function(response){
            $('.avg_kinerja').html(response.output.all_kinerja.rerata);
            $('.avg_dampak').html(response.output.all_dampak.rerata);
            $.each(response.output.all_kinerja.nama, function (i, item) {
                var a = $('h1').hasClass('kinerja-'+item);
                $('h1.kinerja-'+item).html(response.output.all_kinerja.nilai[i]);
            })
            $.each(response.output.all_dampak.nama, function (i, item) {
                var a = $('h1').hasClass('dampak-'+item);
                $('h1.dampak-'+item).html(response.output.all_dampak.nilai[i]);
            })
            $.each($('.bintang-kinerja'), function(i, val) {
                $(this).html(response.output.all_kinerja.bintang[i])
            })
            $.each($('.bintang-dampak'), function(i, val) {
                $(this).html(response.output.all_dampak.bintang[i])
            })
            $.each($('.avg'), function(i, val) {
                $(this).html(response.nilai_komponen_kotak[i].nilai)
            })
            $.each($('.bintang'), function(i, val) {
                $(this).html(response.nilai_komponen_kotak[i].bintang)
            })
            $.each(response.nilai_komponen_kotak, function (i, item) {
                $.each(item.nilai_aspek, function (key, val) {
                    var a = $('h1').hasClass(key);
                    $('h1.'+key).html(val);
                })
            })
            $('#sekolah_id').html('<option value="">Semua Sekolah</option>');
            $.each(response.output.all_sekolah, function (i, item) {
                $('#sekolah_id').append($('<option>', { 
                    value: item.value,
                    text : item.text
                }));
            });
            tampilChart(response)
		}
	});
});
$('#sekolah_id').change(function(){
    var ini = $(this).val();
    var params = {
        provinsi_id : $('#provinsi_id').val().trim(),
        sekolah_id: ini,
    }
	getRaporMutu(params);
});
function getRaporMutu(params){
    $.ajax({
		url: '{{route('api.rapor_sekolah')}}',
		type: 'post',
		/*data: {
            provinsi_id : $('#provinsi_id').val().trim(),
            sekolah_id: ini,
        },*/
        data: params,
		success: function(response){
            $( ".show_satu" ).toggle();
            $( ".show_dua" ).toggle();
            $('.nama_provinsi').html(response.nama_wilayah);
            if(response.sekolah){
                $('#rekap_coe').hide();
                $('#rekap_sekolah').show();
                $('#scatterChart').show();
                $('#btn_toggle').show();
                $('.nama_sekolah').html(response.sekolah.nama);
                $('.alamat_sekolah').html(response.sekolah.alamat);
                $('.telp').html(response.sekolah.no_telp);
                $('.fax').html(response.sekolah.no_fax);
                $('.laman').html(response.sekolah.website);
                $('.kepsek').html(response.sekolah.nama_kepsek);
                $('.proli').html('');
                $('.kelas_10').html(response.sekolah.kelas_10_count);
                $('.kelas_11').html(response.sekolah.kelas_11_count);
                $('.kelas_12').html(response.sekolah.kelas_12_count);
                $('.kelas_13').html(response.sekolah.kelas_13_count);
                $('.jumlah_siswa').html(response.sekolah.anggota_rombel_count);
                $('.ptk').html(response.sekolah.guru_count);
                $('.tendik').html(response.sekolah.tendik_count);
                $('.avg_kinerja').html(response.rerata_komponen_kinerja);
                $('.avg_dampak').html(response.rerata_komponen_dampak);
                $.each(response.group_komponen.all_kinerja.nama, function (i, item) {
                    var a = $('h1').hasClass('kinerja-'+item);
                    $('h1.kinerja-'+item).html(response.group_komponen.all_kinerja.nilai[i]);
                })
                $.each(response.group_komponen.all_dampak.nama, function (i, item) {
                    var a = $('h1').hasClass('dampak-'+item);
                    $('h1.dampak-'+item).html(response.group_komponen.all_dampak.nilai[i]);
                })
                $.each($('.bintang-kinerja'), function(i, val) {
                    $(this).html(response.group_komponen.all_kinerja.bintang[i])
                })
                $.each($('.bintang-dampak'), function(i, val) {
                    $(this).html(response.group_komponen.all_dampak.bintang[i])
                })
                $.each($('.avg'), function(i, val) {
                    $(this).html(response.nilai_komponen_kotak[i].nilai)
                })
                $.each($('.bintang'), function(i, val) {
                    $(this).html(response.nilai_komponen_kotak[i].bintang)
                })
                $.each(response.nilai_komponen_kotak, function (i, item) {
                    $.each(item.nilai_aspek, function (key, val) {
                        var a = $('h1').hasClass(key);
                        $('h1.'+key).html(val);
                    })
                })
                tampilChart(response)
            } else {
                $('#rekap_sekolah').hide();
                $('#scatterChart').hide();
                $('#rekap_coe').show();
            }
		}
	});
}
$( ".button" ).click(function() {
    var data = $(this).data('query');
    var params;
    if(data === 'nasional'){
        params = {
            all_provinsi: 1,
            provinsi_id : $('#provinsi_id').val().trim(),
            sekolah_id: $('#sekolah_id').val(),
        }
    } else {
        params = {
            all_provinsi: 0,
            provinsi_id : $('#provinsi_id').val().trim(),
            sekolah_id: $('#sekolah_id').val(),
        }
    }
    getRaporMutu(params);
});
$.get( "{{route('get_chart_komparasi')}}", function( data ) {
    tampilChart(data)
});

var lineChart;
function tampilChart(data){
    if(data.counting){
        $.each($('td.rekap'), function(i, val) {
            $(this).html(data.counting[i])
        });
    }
    var RaporMutuVerifikasi = document.getElementById('rapor_mutu_verifikasi').getContext('2d');
    lineChart = new Chart(RaporMutuVerifikasi, {
        type: 'line',
            data: {
            labels: ['Input', 'Proses', 'Output', 'Outcome', 'Impact'],
            datasets: [{
                label: 'Rapor Mutu Sekolah',
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                data: data.nilai_komponen,
                fill: false,
            }, {
                label: 'Rapor Mutu Verifikasi',
                fill: false,
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                data: data.nilai_komponen_verifikasi,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Komparasi Rapor Mutu'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Nilai Komponen'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Nilai Komponen'
                    },
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        stepSize: 20,
                    }
                }]
            }
        }
    });
    if(data.output){
        lineChart.update();
    }
}
</script>
@endsection
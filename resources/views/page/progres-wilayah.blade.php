@extends('layouts.app')
@section('title', 'Progres Data Penjaminan Mutu SMK')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-refresh mr-1"></i>
                Progres Data Penjaminan Mutu SMK
            </h3></div>
            <div class="card-body">
                <table id="datatable_test" class="table table-bordered table-striped table-hover table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Wilayah</th>
                            <th class="text-center">Jml Sekolah</th>
                            <th class="text-center" colspan="2">Pengisian Instrumen</th>
                            <th class="text-center" colspan="2">Hitung Rapor Mutu</th>
                            <th class="text-center" colspan="2">Pakta Integritas</th>
                            <th class="text-center" colspan="2">Verval</th>
                            <th class="text-center" colspan="2">Verifikasi Pusat</th>
                            <th class="text-center" colspan="2">Pengesahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($all_wilayah as $item)
                        <?php
                        $count_instrumen = $item->{$with}->map(function($data){
                            return $data->nilai_instrumen_count;
                        })->toArray();
                        $nilai1_instrumen = count(array_filter($count_instrumen));
                        $nilai2_instrumen = count($count_instrumen);
                        $persen_instrumen = ($nilai2_instrumen) ? $nilai1_instrumen / $nilai2_instrumen * 100 : 0;
                        $count_nilai_akhir = $item->{$with}->map(function($data){
                            return $data->user->nilai_akhir;
                        })->toArray();
                        $nilai1_nilai_akhir = count(array_filter($count_nilai_akhir));
                        $nilai2_nilai_akhir = count($count_nilai_akhir);
                        $persen_nilai_akhir = ($nilai2_nilai_akhir) ? $nilai1_nilai_akhir / $nilai2_nilai_akhir * 100 : 0;
                        $count_pakta_integritas = $item->{$with}->map(function($data){
                            return ($data->sekolah_sasaran) ? $data->sekolah_sasaran->pakta_integritas : NULL;
                        })->toArray();
                        $nilai1_pakta_integritas = count(array_filter($count_pakta_integritas));
                        $nilai2_pakta_integritas = count($count_pakta_integritas);
                        $persen_pakta_integritas = ($nilai2_pakta_integritas) ? $nilai1_pakta_integritas / $nilai2_pakta_integritas * 100 : 0;
                        $count_waiting = $item->{$with}->map(function($data){
                            return ($data->sekolah_sasaran) ? $data->sekolah_sasaran->waiting : NULL;
                        })->toArray();
                        $nilai1_waiting = count(array_filter($count_waiting));
                        $nilai2_waiting = count($count_waiting);
                        $persen_waiting = ($nilai2_waiting) ? $nilai1_waiting / $nilai2_waiting * 100 : 0;
                        $count_proses = $item->{$with}->map(function($data){
                            return ($data->sekolah_sasaran) ? $data->sekolah_sasaran->proses : NULL;
                        })->toArray();
                        $nilai1_proses = count(array_filter($count_proses));
                        $nilai2_proses = count($count_proses);
                        $persen_proses = ($nilai2_proses) ? $nilai1_proses / $nilai2_proses * 100 : 0;
                        $count_terima = $item->{$with}->map(function($data){
                            return ($data->sekolah_sasaran) ? $data->sekolah_sasaran->terima : NULL;
                        })->toArray();
                        $nilai1_terima = count(array_filter($count_terima));
                        $nilai2_terima = count($count_terima);
                        $persen_terima = ($nilai2_terima) ? $nilai1_terima / $nilai2_terima * 100 : 0;
                        ?>
                        <tr>
                            <td>{{$item->nama}}</td>
                            <td class="text-center">{{$item->$data_count}}</td>
                            <td class="text-center">{{$nilai1_instrumen}}</td>
                            <td class="text-center">{{($persen_instrumen) ? number_format($persen_instrumen,0).'%' : '0%'}}</td>
                            <td class="text-center">{{$nilai1_nilai_akhir}}</td>
                            <td class="text-center">{{($persen_nilai_akhir) ? number_format($persen_nilai_akhir,0).'%' : '0%'}}</td>
                            <td class="text-center">{{$nilai1_pakta_integritas}}</td>
                            <td class="text-center">{{($persen_pakta_integritas) ? number_format($persen_pakta_integritas,0).'%' : '0%'}}</td>
                            <td class="text-center">{{$nilai1_waiting}}</td>
                            <td class="text-center">{{($persen_waiting) ? number_format($persen_waiting,0).'%' : '0%'}}</td>
                            <td class="text-center">{{$nilai1_proses}}</td>
                            <td class="text-center">{{($persen_proses) ? number_format($persen_proses,0).'%' : '0%'}}</td>
                            <td class="text-center">{{$nilai1_terima}}</td>
                            <td class="text-center">{{($persen_terima) ? number_format($persen_terima,0).'%' : '0%'}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="8">Tidak ada data untuk ditampilkan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var table = $('#datatable').DataTable( {
        lengthMenu: [[-1, 10, 25, 50], ["Semua", 10, 25, 50]],
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('api.wilayah') }}',
            data: function(d){
                d.id_level_wilayah = {{$id_level_wilayah}};
            },
        },
        responsive: true,
        columns: [
            {data: 'nama', name: 'nama', orderable: false},
            {data: 'count_sekolah', name: 'count_sekolah', className: 'text-center', orderable: false},
            {data: 'instrumen', name: 'instrumen', className: 'text-center', orderable: false},
            {data: 'rapor_mutu', name: 'rapor_mutu', className: 'text-center', orderable: false},
            {data: 'pakta_integritas', name: 'pakta_integritas', className: 'text-center', orderable: false},
            {data: 'verval', name: 'verval', className: 'text-center', orderable: false},
            {data: 'verifikasi', name: 'verifikasi', className: 'text-center', orderable: false},
            {data: 'pengesahan', name: 'pengesahan', className: 'text-center', orderable: false},
        ],
        language: {
            "decimal":        "",
            "emptyTable":     "Tidak ada data untuk ditampilkan",
            "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered":   "(difilter dari _MAX_ total data)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Menampilkan _MENU_ data",
            "loadingRecords": "Loading...",
            "processing":     "Memperoses data...",
            "search":         "Cari:",
            "zeroRecords":    "Tidak ada data yang sesuai dengan pencarian",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Berikutnya",
                "previous":   "Sebelumnya"
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });
</script>
@endsection
@section('js_file')
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
@endsection
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
@endsection

@extends('layouts.app')
@section('title', 'Rapor Mutu SMK')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jumlah Siswa</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>PTK</th>
                                    <th>Guru</th>
                                    <th>Tendik</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header card-warna-{{strtolower($komponen[0]->nama)}}">
                                <h3 class="card-title">{{$komponen[0]->nama}}</h3>
                                <div class="card-tools">
                                    {{number_format($komponen[0]->all_nilai_komponen->avg('total_nilai'),2)}}
                                    {!! Helper::bintang_icon(number_format($komponen[0]->all_nilai_komponen->avg('total_nilai'),2), 'warning') !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($komponen[0]->aspek as $aspek)
                                    <div class="col-lg-4 col-md-12">
                                        <div class="position-relative p-3 mb-3 bg-gray text-center" style="height:125px">
                                            {{$aspek->nama}} <br>
                                            <h1>{{number_format($aspek->all_nilai_aspek->avg('total_nilai'),2)}}</h1>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <canvas id="marksChart" width="100%" height="100%"></canvas>
                    </div>
                </div>
                {{--dd($komponen[0])--}}
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header card-warna-{{strtolower($komponen[1]->nama)}}">
                                <h3 class="card-title">{{$komponen[1]->nama}}</h3>
                                <div class="card-tools">
                                    {{number_format($komponen[1]->all_nilai_komponen->avg('total_nilai'),2)}}
                                    {!! Helper::bintang_icon(number_format($komponen[1]->all_nilai_komponen->avg('total_nilai'),2), 'warning') !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($komponen[1]->aspek as $aspek)
                                    <div class="col-lg-4 col-md-12">
                                        <div class="position-relative p-3 mb-3 bg-gray text-center" style="height:125px">
                                            {{$aspek->nama}} <br>
                                            <h1>{{number_format($aspek->all_nilai_aspek->avg('total_nilai'),2)}}</h1>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header card-warna-{{strtolower($komponen[2]->nama)}}">
                                <h3 class="card-title">{{$komponen[2]->nama}}</h3>
                                <div class="card-tools">
                                    {{number_format($komponen[2]->all_nilai_komponen->avg('total_nilai'),2)}}
                                    {!! Helper::bintang_icon(number_format($komponen[2]->all_nilai_komponen->avg('total_nilai'),2), 'warning') !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($komponen[2]->aspek as $aspek)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="position-relative p-3 mb-3 bg-gray text-center" style="height:125px">
                                            {{$aspek->nama}} <br>
                                            <h1>{{number_format($aspek->all_nilai_aspek->avg('total_nilai'),2)}}</h1>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header card-warna-{{strtolower($komponen[3]->nama)}}">
                                <h3 class="card-title">{{$komponen[3]->nama}}</h3>
                                <div class="card-tools">
                                    {{number_format($komponen[3]->all_nilai_komponen->avg('total_nilai'),2)}}
                                    {!! Helper::bintang_icon(number_format($komponen[3]->all_nilai_komponen->avg('total_nilai'),2), 'warning') !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($komponen[3]->aspek as $aspek)
                                    <div class="col-12">
                                        <div class="position-relative p-3 mb-3 bg-gray text-center" style="height:125px">
                                            {{$aspek->nama}} <br>
                                            <h1>{{number_format($aspek->all_nilai_aspek->avg('total_nilai'),2)}}</h1>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header card-warna-{{strtolower($komponen[4]->nama)}}">
                                <h3 class="card-title">{{$komponen[4]->nama}}</h3>
                                <div class="card-tools">
                                    {{number_format($komponen[4]->all_nilai_komponen->avg('total_nilai'),2)}}
                                    {!! Helper::bintang_icon(number_format($komponen[4]->all_nilai_komponen->avg('total_nilai'),2), 'warning') !!}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($komponen[4]->aspek as $aspek)
                                    <div class="col-lg-6 col-md-12">
                                        <div class="position-relative p-3 mb-3 bg-gray text-center" style="height:125px">
                                            {{$aspek->nama}} <br>
                                            <h1>{{number_format($aspek->all_nilai_aspek->avg('total_nilai'),2)}}</h1>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
  .card-warna-{{strtolower($komponen[0]->nama)}} {
      background:#d9434e !important;
  }
  .card-warna-{{strtolower($komponen[1]->nama)}} {
      background:#1fac4d !important;
  }
  .card-warna-{{strtolower($komponen[2]->nama)}} {
      background:#48cfc1 !important;
  }
  .card-warna-{{strtolower($komponen[3]->nama)}} {
      background:#9398ec !important;
  }
  .card-warna-{{strtolower($komponen[4]->nama)}} {
      background:#d27b25 !important;
  }
</style> 
@endsection
@section('js_file')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
@section('js')
<script>
$.get( "{{route('get_chart')}}", function( data ) {
    console.log(data);
    var marksCanvas = document.getElementById("marksChart");
    var marksData = {
        labels: data.nama_komponen,
        //labels: ["English", "Maths", "Physics", "Chemistry", "Biology", "History"],
        datasets: [{
            label: "Tahun 2020",
            backgroundColor: "transparent",
            data: data.nilai_komponen,
            //data: [65, 75, 70, 80, 60, 80],
            borderColor: "rgba(200,0,0,0.6)",
            fill: false,
            radius: 6,
            pointRadius: 6,
            pointBorderWidth: 3,
            pointBackgroundColor: "orange",
            pointBorderColor: "rgba(200,0,0,0.6)",
            pointHoverRadius: 10,
            }]
    };

    var radarChart = new Chart(marksCanvas, {
        type: 'radar',
        data: marksData,
        options: {
            legend: {
                position: 'top',
            },
            title: {
                display: false,
                text: 'Chart.js Outcome Graph'
            },
            scale: {
                ticks: {
                    beginAtZero: true,
                    min: 0,
                    max: 100,
                }
            },
            tooltips:{
                enabled:true,
                callbacks:{
                    label: function(tooltipItem, data){
                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                        //This will be the tooltip.body
                        return datasetLabel + ': ' + tooltipItem.yLabel;
                    }
                },
            }
        }
    });
});
</script>
@endsection
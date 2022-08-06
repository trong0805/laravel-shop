@extends('layout.master-admin')
@section('title', 'Thống kê')
@section('content')
    <div class="alert alert-default-info">
        <h3 class="text-center">Thống kê</h3>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
    <canvas id="myCharts" style="width:100%;max-width:600px"></canvas>


    <script>
        var xValues = [];
        var yValues = [];
        var xValuess = [];
        var yValuess = [10,19];
    </script>
    @foreach ($stats as $item)
        <script>
            xValues.push("{{ $item->date }}");
            yValues.push("{{ $item->value }}");
            console.log(xValues);
            console.log(yValues);
        </script>
    @endforeach
    <script>
        var barColors = ["red", "green", "blue", "orange", "brown"];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                // legend: {
                //     display: false
                // },
                title: {
                    display: true,
                    text: "Thống kê số lượng sản phẩm bán theo ngày"
                }
            }
        });
    </script>
 @foreach ($cates as $it)
 <script>
     xValuess.push("{{ $it->name }}");
    //  yValuess.push("{{ $item->value }}");
     console.log(xValues);
     console.log(yValues);
 </script>
@endforeach
    <script>
        var barColors = ["red", "green", "blue", "orange", "brown"];

        new Chart("myCharts", {
            type: "bar",
            data: {
                labels: xValuess,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValuess
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Thống kê số lượng sản phẩm"
                }
            }
        });
    </script>
@endsection

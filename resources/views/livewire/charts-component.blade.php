<div id="sales-chart-container">
</div>

<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<script>

    const chart = new Chartisan({
        el: '#sales-chart-container',
        url: "@chart('sales_chart')",
        hooks: new ChartisanHooks()
            .legend()
            .colors()
            .datasets(['line', 'bar'])
            .tooltip(),

    });
    {{--var datas = <? php echo json_encode($datas) ?>--}}

    {{--HighCharts.chart('chart-container',--}}
    {{--    {--}}
    {{--        title:{--}}
    {{--            text:"new user growth 2020"--}}
    {{--        },--}}
    {{--        subtitle:{--}}
    {{--            text:"source: my pc"--}}
    {{--        },--}}
    {{--        xAxis:{--}}
    {{--            categories:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']--}}
    {{--        },--}}
    {{--        yAxis:{--}}
    {{--            title:"Number of new Users"--}}
    {{--        },--}}
    {{--        legend:{--}}
    {{--            layout:'vertical',--}}
    {{--            align:'right',--}}
    {{--            verticalAlign:'middle'--}}
    {{--        },--}}
    {{--        plotOptions:--}}
    {{--            {--}}
    {{--                series:{--}}
    {{--                    allowPointSelect: true--}}
    {{--                }--}}
    {{--            },--}}
    {{--        series: [{--}}
    {{--            name:"New User",--}}
    {{--            data:datas--}}
    {{--        }],--}}
    {{--        responsive:{--}}
    {{--            rules:[--}}
    {{--                {--}}
    {{--                    condition:{--}}
    {{--                        maxWidth:500--}}
    {{--                    },--}}
    {{--                    chartOptions:{--}}
    {{--                        legend: {--}}
    {{--                            layout: 'horizontal',--}}
    {{--                            align: 'center',--}}
    {{--                            verticalAlign: 'bottom'--}}
    {{--                        }--}}
    {{--                    }--}}
    {{--                }--}}
    {{--            ]--}}
    {{--        }--}}
    {{--    }--}}
    {{--)--}}
</script>

@stack('scripts')

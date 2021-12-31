<br/>
<br/>
<div id="sales-chart-container" style="height: 300px">
</div>

<br/>
<br/>
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

<script>

    const chart = new Chartisan({
        el: '#sales-chart-container',
        url: "@chart('sales_chart')",
        hooks:new ChartisanHooks()
            .legend()
            .colors()
            .tooltip(),

    });
</script>

@stack('scripts')

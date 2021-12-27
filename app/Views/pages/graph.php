<!-- CHART JS -->
<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="<?php echo $base_url."/assets/js/chart.js";?>" type="module"></script>
<div class=" flex flex-col items-center px-7 py-10">
    <p class="">Employment Rate</p>
    <p class="mb-5 text-xxs" id="year_range"></p>
    <div class=" w-9/12">
        <canvas id="myChart"></canvas>
    </div>
</div>


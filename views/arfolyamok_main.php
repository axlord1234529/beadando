<style>
    table, th, td {
        border:1px solid black;
    }
    .not-visible{
        visibility: hidden;
    }
</style>
<div class="currency-wrapper">
<form action="<?= SITE_ROOT ?>arfolyamok" class="form currency" method="post">
    <label for="currencies">Válasz egy devizapárt: </label>
    <select name="currency1" id="cars">
        <?php if(isset($viewData['currencies'])) {
            foreach ($viewData['currencies'] as $currency) {?>

        <option value="<?= $currency ?>"><?= $currency ?></option>
        <?php }}?>
    </select>
    <select name="currency2" id="cars">
        <?php if(isset($viewData['currencies'])) {
            rsort($viewData['currencies']);
            foreach ($viewData['currencies'] as $currency) {?>

                <option value="<?= $currency ?>"><?= $currency ?></option>
            <?php }}?>
    </select>
    <br><br>
    <label>Add meg az idő intervalumot</label>
    <input type="date" name="startDate">
    <input type="date" name="endDate">
    <br>
    <input type="submit" value="Küld">
    <br>
    <?php
    if(isset($viewData['rates']))
    { ?>
    <table>
        <tr>
            <th>Date</th>
            <th><?= $viewData['selectedCurrency1']; ?></th>
            <th><?= $viewData['selectedCurrency2']; ?></th>
            <th>Unit</th>

        </tr>
            <?php foreach ($viewData['rates'] as $date => $rates) {

                $datesForChart[] = $date;
                if(isset($rates[$viewData['selectedCurrency1']]['value'])) $ratesForChartCurrency1[] = floatval($rates[$viewData['selectedCurrency1']]['value']);
                if(isset($rates[$viewData['selectedCurrency2']]['value'])) $ratesForChartCurrency2[] = floatval($rates[$viewData['selectedCurrency2']]['value']);

                if(isset($rates[$viewData['selectedCurrency1']]) && isset($rates[$viewData['selectedCurrency2']]))
                {
                    $units = $rates[$viewData['selectedCurrency1']]['unit']." ; ".$rates[$viewData['selectedCurrency2']]['unit'];
                } elseif (isset($rates[$viewData['selectedCurrency1']]))
                {
                    $units = $rates[$viewData['selectedCurrency1']]['unit']." ; -";
                }elseif (isset($rates[$viewData['selectedCurrency2']]))
                {
                    $units = "- ; ".$rates[$viewData['selectedCurrency2']]['unit'];
                }else{
                    $units = "- ; -";
                }?>
        <tr>
            <td><?= $date ?></td>
            <td><?= (isset($rates[$viewData['selectedCurrency1']])) ? $rates[$viewData['selectedCurrency1']]['value'] : "-" ?></td>
            <td><?= (isset($rates[$viewData['selectedCurrency2']])) ? $rates[$viewData['selectedCurrency2']]['value'] : "-" ?></td>
            <td><?= $units ?></td>
        </tr>
            <?php } ?>
    </table>
        <br>
    <?php }
    else if(isset($viewData['errors']))
    {
        foreach ($viewData['errors'] as $error)
        {
        ?>
        <p> <?= $error ?></p>
   <?php
        }
    }?>
    <div <?= (!isset($datesForChart))? 'class ="not-visible"' : '' ?>>
        <canvas id="chartCurrency1"></canvas>
    </div>
</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
    $displayRate2 = false;
    $displayRate1 = false;
    if(!isset($ratesForChartCurrency1))
    {
        $displayRate2 = true;
    }
    elseif (!isset($ratesForChartCurrency2))
    {
        $displayRate1 = true;
    }
?>
<script>
   let data;
    if (<?= json_encode($displayRate2) ?>)
    {
        data = {
            labels: <?=  json_encode($datesForChart) ?>,
            datasets: [{
                label: <?= json_encode($viewData['selectedCurrency2']) ?>,
                data: <?= (isset($ratesForChartCurrency2))? json_encode($ratesForChartCurrency2) : "[]" ?>,
                borderWidth: 1
            }]
        };
    }
    else if(<?= json_encode($displayRate1)?>)
    {
        data = {
            labels: <?=  json_encode($datesForChart) ?>,
            datasets: [{
                label: <?= json_encode($viewData['selectedCurrency1']) ?>,
                data: <?=(isset($ratesForChartCurrency1))? json_encode($ratesForChartCurrency1) : "[]" ?>,
                borderWidth: 1
            }]
        };
    }
    else
    {
        data = {
            labels: <?=  json_encode($datesForChart) ?>,
            datasets: [{
                label: <?= json_encode($viewData['selectedCurrency1']) ?>,
                data: <?= (isset($ratesForChartCurrency1))? json_encode($ratesForChartCurrency1) : "[]" ?>,
                borderWidth: 1
            },
                {
                    label: <?= json_encode($viewData['selectedCurrency2']) ?>,
                    data: <?= (isset($ratesForChartCurrency2))? json_encode($ratesForChartCurrency2) : "[]" ?>,
                    borderWidth: 1
                }]
        };
    }

    const config = {
        type: 'line',
        data,
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    };

    const chart1 = new Chart(document.getElementById('chartCurrency1'), config );
</script>


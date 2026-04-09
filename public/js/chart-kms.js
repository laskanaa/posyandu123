function renderKMSChart(canvasId, gender, dataBalita) {

    const ctx = document.getElementById(canvasId);

    const whoData = window.whoData || [];

    const boys = { min3: [], min2: [], normal: [], plus2: [], plus3: [] };
    const girls = { min3: [], min2: [], normal: [], plus2: [], plus3: [] };

    // 🔥 mapping dari DB (0–60 bulan)
    whoData.forEach(item => {

        if (item.jenis_kelamin === 'L') {
            boys.min3.push(item.minus_3sd);
            boys.min2.push(item.minus_2sd);
            boys.normal.push(item.median);
            boys.plus2.push(item.plus_2sd);
            boys.plus3.push(item.plus_3sd);
        } else {
            girls.min3.push(item.minus_3sd);
            girls.min2.push(item.minus_2sd);
            girls.normal.push(item.median);
            girls.plus2.push(item.plus_2sd);
            girls.plus3.push(item.plus_3sd);
        }

    });

    const who = (gender === 'l' || gender === 'laki-laki') ? boys : girls;

    // 🔥 bikin -1 SD & +1 SD
    function mid(a, b) {
        return a.map((v, i) => (v + b[i]) / 2);
    }

    who.min1 = mid(who.min2, who.min3);
    who.plus1 = mid(who.plus2, who.normal);

    // 🔥 label umur
    const labels = Array.from({ length: who.min3.length }, (_, i) => i);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [

                // AREA WARNA
                {
                    data: who.min2,
                    borderWidth: 0,
                    fill: (ctx) => ctx.chart.data.datasets[0].data.map((_, i) => who.min3[i]),
                    backgroundColor: 'rgba(255,206,86,0.5)'
                },
                {
                    data: who.min1,
                    borderWidth: 0,
                    fill: (ctx) => ctx.chart.data.datasets[1].data.map((_, i) => who.min2[i]),
                    backgroundColor: 'rgba(34,197,94,0.3)'
                },
                {
                    data: who.plus1,
                    borderWidth: 0,
                    fill: (ctx) => ctx.chart.data.datasets[2].data.map((_, i) => who.min1[i]),
                    backgroundColor: 'rgba(34,197,94,0.6)'
                },
                {
                    data: who.plus2,
                    borderWidth: 0,
                    fill: (ctx) => ctx.chart.data.datasets[3].data.map((_, i) => who.plus1[i]),
                    backgroundColor: 'rgba(255,206,86,0.4)'
                },
                {
                    data: who.plus3,
                    borderWidth: 0,
                    fill: (ctx) => ctx.chart.data.datasets[4].data.map((_, i) => who.plus2[i]),
                    backgroundColor: 'rgba(255,206,86,0.5)'
                },

                // GARIS WHO
                { label: '-3 SD', data: who.min3, borderColor: '#f59e0b', borderDash: [5, 5], pointRadius: 0 },
                { label: '-2 SD', data: who.min2, borderColor: '#facc15', pointRadius: 0 },
                { label: '-1 SD', data: who.min1, borderColor: '#22c55e', pointRadius: 0 },
                { label: 'Median', data: who.normal, borderColor: '#15803d', borderWidth: 3, pointRadius: 0 },
                { label: '+1 SD', data: who.plus1, borderColor: '#22c55e', pointRadius: 0 },
                { label: '+2 SD', data: who.plus2, borderColor: '#facc15', pointRadius: 0 },
                { label: '+3 SD', data: who.plus3, borderColor: '#f59e0b', borderDash: [5, 5], pointRadius: 0 },

                // DATA BALITA
                {
                    label: 'Balita',
                    data: dataBalita,
                    borderColor: '#000',
                    backgroundColor: '#000',
                    borderWidth: 3,
                    tension: 0.3,
                    pointRadius: 4
                }

            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false } // matikan legend default
            }
        }
    });

    // 🔥 LEGEND MANUAL (INI YANG KAMU MAU)
    const legendHTML = `
    <div style="margin-top:15px;font-size:13px;line-height:1.8">
        <b>Keterangan Status:</b><br>

        <span style="color:#15803d;font-weight:bold">●</span> Normal 
        <small>(-2 SD s/d +2 SD)</small><br>

        <span style="color:#facc15;font-weight:bold">●</span> Stunting 
        <small>(-3 SD s/d -2 SD)</small><br>

        <span style="color:#f59e0b;font-weight:bold">●</span> Stunting Berat 
        <small>(< -3 SD)</small><br>

        <span style="color:#dc2626;font-weight:bold">●</span> Tinggi 
        <small>(> +2 SD)</small><br>

        <span style="color:#000;font-weight:bold">●</span> Data Balita
    </div>
`;

    ctx.insertAdjacentHTML('afterend', legendHTML);
}
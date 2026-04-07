function renderKMSChart(canvasId, gender, dataBalita, labels) {

    const ctx = document.getElementById(canvasId);

    const girls = {
        min3: [2, 2.7, 3.4, 4, 4.4, 4.8, 5.1, 5.3, 5.6, 5.8, 5.9, 6.1, 6.3],
        min2: [2.4, 3.2, 3.9, 4.5, 5, 5.4, 5.7, 6, 6.3, 6.5, 6.7, 6.9, 7],
        min1: [2.8, 3.6, 4.5, 5.2, 5.7, 6.1, 6.5, 6.8, 7, 7.3, 7.5, 7.7, 7.9],
        normal: [3.2, 4.2, 5.1, 5.8, 6.4, 6.9, 7.3, 7.6, 7.9, 8.2, 8.5, 8.7, 8.9],
        plus1: [3.7, 4.8, 5.8, 6.6, 7.3, 7.8, 8.2, 8.6, 9, 9.3, 9.6, 9.9, 10.1],
        plus2: [4.2, 5.5, 6.6, 7.5, 8.2, 8.8, 9.3, 9.8, 10.2, 10.5, 10.9, 11.2, 11.5],
        plus3: [4.8, 6.2, 7.5, 8.5, 9.3, 10, 10.6, 11.1, 11.6, 12, 12.4, 12.8, 13.1]
    };

    const boys = {
        min3: [2.1, 2.9, 3.8, 4.4, 4.9, 5.3, 5.7, 5.9, 6.2, 6.4, 6.6, 6.8, 6.9],
        min2: [2.5, 3.4, 4.3, 5, 5.6, 6, 6.4, 6.7, 6.9, 7.1, 7.4, 7.6, 7.7],
        min1: [2.9, 3.9, 4.9, 5.7, 6.2, 6.7, 7.1, 7.4, 7.7, 8, 8.2, 8.4, 8.6],
        normal: [3.3, 4.5, 5.6, 6.4, 7, 7.5, 7.9, 8.3, 8.6, 8.9, 9.2, 9.4, 9.6],
        plus1: [3.9, 5.1, 6.3, 7.2, 7.8, 8.4, 8.8, 9.2, 9.6, 9.9, 10.2, 10.5, 10.8],
        plus2: [4.4, 5.8, 7.1, 8, 8.7, 9.3, 9.8, 10.3, 10.7, 11, 11.4, 11.7, 12],
        plus3: [5, 6.6, 8, 9, 9.7, 10.4, 10.9, 11.4, 11.9, 12.3, 12.7, 13, 13.3]
    };

    const who = (gender === 'laki-laki') ? boys : girls;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [

                // AREA WARNA
                {
                    data: who.min2,
                    borderWidth: 0,
                    fill: { target: (ctx) => who.min3[ctx.dataIndex] },
                    backgroundColor: 'rgba(255, 206, 86, 0.5)'
                },
                {
                    data: who.min1,
                    borderWidth: 0,
                    fill: { target: (ctx) => who.min2[ctx.dataIndex] },
                    backgroundColor: 'rgba(34,197,94,0.3)'
                },
                {
                    data: who.plus1,
                    borderWidth: 0,
                    fill: { target: (ctx) => who.min1[ctx.dataIndex] },
                    backgroundColor: 'rgba(34,197,94,0.6)'
                },
                {
                    data: who.plus2,
                    borderWidth: 0,
                    fill: { target: (ctx) => who.plus1[ctx.dataIndex] },
                    backgroundColor: 'rgba(255,206,86,0.4)'
                },
                {
                    data: who.plus3,
                    borderWidth: 0,
                    fill: { target: (ctx) => who.plus2[ctx.dataIndex] },
                    backgroundColor: 'rgba(255,206,86,0.5)'
                },

                // GARIS BERWARNA SESUAI KMS
                { label: '-3 SD', data: who.min3, borderColor: '#f59e0b', borderDash: [5, 5], pointRadius: 0 },
                { label: '-2 SD', data: who.min2, borderColor: '#facc15', borderWidth: 2, pointRadius: 0 },
                { label: '-1 SD', data: who.min1, borderColor: '#22c55e', borderWidth: 2, pointRadius: 0 },
                { label: 'Median', data: who.normal, borderColor: '#15803d', borderWidth: 3, pointRadius: 0 },
                { label: '+1 SD', data: who.plus1, borderColor: '#22c55e', borderWidth: 2, pointRadius: 0 },
                { label: '+2 SD', data: who.plus2, borderColor: '#facc15', borderWidth: 2, pointRadius: 0 },
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
                legend: { display: false }
            },
            scales: {
                x: {
                    grid: { color: '#e5e7eb' }
                },
                y: {
                    grid: { color: '#e5e7eb' }
                }
            }
        }
    });

    // 🔥 KETERANGAN MANUAL (LEGEND)
    const legendHTML = `
        <div style="margin-top:15px;font-size:13px">
            <b>Keterangan:</b><br>
            <span style="color:#15803d">●</span> Normal (-1 SD s/d +1 SD)<br>
            <span style="color:#facc15">●</span> Waspada (-2 SD / +2 SD)<br>
            <span style="color:#f59e0b">●</span> Risiko (-3 SD / +3 SD)<br>
            <span style="color:#000">●</span> Data Balita
        </div>
    `;

    document.getElementById(canvasId).insertAdjacentHTML('afterend', legendHTML);
}
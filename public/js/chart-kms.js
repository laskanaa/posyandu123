function renderKMSChart(canvasId, gender, penimbangans, tanggalLahir) {

    const ctx = document.getElementById(canvasId);

    const whoData = window.whoData || [];

    const boys = { min3: [], min2: [], normal: [], plus2: [], plus3: [] };
    const girls = { min3: [], min2: [], normal: [], plus2: [], plus3: [] };

    // mapping WHO
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

    // ================= DATA BALITA =================
    let dataBalita = new Array(who.min3.length).fill(null);

    const tglLahir = new Date(tanggalLahir);

    penimbangans.forEach(p => {
        const tglTimbang = new Date(p.tanggal_penimbangan);

        let umur = (tglTimbang.getFullYear() - tglLahir.getFullYear()) * 12;
        umur += tglTimbang.getMonth() - tglLahir.getMonth();

        if (umur >= 0 && umur < dataBalita.length) {
            dataBalita[umur] = p.berat_badan; // bisa diganti tinggi_badan
        }
    });

    const labels = Array.from({ length: who.min3.length }, (_, i) => i);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [

                // 🔴 STUNTING BERAT
                {
                    label: '-3 SD',
                    data: who.min3,
                    borderColor: '#f97316',
                    borderDash: [5, 5],
                    borderWidth: 2,
                    pointRadius: 0,
                    fill: false
                },

                // 🟡 STUNTING
                {
                    label: '-2 SD',
                    data: who.min2,
                    borderColor: '#facc15',
                    borderWidth: 2,
                    pointRadius: 0,
                    fill: false
                },

                // 🟢 NORMAL (MEDIAN)
                {
                    label: 'Median',
                    data: who.normal,
                    borderColor: '#16a34a',
                    borderWidth: 3,
                    pointRadius: 0,
                    fill: false
                },

                // 🟢 NORMAL ATAS
                {
                    label: '+2 SD',
                    data: who.plus2,
                    borderColor: '#16a34a',
                    borderWidth: 2,
                    pointRadius: 0,
                    fill: false
                },

                // 🔴 TINGGI
                {
                    label: '+3 SD',
                    data: who.plus3,
                    borderColor: '#dc2626',
                    borderDash: [5, 5],
                    borderWidth: 2,
                    pointRadius: 0,
                    fill: false
                },

                // ⚫ DATA BALITA (GARIS + TITIK)
                {
                    label: 'Balita',
                    data: dataBalita,
                    borderColor: '#000',
                    backgroundColor: '#000',
                    borderWidth: 3,
                    tension: 0.3,
                    pointRadius: 5,
                    pointHoverRadius: 6,
                    spanGaps: true, // 🔥 INI KUNCINYA
                    fill: false
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
                    title: {
                        display: true,
                        text: 'Umur (bulan)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Berat Badan (kg)'
                    }
                }
            }
        }
    });

    // LEGEND
    const legendHTML = `
    <div style="margin-top:15px;font-size:13px;line-height:1.8">
        <b>Keterangan Status:</b><br>
        <span style="color:#16a34a;font-weight:bold">●</span> Normal (-2 SD s/d +2 SD)<br>
        <span style="color:#facc15;font-weight:bold">●</span> Stunting (-3 SD s/d -2 SD)<br>
        <span style="color:#f97316;font-weight:bold">●</span> Stunting Berat (< -3 SD)<br>
        <span style="color:#dc2626;font-weight:bold">●</span> Tinggi (> +2 SD)<br>
        <span style="color:#000;font-weight:bold">●</span> Data Balita
    </div>
    `;

    ctx.insertAdjacentHTML('afterend', legendHTML);
}
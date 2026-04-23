function zScoreToValue(z, l, m, s) {
    if (!l || !m || !s) return null;

    if (l === 0) {
        return m * Math.exp(s * z);
    }
    return m * Math.pow(1 + l * s * z, 1 / l);
}

// ==============================
// 🔥 MINIMAL KENAIKAN
// ==============================
function getMinimalKenaikan(type, umur) {
    if (type === 'bb') {
        if (umur === 1) return 0.8;
        if (umur === 2) return 0.9;
        if (umur === 3) return 0.8;
        if (umur === 4) return 0.6;
        if (umur === 5) return 0.5;
        if (umur >= 6 && umur <= 7) return 0.4;
        if (umur >= 8 && umur <= 11) return 0.3;
        if (umur >= 12) return 0.2;
    } else {
        if (umur >= 0 && umur <= 3) return 3;
        if (umur >= 4 && umur <= 6) return 2;
        if (umur >= 7 && umur <= 12) return 1.5;
        if (umur >= 13) return 0.5;
    }
    return 0;
}

// ==============================
// 🔥 LABEL KURVA DI KANAN (FIX)
// ==============================
const lineLabelPlugin = {
    id: 'lineLabelPlugin',
    afterDatasetsDraw(chart) {
        const { ctx, chartArea } = chart;

        const labels = ['-3', '-2', '0', '+2', '+3'];

        chart.data.datasets.forEach((dataset, i) => {
            if (i > 4) return;

            const meta = chart.getDatasetMeta(i);
            const lastPoint = meta.data[meta.data.length - 1];
            if (!lastPoint) return;

            ctx.save();
            ctx.font = "bold 14px sans-serif";

            const x = chartArea.right + 8;
            const y = lastPoint.y;

            ctx.fillStyle = dataset.borderColor;
            ctx.fillText(labels[i], x, y + 4);

            ctx.restore();
        });
    }
};

function renderKMSChart(canvasId, type, gender, penimbangans, tanggalLahir) {

    const ctx = document.getElementById(canvasId);

    // ==============================
    // 🔥 JUDUL
    // ==============================
    const oldTitle = document.getElementById(canvasId + "_title");
    if (oldTitle) oldTitle.remove();

    const title = document.createElement('div');
    title.id = canvasId + "_title";
    title.style.marginTop = "24px";
    title.style.marginBottom = "12px";
    title.style.textAlign = "center";

    title.innerHTML = `
        <div style="font-size:22px;font-weight:700;color:#000;">
            ${type === 'bb'
            ? "Grafik Berat Badan (BB/U)"
            : "Grafik Tinggi Badan (TB/U)"}
        </div>
    `;

    ctx.insertAdjacentElement('beforebegin', title);

    // ==============================
    // 🔥 DATA WHO
    // ==============================
    const whoData = type === 'bb' ? window.whoBBU : window.whoTBU;

    const filtered = whoData
        .filter(item => {
            return (gender === 'l' || gender === 'laki-laki')
                ? item.jenis_kelamin === 'L'
                : item.jenis_kelamin === 'P';
        })
        .sort((a, b) => a.umur_bulan - b.umur_bulan);

    const who = { min3: [], min2: [], normal: [], plus2: [], plus3: [] };

    filtered.forEach(item => {
        who.min3.push(zScoreToValue(-3, item.l, item.m, item.s));
        who.min2.push(zScoreToValue(-2, item.l, item.m, item.s));
        who.normal.push(zScoreToValue(0, item.l, item.m, item.s));
        who.plus2.push(zScoreToValue(2, item.l, item.m, item.s));
        who.plus3.push(zScoreToValue(3, item.l, item.m, item.s));
    });

    let dataBalita = new Array(filtered.length).fill(null);
    const tglLahir = new Date(tanggalLahir);

    penimbangans.forEach(p => {
        const tglTimbang = new Date(p.tanggal_penimbangan);

        let umur = (tglTimbang.getFullYear() - tglLahir.getFullYear()) * 12;
        umur += tglTimbang.getMonth() - tglLahir.getMonth();

        if (umur >= 0 && umur < dataBalita.length) {
            dataBalita[umur] = type === 'bb'
                ? p.berat_badan
                : p.tinggi_badan;
        }
    });

    const labels = filtered.map(item => item.umur_bulan);

    // ==============================
    // 🔥 N/T
    // ==============================
    let statusNT = new Array(dataBalita.length).fill('');
    for (let i = 0; i < dataBalita.length; i++) {

        if (i === 0) {
            statusNT[i] = '-';
            continue;
        }

        if (dataBalita[i] !== null && dataBalita[i - 1] !== null) {
            let kenaikan = dataBalita[i] - dataBalita[i - 1];
            let minimal = getMinimalKenaikan(type, i);
            statusNT[i] = kenaikan >= minimal ? 'N' : 'T';
        } else {
            statusNT[i] = '-';
        }
    }

    // ==============================
    // 🔥 CHART
    // ==============================
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: '-3 SD',
                    data: who.min3,
                    borderColor: type === 'tb' ? '#7c2d12' : '#f97316',
                    borderDash: [5, 5],
                    borderWidth: 2,
                    pointRadius: 0
                },
                {
                    label: '-2 SD',
                    data: who.min2,
                    borderColor: type === 'tb' ? '#dc2626' : '#facc15',
                    borderWidth: 2,
                    pointRadius: 0
                },
                {
                    label: 'Median',
                    data: who.normal,
                    borderColor: '#16a34a',
                    borderWidth: 3,
                    pointRadius: 0
                },
                {
                    label: '+2 SD',
                    data: who.plus2,
                    borderColor: type === 'tb' ? '#dc2626' : '#16a34a',
                    borderWidth: 2,
                    pointRadius: 0
                },
                {
                    label: '+3 SD',
                    data: who.plus3,
                    borderColor: type === 'tb' ? '#7c2d12' : '#dc2626',
                    borderDash: [5, 5],
                    borderWidth: 2,
                    pointRadius: 0
                },
                {
                    label: 'Balita',
                    data: dataBalita,
                    borderColor: '#000',
                    backgroundColor: '#000',
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 5,
                    spanGaps: true
                }
            ]
        },
        options: {
            responsive: true,
            layout: {
                padding: {
                    right: 80
                }
            },
            plugins: { legend: { display: false } },
            scales: {
                x: { title: { display: true, text: 'Umur (bulan)' } },
                y: {
                    title: {
                        display: true,
                        text: type === 'bb' ? 'Berat Badan (kg)' : 'Tinggi Badan (cm)'
                    }
                }
            }
        },
        plugins: [lineLabelPlugin]
    });

    // ==============================
    // 🔥 LEGEND (SUDAH DIUBAH SESUAI PERMINTAAN)
    // ==============================
    let legend = document.createElement('div');
    legend.style.marginTop = "10px";

    const warna = type === 'tb'
        ? {
            plus3: '#7c2d12',
            plus2: '#dc2626',
            median: '#16a34a',
            min2: '#dc2626',
            min3: '#7c2d12'
        }
        : {
            plus3: '#dc2626',
            plus2: '#16a34a',
            median: '#16a34a',
            min2: '#facc15',
            min3: '#f97316'
        };

    legend.innerHTML = `
<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:8px; font-size:12px;">

    ${type === 'bb'
            ? `
        <div><span style="color:${warna.plus3};">━━━</span> > +3 SD = sangat tinggi / obesitas</div>
        <div><span style="color:${warna.plus2};">━━━</span> +2 SD s/d +3 SD = tinggi / resiko tinggi</div>
        <div><span style="color:${warna.median}; font-weight:bold;">━━━</span> -2 SD s/d +2 SD = normal</div>
        <div><span style="color:${warna.min2};">━━━</span> -2 SD s/d -3 SD = kurang</div>
        <div><span style="color:${warna.min3};">━━━</span> < -3 SD = sangat kurang</div>
        `
            : `
        <div><span style="color:${warna.plus3};">━━━</span> > +3 SD = sangat tinggi</div>
        <div><span style="color:${warna.plus2};">━━━</span> +2 SD s/d +3 SD = tinggi</div>
        <div><span style="color:${warna.median}; font-weight:bold;">━━━</span> -2 SD s/d +2 SD = normal</div>
        <div><span style="color:${warna.min2};">━━━</span> -2 SD s/d -3 SD = pendek / stunting</div>
        <div><span style="color:${warna.min3};">━━━</span> < -3 SD = sangat pendek / stunting berat</div>
        `
        }

</div>

<div style="text-align:center; margin-top:6px; font-size:12px;">
    <span style="color:#000;">●</span> Balita → ${type === 'bb' ? 'Data penimbangan' : 'Data pengukuran'}
</div>
`;

    ctx.insertAdjacentElement('afterend', legend);

    // ==============================
    // 🔥 TABEL (HANYA BB)
    // ==============================
    if (type === 'bb') {

        let umurCells = labels.map(l => `<td style="border:1px solid black; padding:4px;">${l}</td>`).join('');

        let kbmRow = `
            <td style="border:1px solid black; background:#f8fafc;">-</td>
            <td style="border:1px solid black;">800</td>
            <td style="border:1px solid black;">900</td>
            <td style="border:1px solid black;">800</td>
            <td style="border:1px solid black;">600</td>
            <td style="border:1px solid black;">500</td>
            <td colspan="2" style="border:1px solid black;">400</td>
            <td colspan="4" style="border:1px solid black;">300</td>
            <td colspan="${labels.length - 12}" style="border:1px solid black;">200</td>
        `;

        let ntCells = statusNT.map(s => {
            let bg = s === 'N' ? '#dcfce7' : s === 'T' ? '#fee2e2' : '#f1f5f9';
            let color = s === 'N' ? '#166534' : s === 'T' ? '#991b1b' : '#64748b';
            return `<td style="border:1px solid black; padding:4px; font-weight:bold; background:${bg}; color:${color};">${s}</td>`;
        }).join('');

        let table = document.createElement('div');
        table.style.overflowX = "auto";
        table.style.marginTop = "15px";

        table.innerHTML = `
        <div style="min-width:600px;">
            <table style="width:100%; border-collapse:collapse; text-align:center; font-size:12px; border:1px solid black;">
                <tr style="background:#f8fafc;">
                    <th style="border:1px solid black; padding:8px; width:100px;">UMUR</th>
                    ${umurCells}
                </tr>
                <tr>
                    <th style="border:1px solid black; padding:8px;">KBM (gr)</th>
                    ${kbmRow}
                </tr>
                <tr>
                    <th style="border:1px solid black; padding:8px;">N/T</th>
                    ${ntCells}
                </tr>
            </table>
        </div>
        `;

        legend.insertAdjacentElement('afterend', table);

        let info = document.createElement('div');
        info.style.marginTop = "8px";

        info.innerHTML = `
        <div style="font-size:12px; background:#f1f5f9; padding:8px; border-radius:6px;">
            <b>Keterangan:</b><br>
            KBM = batas minimal kenaikan<br>
            N = Naik (≥ KBM)<br>
            T = Tidak Naik (< KBM)<br>
            - = Data kosong / Bulan awal
        </div>
        `;

        table.insertAdjacentElement('afterend', info);
    }
}
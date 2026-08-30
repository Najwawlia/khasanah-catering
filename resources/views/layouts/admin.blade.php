<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Khasanah Catering')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('storage/images/logo__1_-removebg-preview.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;900&family=Crimson+Text:ital,wght@0,400;0,600;1,400;1,600&family=Italianno&family=Newsreader:ital,opsz,wght@0,6..72,300;0,6..72,400;0,6..72,500;0,6..72,600;0,6..72,700;1,6..72,400&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
    :root {
        --bg:       #FAF6EF;
        --surface:  #FFFFFF;
        --border:   #EFE4D4;
        --border-2: #F5EEE1;

        --ink:      #2B2119;
        --ink-2:    #4A3B2C;
        --ink-3:    #8A7C6D;
        --ink-4:    #BFB09B;

        --accent:   #B5502E;
        --accent-h: #963F22;
        --accent-s: #F3E1D6;

        --sb-bg:    #F1ECDD;
        --sb-hover: rgba(43,33,25,.05);
        --sb-text:  #8A7C6D;
        --sb-hi:    rgba(43,33,25,.88);
        --sb-bdr:   rgba(43,33,25,.08);

        --green:   #4F5F41;
        --green-s: #E7EDDF;
        --red:     #A73A3A;
        --red-s:   #F5DCDC;
        --gold:    #8C6A1F;
        --gold-s:  #F7ECD3;
        --coral:   #A65B4E;
        --coral-s: #F5DFDA;

        --r: 12px;
        --d: 160ms;
        --e: cubic-bezier(.4,0,.2,1);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Newsreader', 'Crimson Text', Georgia, serif;
        background: var(--bg);
        color: var(--ink);
        display: flex;
        min-height: 100vh;
        font-size: 14px;
        line-height: 1.5;
        -webkit-font-smoothing: antialiased;
    }

    a { color: inherit; text-decoration: none; }
    button { font-family: inherit; }

    @keyframes in { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:none; } }

    /* ─── SIDEBAR ─────────────────────────────────────────────── */
    .sb {
        width: 220px;
        min-width: 220px;
        background: var(--sb-bg);
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: sticky;
        top: 0;
        overflow-y: auto;
        scrollbar-width: none;
        border-right: 1px solid var(--sb-bdr);
        z-index: 50;
    }
    .sb::-webkit-scrollbar { display: none; }

    .sb-top {
        padding: 18px 16px;
        border-bottom: 1px solid var(--sb-bdr);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sb-mark {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: .7rem;
        flex-shrink: 0;
    }
    .sb-mark img { width: 100%; height: 100%; object-fit: contain; }

    .sb-name {
        font-family: 'Cinzel', Georgia, serif;
        font-size: .8rem;
        font-weight: 600;
        color: var(--sb-hi);
        letter-spacing: .09em;
        text-transform: uppercase;
        line-height: 1.2;
    }
    .sb-accent {
        font-family: 'Italianno', cursive;
        font-size: 1.15rem;
        color: var(--accent);
        line-height: 1;
        margin-top: 1px;
    }
    .sb-role {
        font-size: .6rem;
        font-family: 'JetBrains Mono', monospace;
        color: var(--sb-text);
        letter-spacing: .06em;
        text-transform: uppercase;
        margin-top: 1px;
    }

    .sb-nav { flex: 1; padding: 10px 8px; }

    .sb-sect {
        font-family: 'JetBrains Mono', monospace;
        font-size: .55rem;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #3D3025;
        padding: 14px 8px 5px;
    }

    .sb-a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 7px 9px;
        border-radius: 6px;
        color: var(--sb-text);
        font-size: .81rem;
        font-weight: 500;
        transition: all var(--d) var(--e);
        margin-bottom: 1px;
        position: relative;
    }
    .sb-a i { width: 14px; text-align: center; font-size: .72rem; }
    .sb-a:hover { background: var(--sb-hover); color: var(--ink); }
    .sb-a.on {
        background: var(--accent-s);
        color: var(--accent-h);
        font-weight: 600;
    }
    .sb-a.on::before {
        content: '';
        position: absolute;
        left: 0; top: 30%; bottom: 30%;
        width: 2px;
        border-radius: 0 2px 2px 0;
        background: var(--accent);
    }

    .sb-footer {
        padding: 10px 8px 14px;
        border-top: 1px solid var(--sb-bdr);
    }
    .sb-user {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 9px;
        border-radius: 6px;
        background: rgba(43,33,25,.035);
        margin-bottom: 7px;
    }
    .sb-av {
        width: 30px; height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-h));
        color: #fff;
        font-size: .72rem;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sb-uname { font-size: .78rem; font-weight: 600; color: var(--ink); }
    .sb-urole { font-size: .6rem; font-family: 'JetBrains Mono', monospace; color: var(--sb-text); }
    .sb-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #22C55E;
        margin-left: auto;
        flex-shrink: 0;
    }

    .sb-out {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 7px;
        border-radius: 6px;
        border: 1px solid var(--sb-bdr);
        background: transparent;
        color: #5A4838;
        font-size: .76rem;
        font-weight: 600;
        cursor: pointer;
        transition: all var(--d) var(--e);
    }
    .sb-out:hover { background: var(--red-s); border-color: rgba(167,58,58,.3); color: var(--red); }

    /* ─── MAIN ─────────────────────────────────────────────────── */
    .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }

    .bar {
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 24px;
        background: rgba(250,246,239,.92);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--border);
        position: sticky;
        top: 0;
        z-index: 40;
    }

    .bar-left {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .78rem;
        color: var(--ink-3);
    }
    .bar-left b { color: var(--ink); font-weight: 600; }
    .bar-right { display: flex; align-items: center; gap: 8px; }

    .bar-clock {
        font-family: 'JetBrains Mono', monospace;
        font-size: .68rem;
        color: var(--ink-3);
        padding: 3px 9px;
        background: var(--border-2);
        border-radius: 100px;
    }

    .bar-prof {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 3px 9px 3px 3px;
        border: 1px solid var(--border);
        border-radius: 6px;
        background: var(--surface);
        font-size: .78rem;
        font-weight: 600;
        cursor: pointer;
        transition: border-color var(--d);
    }
    .bar-prof:hover { border-color: var(--accent); }
    .bar-prof-av {
        width: 26px; height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-h));
        color: #fff;
        font-size: .68rem;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
    }

    /* ─── CONTENT ──────────────────────────────────────────────── */
    .pg {
        flex: 1;
        padding: 28px 28px 48px;
        animation: in .25s var(--e) both;
    }

    /* ─── PAGE HEADER ──────────────────────────────────────────── */
    .ph {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
        gap: 16px;
        flex-wrap: wrap;
    }
    .ph-title {
        font-family: 'Cinzel', Georgia, serif;
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--ink);
        letter-spacing: .015em;
        line-height: 1.25;
    }
    .ph-sub {
        font-size: .8rem;
        color: var(--ink-3);
        margin-top: 4px;
    }

    /* ─── FLASH ────────────────────────────────────────────────── */
    .flash {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 11px 15px;
        border-radius: var(--r);
        font-size: .83rem;
        font-weight: 500;
        margin-bottom: 18px;
        border: 1px solid;
    }
    .flash-ok { background: var(--green-s); color: var(--green); border-color: rgba(79,95,65,.25); }

    /* ─── STAT ROW (thin bar, no cards) ───────────────────────── */
    .stat-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        border: 1px solid var(--border);
        border-radius: var(--r);
        background: var(--surface);
        overflow: hidden;
        margin-bottom: 22px;
    }

    .stat {
        padding: 16px 20px;
        border-right: 1px solid var(--border);
        transition: background var(--d);
    }
    .stat:last-child { border-right: none; }
    .stat:hover { background: var(--bg); }

    .stat-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: .6rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--ink-3);
        margin-bottom: 6px;
    }

    .stat-val {
        font-size: 1.55rem;
        font-weight: 800;
        color: var(--ink);
        letter-spacing: -.04em;
        line-height: 1;
        font-family: 'JetBrains Mono', monospace;
    }
    .stat-val.accent { color: var(--accent); }

    .stat-foot {
        font-size: .7rem;
        color: var(--ink-4);
        margin-top: 4px;
    }

    /* ─── PANELS ───────────────────────────────────────────────── */
    .box {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
    }

    .box-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px;
        border-bottom: 1.5px dashed var(--border);
    }

    .box-title {
        font-family: 'Cinzel', Georgia, serif;
        font-size: .82rem;
        font-weight: 600;
        color: var(--ink);
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    .box-sub {
        font-size: .72rem;
        color: var(--ink-3);
        margin-top: 2px;
    }

    .box-link {
        font-size: .75rem;
        font-weight: 600;
        color: var(--accent);
        transition: opacity var(--d);
    }
    .box-link:hover { opacity: .7; }

    .box-body { padding: 16px 18px; }

    /* ─── 2-col grid ───────────────────────────────────────────── */
    .g2 { display: grid; grid-template-columns: 1.6fr 1fr; gap: 14px; margin-bottom: 14px; }
    @media (max-width: 1060px) { .g2 { grid-template-columns: 1fr; } }

    /* ─── SEG BAR ──────────────────────────────────────────────── */
    .seg {
        height: 8px;
        border-radius: 100px;
        display: flex;
        overflow: hidden;
        background: var(--border-2);
        margin-bottom: 14px;
    }
    .seg-s { height: 100%; transition: opacity .2s; }
    .seg-s:first-child { border-radius: 100px 0 0 100px; }
    .seg-s:last-child  { border-radius: 0 100px 100px 0; }
    .seg-s:hover { opacity: .75; }

    .seg-leg { display: flex; flex-wrap: wrap; gap: 7px 16px; }
    .seg-leg-item { display: flex; align-items: center; gap: 6px; font-size: .77rem; }
    .seg-leg-dot { width: 7px; height: 7px; border-radius: 2px; flex-shrink: 0; }
    .seg-leg-item strong { font-weight: 600; }
    .seg-leg-item span  { color: var(--ink-3); font-size: .7rem; }

    /* ─── PENDING LIST ─────────────────────────────────────────── */
    .pend {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid var(--border-2);
        transition: background var(--d);
    }
    .pend:last-child { border-bottom: none; }
    .pend:hover { background: var(--bg); margin: 0 -18px; padding: 10px 18px; }

    .pend-av {
        width: 30px; height: 30px;
        border-radius: 7px;
        background: var(--accent-s);
        color: var(--accent);
        font-weight: 700; font-size: .75rem;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .pend-name { font-weight: 600; font-size: .82rem; }
    .pend-code { font-family: 'JetBrains Mono', monospace; font-size: .66rem; color: var(--ink-3); }
    .pend-amt  { margin-left: auto; font-weight: 700; font-size: .82rem; color: var(--accent); white-space: nowrap; }

    /* ─── TABLE ────────────────────────────────────────────────── */
    .t-wrap { overflow-x: auto; }

    table { width: 100%; border-collapse: collapse; text-align: left; }

    thead th {
        font-family: 'JetBrains Mono', monospace;
        font-size: .58rem;
        font-weight: 600;
        letter-spacing: .09em;
        text-transform: uppercase;
        color: var(--ink-3);
        padding: 10px 16px;
        border-bottom: 1px solid var(--border);
        background: var(--bg);
        white-space: nowrap;
    }

    tbody td {
        padding: 11px 16px;
        font-size: .82rem;
        border-bottom: 1px solid var(--border-2);
        color: var(--ink);
        vertical-align: middle;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: rgba(181,80,46,.04); }

    .t-mono  { font-family: 'JetBrains Mono', monospace; font-size: .74rem; }
    .t-acc   { font-family: 'JetBrains Mono', monospace; font-size: .78rem; font-weight: 700; color: var(--accent); }
    .t-bold  { font-weight: 700; }
    .t-muted { color: var(--ink-3); font-size: .76rem; }

    .t-thumb {
        width: 38px; height: 38px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid var(--border);
        display: block;
    }
    .t-av {
        width: 30px; height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-h));
        color: #fff;
        font-weight: 700; font-size: .72rem;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* ─── TAGS / STATUS ────────────────────────────────────────── */
    .tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: .68rem;
        font-weight: 600;
        letter-spacing: .02em;
        border: 1px solid transparent;
        white-space: nowrap;
    }
    .tag-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }

    .t-ok     { background: var(--green-s); color: var(--green);  border-color: rgba(79,95,65,.2); }
    .t-warn   { background: var(--gold-s);  color: var(--gold);   border-color: rgba(140,106,31,.2); }
    .t-acc-t  { background: var(--accent-s); color: var(--accent); border-color: rgba(181,80,46,.2); }
    .t-err    { background: var(--red-s);   color: var(--red);    border-color: rgba(167,58,58,.2); }
    .t-neu    { background: var(--bg);      color: var(--ink-2);  border-color: var(--border); }

    /* ─── TRACKING SELECT ──────────────────────────────────────── */
    .tsel {
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 4px 26px 4px 9px;
        font-family: 'JetBrains Mono', monospace;
        font-size: .62rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .04em;
        outline: none;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='5'%3E%3Cpath d='M0 0l4 5 4-5z' fill='%238A7A6A'/%3E%3C/svg%3E");
        transition: border-color var(--d);
    }
    .tsel:hover { border-color: var(--accent); }
    .tsel-booking_received { background-color: var(--coral-s);  color: var(--coral); border-color: rgba(166,91,78,.3); }
    .tsel-payment_verified { background-color: var(--gold-s);   color: var(--gold);  border-color: rgba(140,106,31,.3); }
    .tsel-kitchen_prep     { background-color: var(--accent-s); color: var(--accent); border-color: rgba(181,80,46,.3); }
    .tsel-ready            { background-color: var(--green-s);  color: var(--green); border-color: rgba(79,95,65,.3); }

    /* ─── SEARCH ───────────────────────────────────────────────── */
    .srch {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: 8px 12px;
        transition: border-color var(--d);
    }
    .srch:focus-within { border-color: var(--accent); }
    .srch i { color: var(--ink-4); font-size: .75rem; }
    .srch input {
        border: none; background: transparent; outline: none;
        font-family: inherit; font-size: .82rem; color: var(--ink); width: 100%;
    }
    .srch input::placeholder { color: var(--ink-4); }

    /* ─── FILTER SELECT ────────────────────────────────────────── */
    .fsel {
        background: var(--surface);
        border: 1px solid var(--border);
        color: var(--ink);
        padding: 8px 30px 8px 12px;
        border-radius: var(--r);
        outline: none;
        font-family: inherit;
        font-size: .82rem;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='9' height='5'%3E%3Cpath d='M0 0l4.5 5L9 0z' fill='%238A7A6A'/%3E%3C/svg%3E");
        transition: border-color var(--d);
    }
    .fsel:focus { border-color: var(--accent); }

    /* ─── BUTTONS ──────────────────────────────────────────────── */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 15px;
        border-radius: var(--r);
        font-family: inherit;
        font-size: .8rem;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        transition: all var(--d) var(--e);
        white-space: nowrap;
    }

    .btn-p {
        background: var(--accent);
        color: #fff;
        box-shadow: 0 1px 3px rgba(181,80,46,.3);
    }
    .btn-p:hover { background: var(--accent-h); box-shadow: 0 3px 10px rgba(181,80,46,.3); }

    .btn-g {
        background: var(--surface);
        color: var(--ink-2);
        border-color: var(--border);
    }
    .btn-g:hover { background: var(--bg); border-color: var(--ink-4); }

    .btn-r {
        background: var(--surface);
        color: var(--red);
        border-color: var(--border);
    }
    .btn-r:hover { background: var(--red-s); border-color: rgba(181,54,54,.3); }

    .btn-sm { padding: 6px 11px; font-size: .74rem; }
    .btn-lg { padding: 10px 20px; font-size: .85rem; }
    .btn-sq { width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; }

    /* ─── FORMS ────────────────────────────────────────────────── */
    .fg { margin-bottom: 16px; }
    .fl {
        display: block;
        font-size: .79rem;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 6px;
    }
    .fl .req { color: var(--accent); margin-left: 2px; }

    .fi, .ft, .fs {
        width: 100%;
        background: var(--surface);
        border: 1px solid var(--border);
        color: var(--ink);
        padding: 9px 12px;
        border-radius: var(--r);
        font-family: inherit;
        font-size: .83rem;
        outline: none;
        transition: border-color var(--d);
    }
    .fi:focus, .ft:focus, .fs:focus { border-color: var(--accent); }
    .ft { resize: vertical; min-height: 100px; }
    .fh { font-size: .72rem; color: var(--ink-3); margin-top: 4px; }
    .fe { font-size: .74rem; color: var(--red); margin-top: 4px; }
    .f2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    .fck {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: var(--r);
        border: 1px solid var(--border);
        background: var(--surface);
        cursor: pointer;
        transition: border-color var(--d);
    }
    .fck:hover { border-color: var(--accent); }
    .fck input { width: 16px; height: 16px; accent-color: var(--accent); cursor: pointer; flex-shrink: 0; }
    .fck-lbl { font-size: .82rem; font-weight: 500; }

    /* ─── UPLOAD ───────────────────────────────────────────────── */
    .upl {
        position: relative;
        border: 2px dashed var(--border);
        border-radius: var(--r);
        padding: 24px 18px;
        text-align: center;
        cursor: pointer;
        background: var(--bg);
        transition: all var(--d);
    }
    .upl:hover, .upl.drag { border-color: var(--accent); background: var(--accent-s); }
    .upl input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }

    /* ─── CATEGORY CARDS ───────────────────────────────────────── */
    .cgrid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px; }

    .ccard {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all var(--d) var(--e);
    }
    .ccard:hover { border-color: var(--accent); box-shadow: 0 2px 12px rgba(181,80,46,.1); transform: translateY(-1px); }

    .cico {
        width: 42px; height: 42px;
        border-radius: var(--r);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
        background: var(--bg);
        color: var(--ink-2);
        border: 1px solid var(--border);
    }
    .ccard:hover .cico { background: var(--accent-s); color: var(--accent); border-color: rgba(181,80,46,.2); }

    .cname { font-weight: 700; font-size: .9rem; }
    .ccnt  { font-family: 'JetBrains Mono', monospace; font-size: .68rem; color: var(--ink-3); margin-top: 2px; }
    .carr  { margin-left: auto; color: var(--ink-4); font-size: .72rem; transition: all var(--d); }
    .ccard:hover .carr { color: var(--accent); transform: translateX(2px); }

    /* ─── RANK ─────────────────────────────────────────────────── */
    .rrow {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 0;
        border-bottom: 1px solid var(--border-2);
    }
    .rrow:last-child { border-bottom: none; }

    .rnum {
        width: 26px; height: 26px;
        border-radius: 6px;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700; font-size: .74rem;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .rn1 { background: var(--accent); color: #fff; }
    .rn2 { background: var(--gold);   color: #fff; }
    .rn3 { background: var(--coral);  color: #fff; }
    .rnx { background: var(--bg);     color: var(--ink-3); border: 1px solid var(--border); }

    /* ─── TIMELINE ─────────────────────────────────────────────── */
    .tl { display: flex; flex-direction: column; }
    .tl-step { display: flex; gap: 13px; position: relative; }
    .tl-step::before { content:''; position:absolute; left:12px; top:27px; bottom:0; width:1px; background:var(--border-2); }
    .tl-step:last-child::before { display: none; }

    .tl-dot {
        width: 26px; height: 26px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; font-size: .66rem; z-index: 1;
        border: 1px solid var(--border);
        background: var(--surface); color: var(--ink-3);
    }
    .tl-dot.done    { background: var(--green);  border-color: var(--green);  color: #fff; }
    .tl-dot.cur     { background: var(--accent); border-color: var(--accent); color: #fff; box-shadow: 0 0 0 3px var(--accent-s); }

    .tl-body { padding-bottom: 20px; flex: 1; }
    .tl-lbl  { font-size: .82rem; font-weight: 600; }
    .tl-sub  { font-size: .72rem; color: var(--ink-3); margin-top: 1px; }

    /* ─── CHART ────────────────────────────────────────────────── */
    .ch-wrap { position: relative; height: 260px; }

    /* ─── RESPONSIVE ───────────────────────────────────────────── */
    @media (max-width: 860px) {
        .sb { display: none; }
        .pg { padding: 16px 14px 36px; }
        .bar { padding: 0 14px; }
        .stat-row { grid-template-columns: 1fr 1fr; }
        .f2 { grid-template-columns: 1fr; }
    }
    @media (max-width: 500px) {
        .stat-row { grid-template-columns: 1fr; }
    }
    </style>
    @yield('styles')
</head>
<body>

<aside class="sb">
    <div class="sb-top">
        <div class="sb-mark"><img src="{{ asset('storage/images/logo__1_-removebg-preview.png') }}" alt="Khasanah Catering"></div>
        <div>
            <div class="sb-name">Khasanah</div>
            <div class="sb-accent">Catering</div>
            <div class="sb-role">Admin Panel</div>
        </div>
    </div>

    <nav class="sb-nav">
        <div class="sb-sect">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="sb-a {{ request()->routeIs('admin.dashboard') ? 'on':'' }}">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>

        <div class="sb-sect">Katalog</div>
        <a href="{{ route('admin.menus.index') }}" class="sb-a {{ request()->routeIs('admin.menus.index','admin.menus.create','admin.menus.edit') ? 'on':'' }}">
            <i class="fa-solid fa-utensils"></i> Kelola Menu
        </a>
        <a href="{{ route('admin.menus.categories') }}" class="sb-a {{ request()->routeIs('admin.menus.categories') ? 'on':'' }}">
            <i class="fa-solid fa-layer-group"></i> Kategori
        </a>

        <div class="sb-sect">Transaksi</div>
        <a href="{{ route('admin.orders.index') }}" class="sb-a {{ request()->routeIs('admin.orders.*') ? 'on':'' }}">
            <i class="fa-solid fa-receipt"></i> Pesanan
        </a>
        <a href="{{ route('admin.customers.index') }}" class="sb-a {{ request()->routeIs('admin.customers.*') ? 'on':'' }}">
            <i class="fa-solid fa-users"></i> Pelanggan
        </a>

        <div class="sb-sect">Lainnya</div>
        <a href="{{ route('home') }}" class="sb-a">
            <i class="fa-solid fa-arrow-left"></i> Lihat Website
        </a>
    </nav>

    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-av">A</div>
            <div>
                <div class="sb-uname">Administrator</div>
                <div class="sb-urole">Super Admin</div>
            </div>
            <div class="sb-dot"></div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="sb-out" type="submit">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="bar">
        <div class="bar-left">
            <i class="fa-solid fa-slash" style="font-size:.5rem; transform:rotate(30deg); opacity:.4;"></i>
            <b>@yield('admin-title','Dashboard')</b>
        </div>
        <div class="bar-right">
            <span class="bar-clock" id="lc">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</span>
            <div class="bar-prof">
                <div class="bar-prof-av">A</div>
                Admin
            </div>
        </div>
    </header>

    <main class="pg">
        @if(session('success'))
            <div class="flash flash-ok">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</div>

<script>
(function(){
    function tick(){
        var d=new Date(),e=document.getElementById('lc');
        if(e) e.textContent=(d.getHours()+'').padStart(2,'0')+':'+(d.getMinutes()+'').padStart(2,'0')+' WIB';
    }
    setInterval(tick,15000);
})();
</script>
@yield('scripts')
</body>
</html>

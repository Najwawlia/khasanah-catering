<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — Khasanah Catering')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('storage/images/logo__1_-removebg-preview.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;900&family=Manrope:wght@400;500;600;700;800&family=Italianno&family=Newsreader:ital,opsz,wght@0,6..72,300;0,6..72,400;0,6..72,500;0,6..72,600;0,6..72,700;1,6..72,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
    :root {
        --bg:        #FAF6EF;
        --surface:   #FFFFFF;
        --surface-2: #F8F1E7;
        --border:    #EFE4D4;
        --border-2:  #F5EEE1;

        --ink:   #2B2119;
        --ink-2: #4A3B2C;
        --ink-3: #8A7C6D;
        --ink-4: #BFB09B;

        --accent:   #B5502E;
        --accent-h: #963F22;
        --accent-s: #F3E1D6;

        --sb-hover: rgba(43,33,25,.05);
        --sb-text:  #8A7C6D;
        --sb-hi:    #2B2119;
        --sb-bdr:   rgba(43,33,25,.08);

        --gold:   #8C6A1F;
        --gold-s: #F7ECD3;

        --green:   #4F5F41;
        --green-s: #E7EDDF;
        --red:     #B23A3A;
        --red-s:   #F5DCDC;
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

    @keyframes in { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:none; } }

    /* ─── SIDEBAR — clean, matches site navbar ─────────────────── */
    .sb {
        width: 232px;
        min-width: 232px;
        display: flex;
        flex-direction: column;
        height: 100vh;
        position: sticky;
        top: 0;
        overflow-y: auto;
        scrollbar-width: none;
        z-index: 50;
        color: var(--sb-text);
        background: var(--surface);
        border-right: 1px solid var(--border);
    }
    .sb::-webkit-scrollbar { display: none; }

    .sb-top {
        padding: 20px 18px;
        border-bottom: 1px solid var(--sb-bdr);
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .sb-mark {
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        object-fit: contain;
    }

    .sb-name {
        font-family: 'Cinzel', Georgia, serif;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .16em;
        text-transform: uppercase;
        line-height: 1.2;
        color: var(--ink);
    }
    .sb-accent {
        font-family: 'Italianno', cursive;
        font-size: 1.5rem;
        line-height: 1;
        margin-top: -1px;
        display: block;
        background: linear-gradient(100deg, var(--accent), var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .sb-role {
        font-size: .6rem;
        font-family: 'Manrope', sans-serif;
        color: var(--ink-4);
        letter-spacing: .06em;
        text-transform: uppercase;
        margin-top: 2px;
    }

    .sb-nav { flex: 1; padding: 12px 10px; }

    .sb-sect {
        font-family: 'Manrope', sans-serif;
        font-size: .58rem;
        font-weight: 600;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--ink-4);
        padding: 15px 8px 6px;
    }
    .sb-sect:first-child { padding-top: 4px; }

    .sb-a {
        font-family: 'Manrope', sans-serif;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 10px;
        border-radius: 8px;
        color: var(--sb-text);
        font-size: .81rem;
        font-weight: 500;
        transition: all var(--d) var(--e);
        margin-bottom: 1px;
        position: relative;
    }
    .sb-a i { width: 15px; text-align: center; font-size: .74rem; color: var(--ink-4); }
    .sb-a:hover { background: var(--sb-hover); color: var(--ink); }
    .sb-a.on {
        background: var(--accent-s);
        color: var(--accent-h);
        font-weight: 700;
    }
    .sb-a.on i { color: var(--accent); }
    .sb-a.on::before {
        content: '';
        position: absolute;
        left: -10px; top: 26%; bottom: 26%;
        width: 3px;
        border-radius: 0 3px 3px 0;
        background: var(--accent);
    }

    .sb-footer {
        padding: 12px 12px 16px;
        border-top: 1px solid var(--sb-bdr);
    }
    .sb-user {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 8px 9px;
        border-radius: 9px;
        background: var(--bg);
        margin-bottom: 9px;
    }
    .sb-av {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-h));
        color: #fff;
        font-family: 'Cinzel', Georgia, serif;
        font-size: .74rem;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        position: relative;
    }
    .sb-av::after {
        content: '';
        position: absolute; inset: -2px;
        border-radius: 50%;
        border: 1.5px solid #22C55E;
    }
    .sb-uname { font-family: 'Manrope', sans-serif; font-size: .8rem; font-weight: 700; color: var(--sb-hi); }
    .sb-urole { font-size: .6rem; font-family: 'Manrope', sans-serif; color: var(--ink-4); margin-top: 1px; }
    .sb-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #22C55E;
        margin-left: auto;
        flex-shrink: 0;
    }

    .sb-out {
        width: 100%;
        font-family: 'Manrope', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 8px;
        border-radius: 8px;
        border: 1px solid var(--sb-bdr);
        background: transparent;
        font-size: .78rem;
        font-weight: 600;
        color: var(--ink-3);
        cursor: pointer;
        transition: all var(--d) var(--e);
    }
    .sb-out:hover { background: var(--red-s); border-color: rgba(178,58,58,.3); color: var(--red); }

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
        gap: 9px;
        font-family: 'Manrope', sans-serif;
        font-size: .76rem;
        color: var(--ink-3);
    }
    .bar-left b { font-family: 'Cinzel', Georgia, serif; font-size: .88rem; font-weight: 600; color: var(--ink); letter-spacing: .02em; }
    .bar-right { display: flex; align-items: center; gap: 14px; }

    .bar-clock {
        font-family: 'Manrope', sans-serif;
        font-size: .76rem;
        font-weight: 600;
        letter-spacing: .03em;
        color: var(--ink-2);
        padding: 6px 12px;
        background: var(--surface-2);
        border: 1px solid var(--border);
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .bar-clock i { font-size: .7rem; color: var(--gold); }

    .bar-prof {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 4px 12px 4px 4px;
        border: 1px solid var(--border);
        border-radius: 20px;
        background: var(--surface);
        font-family: 'Manrope', sans-serif;
        font-size: .78rem;
        font-weight: 700;
        cursor: pointer;
        transition: border-color var(--d);
    }
    .bar-prof:hover { border-color: var(--accent); }
    .bar-prof-av {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-h));
        color: #fff;
        font-family: 'Cinzel', Georgia, serif;
        font-size: .72rem;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
    }

    /* ─── NOTIFICATION BELL ────────────────────────────────────── */
    .bell-wrap { position: relative; }
    .bell-btn {
        width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        color: var(--ink-2);
        font-size: .9rem;
        cursor: pointer;
        position: relative;
        transition: border-color var(--d);
    }
    .bell-btn:hover { border-color: var(--accent); color: var(--accent); }
    .bell-badge {
        position: absolute;
        top: -5px; right: -5px;
        min-width: 17px; height: 17px;
        padding: 0 4px;
        border-radius: 100px;
        background: var(--red);
        color: #fff;
        font-size: .6rem;
        font-weight: 700;
        display: none;
        align-items: center; justify-content: center;
        border: 2px solid var(--bg);
    }
    .bell-panel {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: 320px;
        max-height: 400px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        box-shadow: 0 16px 40px rgba(43,33,25,.16);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 60;
    }
    .bell-panel.open { display: flex; animation: in .16s var(--e) both; }
    .bell-panel-head {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 14px;
        border-bottom: 1px solid var(--border-2);
        font-size: .78rem; font-weight: 700; color: var(--ink);
    }
    .bell-panel-head button {
        background: none; border: none; cursor: pointer;
        font-size: .68rem; font-weight: 600; color: var(--accent);
        font-family: inherit;
    }
    .bell-panel-head button:hover { text-decoration: underline; }
    .bell-panel-body { overflow-y: auto; flex: 1; }
    .bell-item {
        display: block;
        padding: 11px 14px;
        border-bottom: 1px solid var(--border-2);
        transition: background var(--d);
    }
    .bell-item:hover { background: var(--border-2); }
    .bell-item-top { display: flex; justify-content: space-between; margin-bottom: 3px; }
    .bell-item-code { font-family: 'Manrope', sans-serif; font-size: .68rem; font-weight: 700; color: var(--accent); }
    .bell-item-time { font-size: .64rem; color: var(--ink-4); }
    .bell-item-name { font-size: .8rem; font-weight: 700; color: var(--ink); margin-bottom: 2px; }
    .bell-item-meta { font-size: .7rem; color: var(--ink-3); }
    .bell-empty { padding: 26px 14px; text-align: center; font-size: .76rem; color: var(--ink-4); }

    /* ─── CONFIRM MODAL (dipakai untuk hapus data & logout) ───────── */
    .cfm-overlay {
        position: fixed; inset: 0;
        background: rgba(43,33,25,.45);
        display: none; align-items: center; justify-content: center;
        z-index: 999; padding: 20px;
    }
    .cfm-overlay.open { display: flex; animation: cfmFade .15s var(--e); }
    @keyframes cfmFade { from { opacity: 0; } to { opacity: 1; } }
    .cfm-box {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        max-width: 380px; width: 100%;
        padding: 28px 26px 22px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(43,33,25,.25);
        animation: cfmPop .2s var(--e);
    }
    @keyframes cfmPop { from { opacity: 0; transform: scale(.94) translateY(6px); } to { opacity: 1; transform: none; } }
    .cfm-icon {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: var(--red-s); color: var(--red);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; margin: 0 auto 14px;
    }
    .cfm-icon.info { background: var(--accent-s); color: var(--accent); }
    .cfm-title { font-family: 'Cinzel', Georgia, serif; font-size: 1.05rem; color: var(--ink); margin-bottom: 8px; }
    .cfm-msg { font-size: .85rem; color: var(--ink-3); line-height: 1.55; margin-bottom: 22px; }
    .cfm-actions { display: flex; gap: 10px; }
    .cfm-btn {
        flex: 1; padding: 11px; border-radius: 10px;
        font-size: .84rem; font-weight: 700; cursor: pointer;
        border: 1px solid transparent; font-family: inherit;
        transition: all var(--d) var(--e);
    }
    .cfm-btn-cancel { background: var(--border-2); color: var(--ink-2); }
    .cfm-btn-cancel:hover { background: var(--border); }
    .cfm-btn-confirm { background: var(--red); color: #fff; }
    .cfm-btn-confirm:hover { background: #8A2E2E; }
    .cfm-btn-confirm.info-variant { background: var(--accent); }
    .cfm-btn-confirm.info-variant:hover { background: var(--accent-h); }

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
    .ph-row { display: flex; align-items: center; gap: 14px; }
    .ph-badge {
        width: 40px; height: 40px; border-radius: 10px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: .95rem;
        background: var(--accent-s);
        color: var(--accent-h);
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
        font-family: 'Manrope', sans-serif;
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
    .flash-err { background: rgba(220,38,38,.1); color: var(--red, #DC2626); border-color: rgba(220,38,38,.25); }

    /* ─── STAT ROW — elevated jewel-tone cards ─────────────────── */
    .stat-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .stat {
        --accent-line: var(--accent);
        --accent-s2: var(--accent-s);
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        padding: 18px 18px 16px;
        position: relative;
        overflow: hidden;
        transition: transform var(--d) var(--e), box-shadow var(--d) var(--e);
    }
    .stat:hover { transform: translateY(-2px); box-shadow: 0 10px 20px -14px rgba(43,33,25,.3); }
    .stat::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
        background: var(--accent-line);
    }
    .stat.sapphire { --accent-line: var(--gold);  --accent-s2: var(--gold-s); }
    .stat.emerald  { --accent-line: var(--green); --accent-s2: var(--green-s); }
    .stat.teal     { --accent-line: var(--coral); --accent-s2: var(--coral-s); }
    .stat.amber    { --accent-line: var(--red);   --accent-s2: var(--red-s); }

    .stat-ic {
        width: 32px; height: 32px; border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: .82rem; margin-bottom: 11px;
        background: var(--accent-s2); color: var(--accent-line);
    }

    .stat-label {
        font-family: 'Manrope', sans-serif;
        font-size: .67rem;
        font-weight: 700;
        letter-spacing: .03em;
        color: var(--ink-3);
        margin-bottom: 6px;
    }

    .stat-val {
        font-size: 1.45rem;
        font-weight: 700;
        color: var(--ink);
        letter-spacing: 0;
        line-height: 1.15;
        font-family: 'Cinzel', Georgia, serif;
    }
    .stat-val.accent { color: var(--accent-line); }

    .stat-foot {
        font-family: 'Manrope', sans-serif;
        font-size: .68rem;
        color: var(--ink-4);
        margin-top: 5px;
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
        padding: 18px 20px 14px;
        border-bottom: 1px solid var(--border-2);
    }

    .box-title {
        font-family: 'Cinzel', Georgia, serif;
        font-size: .92rem;
        font-weight: 600;
        color: var(--ink);
        letter-spacing: .03em;
    }

    .box-sub {
        font-family: 'Manrope', sans-serif;
        font-size: .72rem;
        color: var(--ink-3);
        margin-top: 3px;
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

    .seg-leg { display: grid; grid-template-columns: 1fr 1fr; gap: 10px 16px; }
    .seg-leg-item { display: flex; align-items: center; gap: 8px; font-family: 'Manrope', sans-serif; font-size: .75rem; }
    .seg-leg-dot { width: 9px; height: 9px; border-radius: 3px; flex-shrink: 0; }
    .seg-leg-item strong { font-weight: 700; color: var(--ink-2); flex: 1; }
    .seg-leg-item span  { color: var(--ink-3); font-family: 'Manrope', sans-serif; font-size: .68rem; }
    @media (max-width: 520px) { .seg-leg { grid-template-columns: 1fr; } }

    /* ─── HORIZONTAL BAR CHART (Sebaran Menu) ─────────────────── */
    .hbar { display: flex; flex-direction: column; gap: 13px; margin-bottom: 18px; }
    .hbar-row { display: flex; align-items: center; gap: 12px; }
    .hbar-label { font-family: 'Manrope', sans-serif; font-size: .76rem; font-weight: 600; color: var(--ink-2); width: 42%; flex-shrink: 0; }
    .hbar-track { flex: 1; height: 12px; border-radius: 8px; background: var(--surface-2); overflow: hidden; box-shadow: inset 0 1px 2px rgba(43,33,25,.08); }
    .hbar-fill { height: 100%; border-radius: 8px; transition: width 1s var(--e); }
    .hbar-num { font-family: 'Manrope', sans-serif; font-size: .72rem; font-weight: 600; color: var(--ink-3); width: 64px; text-align: right; flex-shrink: 0; }

    /* ─── VERIFICATION CARD ────────────────────────────────────── */
    .verif-empty { display: flex; flex-direction: column; align-items: center; text-align: center; padding: 16px 6px 4px; }
    .verif-badge {
        width: 84px; height: 84px; border-radius: 50%;
        background: var(--bg);
        border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 14px;
    }
    .verif-count { font-family: 'Cinzel', Georgia, serif; font-weight: 700; font-size: 2rem; color: var(--ink-4); }
    .verif-status {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; border-radius: 10px;
        background: var(--green-s);
        width: 100%;
    }
    .verif-check {
        width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
        background: var(--green);
        display: flex; align-items: center; justify-content: center; color: #fff; font-size: .76rem;
    }
    .verif-status span { font-family: 'Manrope', sans-serif; font-size: .81rem; font-weight: 600; color: var(--green); text-align: left; }

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
    .pend-code { font-family: 'Manrope', sans-serif; font-size: .66rem; color: var(--ink-3); }
    .pend-amt  { margin-left: auto; font-weight: 700; font-size: .82rem; color: var(--accent); white-space: nowrap; }

    /* ─── TABLE ────────────────────────────────────────────────── */
    .t-wrap { overflow-x: auto; }

    table { width: 100%; border-collapse: collapse; text-align: left; }

    thead th {
        font-family: 'Manrope', sans-serif;
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

    .t-mono  { font-family: 'Manrope', sans-serif; font-size: .78rem; font-weight: 600; color: var(--ink-2); }
    .t-acc   { font-family: 'Manrope', sans-serif; font-size: .78rem; font-weight: 700; color: var(--accent); }
    .t-bold  { font-weight: 700; }
    .t-muted { color: var(--ink-3); font-size: .76rem; }

    .t-thumb {
        width: 42px; height: 42px;
        border-radius: 9px;
        object-fit: cover;
        border: 1px solid var(--border);
        box-shadow: 0 2px 6px -2px rgba(43,33,25,.25);
        display: block;
        transition: transform var(--d) var(--e);
    }
    tbody tr:hover .t-thumb { transform: scale(1.06); }
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
    .t-err    { background: var(--red-s);   color: var(--red);    border-color: rgba(178,58,58,.2); }
    .t-neu    { background: var(--bg);      color: var(--ink-2);  border-color: var(--border); }
    .t-sapphire { background: var(--gold-s);  color: var(--gold);  border-color: rgba(140,106,31,.2); }
    .t-emerald  { background: var(--green-s); color: var(--green); border-color: rgba(79,95,65,.2); }
    .t-teal     { background: var(--coral-s); color: var(--coral); border-color: rgba(166,91,78,.2); }

    /* ─── EMPTY STATE (tables / lists) ────────────────────────── */
    .t-empty { text-align: center; padding: 3rem 1rem; }
    .t-empty-ic {
        width: 52px; height: 52px; border-radius: 50%;
        background: var(--bg);
        border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px;
        color: var(--ink-4); font-size: 1.1rem;
    }
    .t-empty-msg { font-size: .82rem; color: var(--ink-3); }
    .t-empty-msg a { color: var(--accent); font-weight: 700; }

    /* ─── TRACKING SELECT ──────────────────────────────────────── */
    .tsel {
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 4px 26px 4px 9px;
        font-family: 'Manrope', sans-serif;
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

    /* ─── MENU FORM (create / edit) ───────────────────────────────
       Two-column shape: form sections on the left, a live preview
       of how the menu will actually look on the catalog, on the right. */
    .menu-form-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 18px;
        align-items: start;
    }
    @media (max-width: 880px) {
        .menu-form-grid { grid-template-columns: 1fr; }
        .menu-preview-col { order: -1; }
    }

    .form-section {
        padding: 20px 22px;
        border-bottom: 1px solid var(--border-2);
    }
    .form-section:last-of-type { border-bottom: none; }
    .form-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Cinzel', Georgia, serif;
        font-size: .84rem;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 15px;
    }
    .form-section-title i {
        width: 26px; height: 26px; border-radius: 8px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: .72rem;
        background: var(--accent-s); color: var(--accent);
    }

    .menu-preview-col { position: sticky; top: 68px; }
    .menu-preview-label {
        font-family: 'Manrope', sans-serif;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--ink-4);
        margin-bottom: 8px;
        padding-left: 2px;
    }

    /* mirrors .menu-row on the public catalog, so admins see the real result */
    .mp-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
    }
    .mp-media {
        position: relative;
        width: 100%;
        aspect-ratio: 4/3;
        background: var(--bg);
        overflow: hidden;
    }
    .mp-media img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .mp-media-empty {
        width: 100%; height: 100%;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        color: var(--ink-4); font-size: .74rem; gap: 6px;
    }
    .mp-media-empty i { font-size: 1.3rem; opacity: .5; }
    .mp-star {
        position: absolute; top: 10px; left: 10px;
        background: linear-gradient(120deg, var(--gold), #D4A63C);
        color: #3D2600;
        padding: 3px 9px; border-radius: 20px;
        font-size: .62rem; font-weight: 700;
        display: flex; align-items: center; gap: 4px;
        box-shadow: 0 2px 8px rgba(140,106,31,.35);
    }
    .mp-body { padding: 14px 15px 15px; display: flex; flex-direction: column; gap: 6px; }
    .mp-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 6px; }
    .mp-title {
        font-family: 'Cinzel', Georgia, serif;
        font-size: .9rem; font-weight: 600; color: var(--ink); line-height: 1.3; flex: 1;
    }
    .mp-price { font-family: 'Cinzel', Georgia, serif; font-weight: 700; color: var(--accent); font-size: .84rem; white-space: nowrap; flex-shrink: 0; }
    .mp-meta {
        display: flex; align-items: center; justify-content: space-between; gap: 6px; flex-wrap: wrap;
        margin-top: 4px; padding-top: 8px; border-top: 1px solid var(--border-2);
    }
    .mp-tag {
        font-size: .62rem; font-weight: 700; text-transform: uppercase; letter-spacing: .02em;
        color: var(--coral); background: var(--coral-s);
        padding: 2px 9px; border-radius: 20px;
    }
    .mp-minpax { font-size: .68rem; color: var(--ink-3); display: flex; align-items: center; gap: 3px; }
    .mp-unavail {
        margin-top: 4px; padding: 5px 8px; border-radius: 8px;
        background: var(--red-s); color: var(--red);
        font-size: .68rem; font-weight: 700; text-align: center;
    }

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
        transition: transform var(--d) var(--e);
    }
    .ccard:hover .cico { transform: scale(1.06); }

    .cname { font-weight: 700; font-size: .9rem; }
    .ccnt  { font-family: 'Manrope', sans-serif; font-size: .68rem; color: var(--ink-3); margin-top: 2px; }
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
        font-family: 'Manrope', sans-serif;
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
        <img class="sb-mark" src="{{ asset('storage/images/logo__1_-removebg-preview.png') }}" alt="Khasanah Catering">
        <div>
            <div class="sb-name">Khasanah</div>
            <span class="sb-accent">Catering</span>
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
            <div class="sb-av">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="sb-uname">{{ Auth::user()->name ?? 'Administrator' }}</div>
                <div class="sb-urole">Super Admin</div>
            </div>
            <div class="sb-dot"></div>
        </div>
        <form action="{{ route('logout') }}" method="POST"
              class="js-confirm"
              data-confirm-title="Konfirmasi Logout"
              data-confirm-message="Apakah Anda yakin ingin logout dari '{{ Auth::user()->name ?? 'Administrator' }}'?"
              data-confirm-label="Ya, Logout"
              data-confirm-danger="0">
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
            <span class="bar-clock" id="lc"><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::now()->format('H:i') }} WIB</span>

            <div class="bell-wrap">
                <button type="button" class="bell-btn" id="notifBellBtn" title="Notifikasi Pesanan Baru">
                    <i class="fa-solid fa-bell"></i>
                    <span class="bell-badge" id="notifBadge">0</span>
                </button>
                <div class="bell-panel" id="notifPanel">
                    <div class="bell-panel-head">
                        <span>Pesanan Baru</span>
                        <button type="button" id="notifMarkAll">Tandai semua dibaca</button>
                    </div>
                    <div class="bell-panel-body" id="notifList">
                        <div class="bell-empty">Memuat...</div>
                    </div>
                </div>
            </div>

            <div class="bar-prof">
                <div class="bar-prof-av">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                {{ Auth::user()->name ?? 'Admin' }}
            </div>
        </div>
    </header>

    <main class="pg">
        @if(session('success'))
            <div class="flash flash-ok">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flash flash-err">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>
</div>

<!-- MODAL KONFIRMASI (dipakai untuk hapus data & logout) -->
<div class="cfm-overlay" id="cfmOverlay">
    <div class="cfm-box" role="alertdialog" aria-modal="true">
        <div class="cfm-icon" id="cfmIcon"><i class="fa-solid fa-trash"></i></div>
        <h3 class="cfm-title" id="cfmTitle">Konfirmasi</h3>
        <p class="cfm-msg" id="cfmMsg">Apakah Anda yakin?</p>
        <div class="cfm-actions">
            <button type="button" class="cfm-btn cfm-btn-cancel" id="cfmCancel">Batal</button>
            <button type="button" class="cfm-btn cfm-btn-confirm" id="cfmConfirm">Ya, Lanjutkan</button>
        </div>
    </div>
</div>

<script>
(function(){
    function tick(){
        var d=new Date(),e=document.getElementById('lc');
        if(e) e.innerHTML='<i class="fa-regular fa-clock"></i> '+(d.getHours()+'').padStart(2,'0')+':'+(d.getMinutes()+'').padStart(2,'0')+' WIB';
    }
    setInterval(tick,15000);
})();

/* ─── MODAL KONFIRMASI GENERIK ───────────────────────────────
   Dipakai lewat class "js-confirm" di form (hapus menu, hapus
   pesanan, logout, dst) supaya tidak pakai confirm() bawaan browser. */
(function(){
    var overlay = document.getElementById('cfmOverlay');
    var titleEl = document.getElementById('cfmTitle');
    var msgEl = document.getElementById('cfmMsg');
    var iconEl = document.getElementById('cfmIcon');
    var confirmBtn = document.getElementById('cfmConfirm');
    var cancelBtn = document.getElementById('cfmCancel');
    var pendingAction = null;

    function openModal(opts) {
        titleEl.textContent = opts.title || 'Konfirmasi';
        msgEl.textContent = opts.message || 'Apakah Anda yakin?';
        confirmBtn.textContent = opts.confirmLabel || 'Ya, Lanjutkan';

        var danger = opts.danger !== false;
        iconEl.className = 'cfm-icon' + (danger ? '' : ' info');
        iconEl.innerHTML = danger
            ? '<i class="fa-solid fa-trash"></i>'
            : '<i class="fa-solid fa-right-from-bracket"></i>';
        confirmBtn.className = 'cfm-btn cfm-btn-confirm' + (danger ? '' : ' info-variant');

        pendingAction = opts.onConfirm;
        overlay.classList.add('open');
    }

    function closeModal() {
        overlay.classList.remove('open');
        pendingAction = null;
    }

    confirmBtn.addEventListener('click', function () {
        var action = pendingAction;
        closeModal();
        if (action) action();
    });
    cancelBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    // Intersep submit semua form yang punya class "js-confirm"
    document.addEventListener('submit', function (e) {
        var form = e.target.closest('.js-confirm');
        if (!form) return;
        if (form.dataset.confirmed === '1') return; // sudah dikonfirmasi, biarkan submit jalan

        e.preventDefault();
        openModal({
            title: form.dataset.confirmTitle,
            message: form.dataset.confirmMessage,
            confirmLabel: form.dataset.confirmLabel,
            danger: form.dataset.confirmDanger !== '0',
            onConfirm: function () {
                form.dataset.confirmed = '1';
                form.submit();
            },
        });
    });
})();

/* ─── LONCENG NOTIFIKASI PESANAN BARU ────────────────────────
   Polling ringan tiap 25 detik ke /admin/notifications supaya
   admin tahu ada pesanan baru masuk tanpa perlu refresh halaman. */
(function(){
    var btn = document.getElementById('notifBellBtn');
    var panel = document.getElementById('notifPanel');
    var badge = document.getElementById('notifBadge');
    var list = document.getElementById('notifList');
    var markAllBtn = document.getElementById('notifMarkAll');
    if (!btn) return;

    function escapeHtml(str) {
        var div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function renderList(orders) {
        if (!orders.length) {
            list.innerHTML = '<div class="bell-empty">Tidak ada pesanan baru.</div>';
            return;
        }
        list.innerHTML = orders.map(function (o) {
            return '<a href="' + o.url + '" class="bell-item">' +
                '<div class="bell-item-top">' +
                    '<span class="bell-item-code">' + escapeHtml(o.order_code) + '</span>' +
                    '<span class="bell-item-time">' + escapeHtml(o.time_ago) + '</span>' +
                '</div>' +
                '<div class="bell-item-name">' + escapeHtml(o.customer_name) + '</div>' +
                '<div class="bell-item-meta">' + escapeHtml(o.total_amount) + ' &middot; ' + escapeHtml(o.payment_type) + '</div>' +
            '</a>';
        }).join('');
    }

    function loadNotifications() {
        fetch('{{ route('admin.notifications.index') }}', { headers: { 'Accept': 'application/json' } })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (data.count > 0) {
                    badge.style.display = 'flex';
                    badge.textContent = data.count > 9 ? '9+' : data.count;
                } else {
                    badge.style.display = 'none';
                }
                renderList(data.orders || []);
            })
            .catch(function () { /* diamkan supaya tidak mengganggu admin kalau fetch gagal */ });
    }

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        panel.classList.toggle('open');
    });

    document.addEventListener('click', function (e) {
        if (panel.classList.contains('open') && !panel.contains(e.target) && e.target !== btn) {
            panel.classList.remove('open');
        }
    });

    if (markAllBtn) {
        markAllBtn.addEventListener('click', function () {
            fetch('{{ route('admin.notifications.read_all') }}', {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            }).then(function () {
                badge.style.display = 'none';
                list.innerHTML = '<div class="bell-empty">Tidak ada pesanan baru.</div>';
            });
        });
    }

    loadNotifications();
    setInterval(loadNotifications, 25000);
})();
</script>
@yield('scripts')
</body>
</html>

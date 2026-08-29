@extends('layouts.app')

@section('title', 'Khasanah Catering - Booking Katering Premium & Modern')

@section('styles')
<style>
    /* --- HERO SECTION --- */
    .hero-section {
        position: relative;
        padding: 6rem 2rem;
        background: linear-gradient(165deg, rgba(43, 33, 25, 0.82) 0%, rgba(181, 80, 46, 0.58) 60%, var(--bg-main) 100%),
                    url('https://images.unsplash.com/photo-1555244162-803834f70033?w=1600&auto=format&fit=crop&q=80') center/cover no-repeat;
        border-bottom: 1px solid var(--border-color);
        text-align: center;
        overflow: hidden;
    }

    .hero-content {
        max-width: 900px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
        animation: heroFade 0.9s cubic-bezier(0.4,0,0.2,1);
    }

    @keyframes heroFade {
        from { opacity: 0; transform: translateY(24px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255, 215, 130, 0.5);
        color: #F7DDBB;
        padding: 7px 18px;
        border-radius: 30px;
        font-size: 0.86rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        margin-bottom: 1.6rem;
        animation: badgeFloat 4.5s ease-in-out infinite;
    }

    @keyframes badgeFloat {
        0%   { transform: translateY(0) rotate(0deg); }
        25%  { transform: translateY(-7px) rotate(-1.5deg); }
        50%  { transform: translateY(0) rotate(0deg); }
        75%  { transform: translateY(6px) rotate(1.5deg); }
        100% { transform: translateY(0) rotate(0deg); }
    }

    .hero-badge i {
        display: inline-block;
        animation: badgeSpinIcon 5s ease-in-out infinite;
    }

    @keyframes badgeSpinIcon {
        0%, 100% { transform: rotate(0deg); }
        50% { transform: rotate(14deg); }
    }

    .hero-title {
        font-family: var(--font-heading);
        font-size: 3.4rem;
        font-weight: 600;
        line-height: 1.18;
        margin-bottom: 1.3rem;
        color: #FFFFFF;
        text-shadow: 0 2px 14px rgba(0,0,0,0.3);
    }

    .hero-title span {
        font-style: italic;
        color: var(--secondary-gold);
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 680px;
        margin: 0 auto 2.5rem;
        line-height: 1.65;
    }

    .hero-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    /* --- CATEGORY FILTERS --- */
    .filter-section {
        max-width: 1200px;
        margin: 3rem auto 2rem;
        padding: 0 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .category-pills {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .pill-btn {
        position: relative;
        overflow: hidden;
        background: var(--bg-card);
        border: 1.5px solid var(--border-color);
        color: var(--text-secondary);
        padding: 9px 20px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: color var(--transition-speed), border-color var(--transition-speed), box-shadow var(--transition-speed), transform var(--transition-speed);
        z-index: 0;
    }

    .pill-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--primary-orange);
        border-radius: 30px;
        transform: scale(0);
        transform-origin: center;
        transition: transform 0.45s cubic-bezier(0.65, 0, 0.35, 1);
        z-index: -1;
    }

    .pill-btn:hover::before, .pill-btn.active::before {
        transform: scale(1);
    }

    .pill-btn:hover, .pill-btn.active {
        color: #FFFFFF;
        border-color: var(--primary-orange);
        box-shadow: 0 6px 16px var(--primary-glow);
        transform: translateY(-1px);
    }

    .search-box {
        display: flex;
        align-items: center;
        background: var(--bg-card);
        border: 1.5px solid var(--border-color);
        border-radius: 30px;
        padding: 8px 18px;
        width: 300px;
        transition: all var(--transition-speed);
    }

    .search-box:focus-within {
        border-color: var(--primary-orange);
        box-shadow: 0 0 0 4px var(--primary-glow);
    }

    .search-box input {
        background: transparent;
        border: none;
        outline: none;
        color: var(--text-primary);
        padding: 6px;
        width: 100%;
    }

    .search-box input::placeholder {
        color: var(--text-secondary);
    }

    .search-box i {
        color: var(--text-secondary);
    }

    /* --- MENU GRID (4 kolom, minimalis) --- */
    .menu-list-container {
        max-width: 1200px;
        margin: 0 auto 2rem;
        padding: 0 1.5rem;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.4rem;
    }

    @media (max-width: 1024px) {
        .menu-list-container { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 700px) {
        .menu-list-container { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    }

    @media (max-width: 420px) {
        .menu-list-container { grid-template-columns: 1fr; }
    }

    .menu-row {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .menu-row:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(43, 33, 25, 0.10);
        border-color: var(--primary-orange);
    }

    .menu-row.js-ready {
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.5s ease, transform 0.5s ease;
        transition-delay: calc(var(--i, 0) * 0.07s);
    }

    .menu-row.js-ready.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .menu-row-hidden { display: none; }

    /* Foto di atas */
    .menu-row-media {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        flex-shrink: 0;
    }

    .menu-row-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .menu-row:hover .menu-row-img {
        transform: scale(1.06);
    }

    .menu-row-star {
        position: absolute;
        top: 10px;
        left: 10px;
        background: linear-gradient(120deg, var(--secondary-gold), #D4A63C);
        color: #3D2600;
        padding: 3px 9px;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 4px;
        box-shadow: 0 2px 8px rgba(184, 137, 43, 0.35);
    }

    /* Info di bawah */
    .menu-row-content {
        flex: 1;
        padding: 1rem 1.1rem 1.1rem;
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .menu-row-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 6px;
    }

    .menu-row-title {
        font-family: var(--font-heading);
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-primary);
        line-height: 1.3;
        flex: 1;
    }

    .menu-row-leader { display: none; }

    .menu-row-price {
        font-family: var(--font-heading);
        font-weight: 700;
        color: var(--primary-orange);
        font-size: 0.88rem;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .menu-row-desc {
        color: var(--text-secondary);
        font-size: 0.8rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .menu-row-desc.is-expanded {
        display: block;
        -webkit-line-clamp: unset;
        overflow: visible;
    }

    .menu-row-readmore {
        background: none;
        border: none;
        color: var(--primary-orange);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .menu-row-readmore:hover { text-decoration: underline; }

    .menu-row-readmore i {
        font-size: 0.6rem;
        transition: transform 0.3s ease;
    }

    .menu-row-readmore.is-open i { transform: rotate(180deg); }

    .menu-row-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: auto;
        padding-top: 0.5rem;
        border-top: 1px solid var(--border-color);
    }

    .menu-row-tag {
        font-size: 0.64rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: var(--tertiary-coral-dark);
        background: var(--tertiary-coral-light);
        padding: 2px 9px;
        border-radius: 20px;
    }

    .menu-row-minpax {
        font-size: 0.68rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .menu-row-cta {
        background: var(--primary-orange);
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.72rem;
        padding: 5px 12px;
        border-radius: 20px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.25s ease;
        margin-left: auto;
    }

    .menu-row-cta:hover {
        background: var(--primary-orange-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px var(--primary-glow);
    }

    /* --- MODAL DIALOG --- */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(8px);
        z-index: 2000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-box {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 550px;
        padding: 2rem;
        position: relative;
        box-shadow: 0 20px 50px rgba(42, 33, 24, 0.25);
        animation: popup 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes popup {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }

    .close-modal-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--bg-input);
        color: var(--text-secondary);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        transition: all var(--transition-speed);
    }

    .close-modal-btn:hover {
        color: var(--text-primary);
        background: var(--error);
    }

    .modal-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .modal-price {
        font-size: 1.3rem;
        color: var(--primary-orange);
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: var(--text-primary);
    }

    .form-input {
        width: 100%;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 12px;
        border-radius: var(--radius-sm);
        font-size: 1rem;
        outline: none;
        transition: all var(--transition-speed);
    }

    .form-input::placeholder {
        color: var(--text-secondary);
    }

    .form-input:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 10px var(--primary-glow);
    }

    /* --- QUANTITY STEPPER (plus/minus) --- */
    .qty-stepper {
        display: flex;
        align-items: stretch;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        overflow: hidden;
        transition: all var(--transition-speed);
    }

    .qty-stepper:focus-within {
        border-color: var(--primary-orange);
        box-shadow: 0 0 10px var(--primary-glow);
    }

    .qty-btn {
        background: transparent;
        border: none;
        color: var(--primary-orange);
        width: 48px;
        flex-shrink: 0;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all var(--transition-speed);
    }

    .qty-btn:hover {
        background: var(--primary-orange);
        color: #FFFFFF;
    }

    .qty-btn:active {
        transform: scale(0.9);
    }

    .qty-input {
        flex: 1;
        min-width: 0;
        text-align: center;
        background: transparent;
        border: none;
        border-left: 1px solid var(--border-color);
        border-right: 1px solid var(--border-color);
        color: var(--text-primary);
        font-size: 1.05rem;
        font-weight: 700;
        outline: none;
        -moz-appearance: textfield;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .subtotal-preview {
        background: var(--primary-orange-light);
        border: 1px dashed var(--primary-orange);
        padding: 1rem;
        border-radius: var(--radius-sm);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    /* --- SECTION HEADER (shared) --- */
    .section-header {
        max-width: 700px;
        margin: 0 auto 3rem;
        text-align: center;
        padding: 0 1.5rem;
    }

    .section-header .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary-orange-light);
        color: var(--primary-orange-hover);
        padding: 5px 16px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .section-header h2 {
        font-family: var(--font-heading);
        font-size: 2.3rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.6rem;
    }

    .section-header h2 span {
        font-style: italic;
        color: var(--primary-orange);
    }

    .section-header p {
        color: var(--text-secondary);
        font-size: 1.05rem;
    }

    /* --- HOW IT WORKS (connected path, not boxed cards) --- */
    .how-it-works {
        background: var(--bg-soft);
        padding: 4.5rem 1.5rem;
    }

    .steps-path {
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        align-items: flex-start;
    }

    @media (max-width: 760px) {
        .steps-path { flex-direction: column; }
    }

    .step-item {
        flex: 1;
        text-align: left;
        padding: 0 1.4rem;
    }

    @media (max-width: 760px) {
        .step-item { padding: 0 0 2.2rem 1.4rem; }
    }

    .step-num {
        font-family: var(--font-heading);
        font-size: 3.2rem;
        font-weight: 600;
        line-height: 1;
        color: transparent;
        -webkit-text-stroke: 1.5px var(--primary-orange);
        margin-bottom: 0.9rem;
        transition: -webkit-text-stroke-color 0.4s, color 0.4s;
    }

    .step-item:hover .step-num {
        color: var(--primary-orange);
    }

    .step-connector {
        width: 70px;
        height: 2px;
        margin-top: 42px;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        background: repeating-linear-gradient(90deg, var(--border-color) 0 6px, transparent 6px 13px);
    }

    @media (max-width: 760px) {
        .step-connector {
            width: 2px;
            height: 46px;
            margin: -1rem 0 -1rem 2.1rem;
            background: repeating-linear-gradient(180deg, var(--border-color) 0 6px, transparent 6px 13px);
        }
    }

    .step-connector::after {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--primary-orange);
        transform-origin: left top;
        transform: scaleX(0);
        transition: transform 1s cubic-bezier(0.65, 0, 0.35, 1) 0.3s;
    }

    @media (max-width: 760px) {
        .step-connector::after { transform-origin: top left; transform: scaleY(0); }
        .step-connector.is-visible::after { transform: scaleY(1); }
    }

    .step-connector.is-visible::after {
        transform: scaleX(1);
    }

    .step-item h3 {
        font-family: var(--font-heading);
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.6rem;
    }

    .step-item p {
        color: var(--text-secondary);
        font-size: 0.92rem;
        line-height: 1.6;
        max-width: 280px;
    }

    /* --- TESTIMONIALS (auto-scrolling marquee) --- */
    .testimonials {
        padding: 4.5rem 0;
        overflow: hidden;
    }

    .testimonial-track-wrapper {
        max-width: 100%;
        overflow: hidden;
        -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
        mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
    }

    .testimonial-track {
        display: flex;
        gap: 2rem;
        width: max-content;
        animation: testimonialScroll 32s linear infinite;
        padding: 0 1rem;
    }

    .testimonial-track-wrapper:hover .testimonial-track {
        animation-play-state: paused;
    }

    @keyframes testimonialScroll {
        from { transform: translateX(0); }
        to   { transform: translateX(-50%); }
    }

    .testimonial-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-soft);
        transition: all var(--transition-speed);
        width: 340px;
        flex-shrink: 0;
    }

    .testimonial-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-hover);
        border-color: transparent;
    }

    .testimonial-stars {
        color: var(--secondary-gold-dark);
        margin-bottom: 0.8rem;
        font-size: 0.95rem;
    }

    .testimonial-text {
        color: var(--text-secondary);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .testimonial-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-hover));
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
    }

    .testimonial-author strong {
        display: block;
        color: var(--text-primary);
        font-size: 0.95rem;
    }

    .testimonial-author span {
        color: var(--text-secondary);
        font-size: 0.85rem;
    }

    /* --- CTA BANNER (invitation ticket-stub style, not a generic gradient box) --- */
    .invite-banner {
        max-width: 1000px;
        margin: 0 auto 4.5rem;
        display: flex;
        background: var(--charcoal);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 24px 46px rgba(43, 33, 25, 0.22);
        position: relative;
    }

    @media (max-width: 700px) {
        .invite-banner { flex-direction: column; }
    }

    .invite-main {
        flex: 1;
        padding: 3rem 2.6rem;
        position: relative;
    }

    .invite-eyebrow {
        color: var(--secondary-gold);
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 0.8rem;
        display: block;
    }

    .invite-main h2 {
        font-family: var(--font-heading);
        font-style: italic;
        color: #fff;
        font-size: 2rem;
        font-weight: 500;
        line-height: 1.3;
        margin-bottom: 1rem;
        max-width: 420px;
    }

    .invite-main p {
        color: rgba(255, 255, 255, 0.65);
        max-width: 400px;
        line-height: 1.7;
        font-size: 0.94rem;
    }

    /* Perforated ticket divider */
    .invite-divider {
        width: 0;
        position: relative;
        border-left: 2px dashed rgba(255, 255, 255, 0.25);
        margin: 24px 0;
    }

    .invite-divider::before,
    .invite-divider::after {
        content: '';
        position: absolute;
        left: -14px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--bg-main);
    }

    .invite-divider::before { top: -14px; }
    .invite-divider::after { bottom: -14px; }

    @media (max-width: 700px) {
        .invite-divider {
            border-left: none;
            border-top: 2px dashed rgba(255, 255, 255, 0.25);
            width: auto;
            height: 0;
            margin: 0 24px;
        }
        .invite-divider::before { left: -14px; top: -14px; }
        .invite-divider::after { left: auto; right: -14px; top: -14px; bottom: auto; }
    }

    .invite-stub {
        width: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    @media (max-width: 700px) {
        .invite-stub { width: auto; padding: 2rem 2.6rem 2.6rem; }
    }

    .invite-stamp {
        width: 132px;
        height: 132px;
        border-radius: 50%;
        border: 2px dashed rgba(255, 215, 130, 0.55);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        color: var(--secondary-gold);
        font-family: var(--font-heading);
        font-weight: 600;
        font-size: 0.95rem;
        text-align: center;
        line-height: 1.25;
        transform: rotate(-9deg);
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), background 0.3s, color 0.3s;
        cursor: pointer;
    }

    .invite-stamp i {
        font-size: 1.3rem;
        margin-bottom: 4px;
    }

    .invite-stamp:hover {
        transform: rotate(0deg) scale(1.08);
        background: var(--secondary-gold);
        color: var(--charcoal);
        border-style: solid;
        border-color: var(--secondary-gold);
    }

    @media (max-width: 900px) {
        .hero-title {
            font-size: 2.2rem;
        }

        .section-header h2 {
            font-size: 1.7rem;
        }

        .invite-main h2 {
            font-size: 1.5rem;
        }

        .testimonial-card {
            width: 280px;
        }

        .testimonial-track {
            animation-duration: 22s;
        }
    }
</style>
@section('content')

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="hero-content">
        <div class="hero-badge">
            <i class="fa-solid fa-kitchen-set"></i> Dari Dapur Rumahan, Sejak 2019
        </div>
        <h1 class="hero-title">
            Masakan Rumahan yang <br> Bikin Tamu <span>Nanya Resepnya</span>
        </h1>
        <p class="hero-subtitle">
            Resep keluarga yang biasa kami masak sendiri, sekarang bisa dipesan online. Buat rapat kantor, nikahan, syukuran, sampai ulang tahun anak — kami masak dari pagi, bukan dari gudang beku.
        </p>
        <div class="hero-buttons">
            <a href="#katalog" class="btn-primary">
                <i class="fa-solid fa-utensils"></i> Lihat Katalog Menu
            </a>
            <a href="https://wa.me/621325032009?text=Halo%20Admin,%20saya%20mau%20konsultasi%20menu%20katering" target="_blank" class="btn-secondary">
                <i class="fa-brands fa-whatsapp"></i> Konsultasi Acara Free
            </a>
        </div>
    </div>
</section>

<!-- MENU SECTION TITLE -->
<div class="section-header reveal-up" style="padding-top: 3rem;">
    <span class="eyebrow"><i class="fa-solid fa-bowl-food"></i> Katalog Kami</span>
    <h2>Menu <span>Kami</span></h2>
    <p>Aneka pilihan prasmanan, nasi kotak, snack box, hingga custom tumpeng untuk setiap acara Anda.</p>
</div>

<!-- CATEGORY FILTER & SEARCH -->
<section class="filter-section reveal-up" id="katalog">
    <div class="category-pills">
        <a href="{{ route('home') }}#katalog" class="pill-btn {{ !request('category') || request('category') == 'All' ? 'active' : '' }}">
            Semua Menu
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('home', ['category' => $cat]) }}#katalog" class="pill-btn {{ request('category') == $cat ? 'active' : '' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <form action="{{ route('home') }}#katalog" method="GET" class="search-box">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="search" placeholder="Cari menu katering..." value="{{ request('search') }}">
    </form>
</section>

<!-- MENU LIST (editorial style) -->
<section class="menu-list-container">
    @forelse($menus as $index => $menu)
        <article class="menu-row {{ !is_null($bestsellerCount) && $index >= $bestsellerCount ? 'menu-row-hidden' : '' }}" style="--i: {{ $index % 6 }}">
            <div class="menu-row-media">
                <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="menu-row-img" onerror="this.src='https://images.unsplash.com/photo-1555244162-803834f70033?w=800'">
                @if($menu->is_bestseller)
                    <span class="menu-row-star" title="Bestseller"><i class="fa-solid fa-star"></i></span>
                @endif
            </div>
            <div class="menu-row-content">
                <div class="menu-row-top">
                    <h3 class="menu-row-title">{{ $menu->name }}</h3>
                    <span class="menu-row-leader"></span>
                    <span class="menu-row-price">Rp {{ number_format($menu->price_per_pax, 0, ',', '.') }}</span>
                </div>
                <p class="menu-row-desc" id="desc-{{ $menu->id }}">{{ $menu->description }}</p>
                <button type="button" class="menu-row-readmore" id="readmore-{{ $menu->id }}" onclick="toggleDesc('{{ $menu->id }}')">
                    Selengkapnya <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="menu-row-meta">
                    <span class="menu-row-tag">{{ $menu->category }}</span>
                    @if($menu->category !== 'Custom / Tumpeng')
                        <span class="menu-row-minpax"><i class="fa-solid fa-users"></i> Min. {{ $menu->min_pax }} Pack</span>
                    @endif
                    <button type="button" class="menu-row-cta" title="Tambah ke Keranjang"
                            onclick="openOrderModal('{{ $menu->id }}', '{{ addslashes($menu->name) }}', '{{ $menu->price_per_pax }}', '{{ $menu->min_pax }}', '{{ addslashes($menu->category) }}')">
                        <i class="fa-solid fa-cart-plus"></i>
                    </button>
                </div>
            </div>
        </article>
    @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 4rem 1rem; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px dashed var(--border-color);">
            <i class="fa-solid fa-utensils" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
            <h3 style="color: var(--text-main);">Menu Tidak Ditemukan</h3>
            <p style="color: var(--text-muted);">Coba cari kata kunci lain atau pilih kategori lain.</p>
        </div>
    @endforelse
</section>

@if(!is_null($bestsellerCount) && $menus->count() > $bestsellerCount)
    <div style="text-align: center; margin: 0.5rem auto 3rem;">
        <button id="showMoreMenuBtn" class="btn-secondary" onclick="showMoreMenu()">
            Lihat Menu Lainnya <i class="fa-solid fa-chevron-down"></i>
        </button>
    </div>
@endif

<!-- HOW IT WORKS -->
<section class="how-it-works reveal-up">
    <div class="section-header">
        <span class="eyebrow" style="background: var(--quaternary-olive-light); color: var(--quaternary-olive-dark);"><i class="fa-solid fa-list-check"></i> Alur Pemesanan</span>
        <h2>Cara <span>Kerjanya</span></h2>
        <p>Tiga langkah mudah menuju hidangan katering sempurna untuk acara Anda.</p>
    </div>
    <div class="steps-path">
        <div class="step-item">
            <div class="step-num">01</div>
            <h3>Pilih Menu Favorit</h3>
            <p>Jelajahi katalog menu kami dan pilih paket prasmanan, nasi kotak, atau hidangan spesial sesuai selera acara Anda.</p>
        </div>
        <span class="step-connector"></span>
        <div class="step-item">
            <div class="step-num" style="-webkit-text-stroke-color: var(--secondary-gold-dark);">02</div>
            <h3>Lakukan Pemesanan</h3>
            <p>Tentukan jumlah pack, isi data pengiriman, dan selesaikan pembayaran DP atau lunas dengan aman.</p>
        </div>
        <span class="step-connector"></span>
        <div class="step-item">
            <div class="step-num" style="-webkit-text-stroke-color: var(--quaternary-olive-dark);">03</div>
            <h3>Kami Antar Tepat Waktu</h3>
            <p>Duduk santai — hidangan segar kami akan disiapkan dan diantar langsung ke lokasi acara Anda.</p>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials reveal-up">
    <div class="section-header">
        <span class="eyebrow" style="background: var(--tertiary-coral-light); color: var(--tertiary-coral-dark);"><i class="fa-solid fa-heart"></i> Cerita Pelanggan</span>
        <h2>Apa Kata <span>Pelanggan Kami</span></h2>
        <p>Kisah nyata dari acara-acara yang sudah kami layani.</p>
    </div>
    <div class="testimonial-track-wrapper">
        <div class="testimonial-track">
            @php
                $testimonials = [
                    ['stars' => 5, 'text' => 'Pesen paket prasmanan nasi kebuli buat ulang tahun anak saya, tamu pada nanya resepnya. Minta waktu hidang dimajuin 30 menit juga masih bisa, makasih Bu Dean!', 'initial' => 'T', 'name' => 'Tania Dwi', 'event' => 'Ulang Tahun Anak'],
                    ['stars' => 5, 'text' => 'Order nasi kotak buat syukuran 17-an di RT, 50 kotak habis semua sebelum acara kelar. Rasanya emang beda kalau masakan rumahan, ga kayak katering biasa yang hambar.', 'initial' => 'O', 'name' => 'Ogi Winarni', 'event' => 'Syukuran RT'],
                    ['stars' => 4, 'text' => 'Buat rapat kantor udah pas, snack box-nya habis semua. Cuma waktu itu pengirimannya telat 15 menitan karena macet, untungnya tim WA duluan ngasih kabar jadi ga bingung.', 'initial' => 'A', 'name' => 'Agung Tri', 'event' => 'Rapat Kantor'],
                    ['stars' => 5, 'text' => 'Pesan tumpeng buat syukuran rumah baru, cuma buat 20 orang, request porsinya dikecilin ternyata bisa. Ayam goreng lengkuasnya juara, sisa tamu pada nanyain nomor WA-nya.', 'initial' => 'R', 'name' => 'Rina Kusuma', 'event' => 'Syukuran Rumah Baru'],
                ];
            @endphp
            @for ($i = 0; $i < 2; $i++)
                @foreach ($testimonials as $t)
                    <div class="testimonial-card">
                        <div class="testimonial-stars">{{ str_repeat('★', $t['stars']) }}</div>
                        <p class="testimonial-text">"{{ $t['text'] }}"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">{{ $t['initial'] }}</div>
                            <div>
                                <strong>{{ $t['name'] }}</strong>
                                <span>{{ $t['event'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endfor
        </div>
    </div>
</section>

<!-- CTA BANNER (invitation ticket style) -->
<div class="invite-banner reveal-up">
    <div class="invite-main">
        <span class="invite-eyebrow">Undangan Khusus Untuk Anda</span>
        <h2>Jadikan acara Anda tak terlupakan.</h2>
        <p>Pesan sekarang dan biarkan kami yang mengurus hidangannya, sementara Anda menikmati momen bersama orang-orang tercinta.</p>
    </div>
    <div class="invite-divider"></div>
    <div class="invite-stub">
        <a href="#katalog" class="invite-stamp">
            <i class="fa-solid fa-utensils"></i>
            Pesan<br>Sekarang
        </a>
    </div>
</div>

<!-- MODAL TAMBAH KE KERANJANG -->
<div class="modal-overlay" id="orderModal">
    <div class="modal-box">
        <button class="close-modal-btn" onclick="closeOrderModal()">&times;</button>
        <h3 class="modal-title" id="modalMenuName">Nama Menu Katering</h3>
        <div class="modal-price" id="modalMenuPrice">Rp 0 / pack</div>
        
        <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
            @csrf
            <input type="hidden" name="menu_id" id="modalMenuId">
            
            <div class="form-group">
                <label for="paxInput">Jumlah Porsi (Pack) <span id="modalMinHint" style="color: var(--primary-orange);">(Minimal 30 Pack)</span></label>
                <div class="qty-stepper">
                    <button type="button" class="qty-btn qty-minus" onclick="stepPax(-5)"><i class="fa-solid fa-minus"></i></button>
                    <input type="number" name="pax_quantity" id="paxInput" class="qty-input" min="30" value="30" oninput="calculateSubtotal()" required>
                    <button type="button" class="qty-btn qty-plus" onclick="stepPax(5)"><i class="fa-solid fa-plus"></i></button>
                </div>
                <small id="modalMinNote" style="color: var(--text-muted); font-size: 0.8rem; margin-top: 4px; display: block;">
                    <i class="fa-solid fa-circle-info" style="color: var(--primary-orange);"></i> Pemesanan di bawah 30 pack akan ditolak oleh sistem katering.
                </small>
            </div>

            <div class="subtotal-preview">
                <span>Total Biaya (Perkiraan):</span>
                <span id="subtotalText" style="color: var(--primary-orange); font-size: 1.2rem;">Rp 0</span>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%;">
                <i class="fa-solid fa-cart-shopping"></i> Tambahkan ke Keranjang
            </button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let currentPrice = 0;

    // --- Unique reveal animation for menu rows (clip-path unfold + price count-up) ---
    function animatePriceIn(el) {
        if (!el || el.dataset.animated === '1') return;
        el.dataset.animated = '1';
        const target = parseFloat(el.dataset.price) || 0;
        const duration = 700;
        const start = performance.now();

        function tick(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.round(target * eased);
            el.textContent = 'Rp ' + current.toLocaleString('id-ID');
            if (progress < 1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
    }

    document.addEventListener('DOMContentLoaded', function () {
        try {
            const menuRows = document.querySelectorAll('.menu-row:not(.menu-row-hidden)');
            if (menuRows.length && 'IntersectionObserver' in window) {
                const rowObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            animatePriceIn(entry.target.querySelector('.menu-row-price'));
                            rowObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });

                menuRows.forEach(row => {
                    row.classList.add('js-ready'); // only hide once JS confirmed working
                    rowObserver.observe(row);
                });

                // Safety net: force-reveal anything still hidden after 2.5s (in case observer misses an element)
                setTimeout(() => {
                    document.querySelectorAll('.menu-row.js-ready:not(.is-visible)').forEach(row => {
                        row.classList.add('is-visible');
                        animatePriceIn(row.querySelector('.menu-row-price'));
                    });
                }, 2500);
            } else {
                // No IntersectionObserver support: just show the price directly, no animation
                document.querySelectorAll('.menu-row-price').forEach(animatePriceIn);
            }
        } catch (e) {
            console.error('Menu reveal animation failed, showing content directly:', e);
            document.querySelectorAll('.menu-row').forEach(row => row.classList.add('is-visible'));
        }

        // --- Step connector line-draw animation ---
        try {
            const connectors = document.querySelectorAll('.step-connector');
            if (connectors.length && 'IntersectionObserver' in window) {
                const connectorObserver = new IntersectionObserver((entries) => {
                    entries.forEach((entry, i) => {
                        if (entry.isIntersecting) {
                            setTimeout(() => entry.target.classList.add('is-visible'), i * 200);
                            connectorObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.3 });
                connectors.forEach(c => connectorObserver.observe(c));
            }
        } catch (e) {
            console.error('Step connector animation failed:', e);
        }
    });

    function toggleDesc(id) {
        const desc = document.getElementById('desc-' + id);
        const btn = document.getElementById('readmore-' + id);
        const isOpen = desc.classList.toggle('is-expanded');
        btn.classList.toggle('is-open', isOpen);
        btn.innerHTML = isOpen
            ? 'Sembunyikan <i class="fa-solid fa-chevron-down"></i>'
            : 'Selengkapnya <i class="fa-solid fa-chevron-down"></i>';
    }

    function openOrderModal(id, name, price, minPax, category) {
        currentPrice = parseFloat(price);
        document.getElementById('modalMenuId').value = id;
        document.getElementById('modalMenuName').innerText = name;
        document.getElementById('modalMenuPrice').innerText = 'Rp ' + Number(price).toLocaleString('id-ID') + ' / pack';

        const paxInput = document.getElementById('paxInput');
        const minHint = document.getElementById('modalMinHint');
        const minNote = document.getElementById('modalMinNote');
        const isTumpeng = category === 'Custom / Tumpeng';

        if (isTumpeng) {
            paxInput.min = 1;
            paxInput.value = 1;
            minHint.style.display = 'none';
            minNote.style.display = 'none';
        } else {
            paxInput.min = 30;
            paxInput.value = minPax || 30;
            minHint.style.display = 'inline';
            minNote.style.display = 'block';
        }

        calculateSubtotal();
        document.getElementById('orderModal').classList.add('active');
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.remove('active');
    }

    function showMoreMenu() {
        document.querySelectorAll('.menu-row-hidden').forEach(function (row) {
            row.classList.remove('menu-row-hidden');
            requestAnimationFrame(function () {
                row.classList.add('is-visible');
                animatePriceIn(row.querySelector('.menu-row-price'));
            });
        });

        const btnWrapper = document.getElementById('showMoreMenuBtn').parentElement;
        btnWrapper.style.display = 'none';
    }

    function calculateSubtotal() {
        const pax = parseInt(document.getElementById('paxInput').value) || 0;
        const subtotal = pax * currentPrice;
        document.getElementById('subtotalText').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
    }

    function stepPax(amount) {
        const input = document.getElementById('paxInput');
        const min = parseInt(input.min) || 1;
        let current = parseInt(input.value) || min;
        current += amount;
        if (current < min) current = min;
        input.value = current;
        calculateSubtotal();
    }

    // Modal click outside to close
    window.onclick = function(event) {
        const modal = document.getElementById('orderModal');
        if (event.target == modal) {
            closeOrderModal();
        }
    }
</script>
@endsection

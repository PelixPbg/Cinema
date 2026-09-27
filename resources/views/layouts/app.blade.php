<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Cinema</title>

    <!-- Favicon / Logo Tab Browser menggunakan Emoji 🎬 -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎬</text></svg>">

    <!-- Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons & Base Framework -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* =========================================
           DESIGN TOKENS (VIBRANT & ELEGANT EDITORIAL)
        ========================================= */
        :root {
            /* Permukaan Card (90% Putih Transparan untuk efek menyatu) */
            --surface: rgba(255, 255, 255, 0.9);
            
            /* Teks */
            --text-main: #0F172A;
            --text-muted: #475569;
            --text-faint: #64748B;
            
            /* Border dengan Tint Biru Lembut (Bukan Abu-abu kusam) */
            --border-light: rgba(37, 99, 235, 0.12);
            --border: rgba(37, 99, 235, 0.2);
            --border-strong: rgba(37, 99, 235, 0.3);
            
            /* Warna Utama (Biru Modern) */
            --primary: #2563EB;
            --primary-dark: #1E40AF;
            --primary-soft: #EFF6FF;
            --primary-text: #1D4ED8;

            /* Warna Aksen (Subtle / Lembut) */
            --accent-purple-soft: #F5F3FF;
            --accent-purple-text: #8B5CF6;
            --accent-green-soft: #ECFDF5;
            --accent-green-text: #10B981;
            --accent-amber-soft: #FFFBEB;
            --accent-amber-text: #F59E0B;
            
            --success: #10B981;
            --danger: #EF4444;
            --danger-soft: #FEF2F2;
            --danger-border: #FECACA;
            
            /* Typography & Radius */
            --font-ui: 'Inter', -apple-system, sans-serif;
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 16px;
            
            /* Shadow dengan Tint Biru (Bikin UI lebih berwarna dan hidup) */
            --shadow-xs: 0 2px 4px rgba(37, 99, 235, 0.04);
            --shadow-sm: 0 4px 12px rgba(37, 99, 235, 0.06), 0 2px 4px rgba(37, 99, 235, 0.04);
            --shadow-md: 0 12px 24px rgba(37, 99, 235, 0.08), 0 4px 8px rgba(37, 99, 235, 0.04);
            --shadow-hover: 0 20px 30px rgba(37, 99, 235, 0.12), 0 10px 15px rgba(37, 99, 235, 0.06);
            
            /* Animasi Smooth */
            --transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
        }

        * { box-sizing: border-box; }

        body {
            font-family: var(--font-ui);
            color: var(--text-main);
            -webkit-font-smoothing: antialiased;
            line-height: 1.5;
            margin: 0;
            overflow-x: hidden;
            
            /* BACKGROUND AURORA HALUS - Menghilangkan kesan putih polos */
            background-color: #F8FAFC;
            background-image: 
                radial-gradient(at 0% 0%, rgba(219, 234, 254, 0.7) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(224, 231, 255, 0.7) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(243, 232, 255, 0.6) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(224, 242, 254, 0.7) 0px, transparent 50%);
            background-attachment: fixed;
        }

        h1, h2, h3, h4, h5, h6 { font-weight: 700; color: var(--text-main); margin-bottom: 0; letter-spacing: -0.02em; }
        p { margin-bottom: 0; }
        a { text-decoration: none; transition: var(--transition); }
        ::selection { background: var(--primary-soft); color: var(--primary-dark); }

        .text-muted { color: var(--text-muted) !important; }
        .text-faint { color: var(--text-faint) !important; }
        .text-sm { font-size: 0.875rem; }
        .text-xs { font-size: 0.75rem; }

        /* =========================================
           APP SHELL & HEADER 
        ========================================= */
        .app-container { display: flex; flex-direction: column; min-height: 100vh; }
        .main-wrapper { flex: 1; display: flex; flex-direction: column; }

        .topbar {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-light);
            box-shadow: var(--shadow-xs);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .topbar-brand { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; transition: var(--transition); }
        .topbar-brand:hover { transform: translateY(-1px); }
        .brand-mark {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), #4F46E5);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            color: #fff;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .brand-text { font-size: 1.25rem; font-weight: 800; letter-spacing: -0.02em; color: var(--text-main); }
        .brand-text em { font-style: normal; color: var(--primary); }
        .topbar-meta { font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-faint); }

        /* Pembungkus Konten Tengah */
        .page-header { padding: 3rem 2rem 2rem 2rem; margin: 0 auto; max-width: 1180px; width: 100%; }
        
        .page-title { 
            font-size: 2rem; 
            font-weight: 800; 
            margin-bottom: 0.5rem; 
            position: relative;
            display: inline-block;
        }
        .page-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 32px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #8B5CF6);
            border-radius: 4px;
        }
        .page-subtitle { color: var(--text-muted); font-size: 1rem; font-weight: 400; margin-top: 0.75rem; }
        .content-area { padding: 0 2rem 4rem 2rem; max-width: 1180px; width: 100%; margin: 0 auto; }

        /* =========================================
           BUTTONS & SURFACES (SUBTLE GLASS)
        ========================================= */
        .surface, .stat-row, .film-card { 
            background-color: var(--surface); 
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-light); 
        }
        
        .surface { border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); }

        .btn {
            font-family: var(--font-ui); font-size: 0.875rem; font-weight: 600;
            padding: 0.65rem 1.25rem; border-radius: 8px; transition: var(--transition);
            display: inline-flex; align-items: center; gap: 0.5rem; border: none;
        }
        .btn-primary { 
            background: linear-gradient(135deg, var(--primary), #3B82F6); 
            color: #fff; 
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); 
        }
        .btn-primary:hover, .btn-primary:focus { 
            background: linear-gradient(135deg, var(--primary-dark), var(--primary)); 
            color: #fff; 
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35); 
        }
        .btn-secondary { background-color: #fff; border: 1px solid var(--border); color: var(--text-main); box-shadow: var(--shadow-xs); }
        .btn-secondary:hover { background-color: var(--primary-soft); color: var(--primary); border-color: var(--border-strong); }

        /* =========================================
           STATISTIK 
        ========================================= */
        .stat-row { 
            display: flex; flex-wrap: wrap; 
            border-radius: var(--radius-lg); 
            box-shadow: var(--shadow-sm); overflow: hidden; 
        }
        .stat-item { 
            flex: 1 1 220px; 
            padding: 1.75rem 1.75rem 1.75rem 5rem; 
            border-right: 1px solid var(--border-light); 
            position: relative; 
            transition: var(--transition);
            background: transparent;
        }
        .stat-item:last-child { border-right: none; }
        .stat-item:hover { background-color: rgba(255, 255, 255, 0.5); }

        .stat-item::before {
            content: ''; font-family: "Font Awesome 6 Free"; font-weight: 900;
            position: absolute; left: 1.5rem; top: 50%; transform: translateY(-50%);
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
            transition: var(--transition);
        }
        .stat-item:hover::before { transform: translateY(-50%) scale(1.05); }

        .stat-item:nth-child(1)::before { content: '\f008'; color: var(--primary-text); background-color: var(--primary-soft); }
        .stat-item:nth-child(2)::before { content: '\f5fd'; color: var(--accent-purple-text); background-color: var(--accent-purple-soft); }
        .stat-item:nth-child(3)::before { content: '\f073'; color: var(--accent-green-text); background-color: var(--accent-green-soft); }
        .stat-item:nth-child(4)::before { content: '\f005'; color: var(--accent-amber-text); background-color: var(--accent-amber-soft); }

        .stat-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); margin-bottom: 0.4rem; display: block; }
        .stat-value { font-size: 1.85rem; font-weight: 800; color: var(--text-main); line-height: 1; letter-spacing: -0.02em; }
        .stat-value small { font-size: 0.875rem; font-weight: 600; color: var(--text-faint); margin-left: 0.2rem; }

        /* =========================================
           FILM CARD GRID 
        ========================================= */
        .film-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 1.75rem; }
        
        .film-card { 
            display: block; 
            border-radius: 14px; 
            overflow: hidden; text-decoration: none; 
            box-shadow: var(--shadow-sm); 
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease, border-color 0.35s; 
        }
        .film-card:hover { 
            transform: translateY(-8px); 
            box-shadow: var(--shadow-hover); 
            border-color: rgba(37, 99, 235, 0.4); 
            background-color: #ffffff;
        }
        
        .film-card .poster-wrap { aspect-ratio: 2 / 3; background: #E2E8F0; position: relative; overflow: hidden; }
        .film-card .poster-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
        .film-card:hover .poster-wrap img { transform: scale(1.08); }
        
        .film-card .poster-wrap::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(15, 23, 42, 0.5) 0%, transparent 50%);
            opacity: 0; transition: opacity 0.4s ease; pointer-events: none;
        }
        .film-card:hover .poster-wrap::after { opacity: 1; }

        .film-card-body { padding: 1.25rem 1rem; }
        .film-card-title { font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.2rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .film-card-director { font-size: 0.75rem; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 500; }
        
        .rating { 
            background: var(--accent-amber-soft) !important; 
            color: var(--accent-amber-text) !important; 
            padding: 0.25rem 0.5rem; 
            border-radius: 6px; 
            font-size: 0.75rem !important; 
            font-weight: 700 !important; 
            display: inline-flex; align-items: center; gap: 4px; 
        }
        .rating i { color: var(--accent-amber-text) !important; font-size: 0.7rem; }
        
        .badge { 
            background-color: var(--primary-soft); color: var(--primary-text); 
            border: none; padding: 0.35rem 0.65rem; font-size: 0.6875rem; font-weight: 600; 
            border-radius: 6px; transition: var(--transition); 
        }
        .film-card:hover .badge { background-color: var(--primary); color: #fff; }

        /* =========================================
           FORMS & OTHER UI
        ========================================= */
        .form-label { font-size: 0.8125rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.5rem; }
        .form-control, .form-select {
            font-family: var(--font-ui); font-size: 0.875rem; padding: 0.65rem 1rem;
            border: 1px solid var(--border); border-radius: 8px; color: var(--text-main);
            background-color: rgba(255, 255, 255, 0.8); transition: var(--transition); box-shadow: var(--shadow-xs);
        }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 4px var(--primary-soft); outline: none; background-color: #fff; }
        
        .upload-dropzone { border: 2px dashed var(--border); border-radius: 12px; padding: 2.5rem 1.5rem; text-align: center; cursor: pointer; transition: var(--transition); background: rgba(255, 255, 255, 0.5); }
        .upload-dropzone:hover { border-color: var(--primary); background: var(--primary-soft); transform: translateY(-2px); }
        
        .alert-toast { background-color: var(--accent-green-soft); border: 1px solid #A7F3D0; color: var(--accent-green-text); padding: 1rem 1.25rem; border-radius: 10px; display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem; font-size: 0.875rem; font-weight: 600; box-shadow: var(--shadow-sm); }
        .alert-toast.is-error { background-color: var(--danger-soft); border-color: var(--danger-border); color: var(--danger); }

        .empty-state { text-align: center; padding: 4rem 1.5rem; }
        .empty-state i { font-size: 2.5rem; color: var(--border-strong); margin-bottom: 1.25rem; display: block; }
        .empty-state h6 { font-size: 1.1rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem; }
        .empty-state p { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem; }

        /* RESPONSIVE */
        @media (max-width: 1200px) { .film-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (max-width: 991.98px) { 
            .film-grid { grid-template-columns: repeat(3, 1fr); gap: 1.25rem; }
            .topbar { padding: 0 1.5rem; }
            .page-header, .content-area { padding-left: 1.5rem; padding-right: 1.5rem; }
            .stat-item { padding: 1.5rem 1.5rem 1.5rem 4.5rem; border-right: none; border-bottom: 1px solid var(--border-light); }
            .stat-item:last-child { border-bottom: none; }
        }
        @media (max-width: 576px) { 
            .film-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
            .page-header { padding-top: 2rem; }
        }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Main Content -->
        <main class="main-wrapper">
            
            <!-- Topbar -->
            <header class="topbar">
                <a href="{{ route('dashboard') }}" class="topbar-brand">
                    <span class="brand-mark"><i class="fas fa-clapperboard"></i></span>
                    <span class="brand-text"><em>Cine</em>ma</span>
                </a>
                <span class="topbar-meta d-none d-md-inline">Rating Film</span>
            </header>

            <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
                <div>
                    <h1 class="page-title">@yield('page_title')</h1>
                    <p class="page-subtitle">@yield('page_subtitle')</p>
                </div>
                <div>
                    @yield('page_actions')
                </div>
            </div>

            <div class="content-area">
                @if (session('success'))
                    <div class="alert-toast">
                        <i class="fas fa-check-circle fs-5"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert-toast is-error">
                        <i class="fas fa-circle-exclamation fs-5"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).forEach(function (el) {
            new bootstrap.Tooltip(el);
        });
    </script>
    @yield('scripts')
</body>
</html>
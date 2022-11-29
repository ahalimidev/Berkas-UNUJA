<div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <h1 class=" mt-5"><span class="text-primary">Universitas</span> <span class="text-warning">Nurul Jadid</span>
        </h1>

    </div>
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
                @if (Auth::guard('web')->check())
                    @if (Auth::user('web')->id_user == 1)
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('auth.index') }}">
                                <span class="menu-icon">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                </span>
                                <span class="menu-title">Tambah Login</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('dashboard.dashboard') }}">
                                <span class="menu-icon">
                                    <i class="bi bi-display"></i>
                                </span>
                                <span class="menu-title">Monitoring</span>
                            </a>
                        </div>
                    @endif
                @endif
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('dashboard.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-download"></i>
                        </span>
                        <span class="menu-title">Download Berkas</span>
                    </a>
                </div>
                @if (Auth::guard('web')->check())
                    <div class="menu-item">
                        @if (Auth::user('web')->id_lembaga != null || Auth::user('web')->id_fakultas != null)
                            <a class="menu-link" href="{{ route('upload_berkas.index') }}">
                                <span class="menu-icon">
                                    <i class="bi bi-upload"></i>
                                </span>
                                <span class="menu-title">Upload Berkas</span>
                            </a>
                        @else
                            <a class="menu-link" href="{{ route('upload.index') }}">
                                <span class="menu-icon">
                                    <i class="bi bi-upload"></i>
                                </span>
                                <span class="menu-title">Upload Berkas</span>
                            </a>
                        @endif

                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('kategori.index') }}">
                            <span class="menu-icon">
                                <i class="bi bi-list"></i>
                            </span>
                            <span class="menu-title">Kategori Berkas</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('sub_kategori.index') }}">
                            <span class="menu-icon">
                                <i class="bi bi-list"></i>
                            </span>
                            <span class="menu-title">sub Kategori Berkas</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

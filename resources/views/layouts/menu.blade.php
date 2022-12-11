<div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <h1 class=" mt-5"><span class="text-primary">Universitas</span> <span class="text-warning">Nurul
                Jadid</span></h1>
    </div>
    <div class="aside-menu flex-column-fluid mt-8">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <div class="menu menu-column menu-rounded fw-bold fs-6" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('dashboard.index') }}">
                        <span class="menu-icon">
                            <i class="bi bi-download"></i>
                        </span>
                        <span class="menu-title">Download Berkas</span>
                    </a>
                </div>
                @if (Auth::guard('web')->check())
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="bi bi-upload"></i>
                            </span>
                            <span class="menu-title text-primary">Upload Berkas</span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('berkas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Berkas Utama</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ route('sub_berkas.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Sub Berkas</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('jenis_berkas.index') }}">
                            <span class="menu-icon">
                                <i class="bi bi-file-earmark-ruled"></i>
                            </span>
                            <span class="menu-title">Jenis Berkas</span>
                        </a>
                    </div>
                    @if (Auth::guard('web')->user()->id_user == 1)
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('user.index') }}">
                                <span class="menu-icon">
                                    <i class="bi bi-person"></i>
                                </span>
                                <span class="menu-title">User</span>
                            </a>
                        </div>
                    @endif

                @endif
            </div>
        </div>
    </div>
</div>

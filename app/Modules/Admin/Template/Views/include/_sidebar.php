<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="<?= site_url('admin/dashboard') ?>" class="waves-effect">
                       <i class="bx bx-home-circle"></i>
                       <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layer"></i>
                        <span key="t-plan">Plan</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                       <li><a href="<?= site_url('admin/plan') ?>" key="t-plan">Plans</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
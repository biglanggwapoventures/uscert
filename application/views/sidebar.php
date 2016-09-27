<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
        <div class="pull-left image">
            <img src="<?= base_url('assets/img/display-photo-placeholder.png') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?= user('fullname') ?: user('login_username') ?></p>
            <!-- Status -->
            <a href="#"><i class="fa fa-key text-success"></i> <?= login_type_description(user('login_type'))?></a>
        </div>
        </div>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <?php $visited = $this->uri->segment(1); ?>

            <?php if(login_type('sa')):?>
                <li class="header">SUPERADMIN MENU</li>
                <li class="<?= $visited  === 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> <span>Home</span></a>
                </li>
                <li class="<?= $visited === 'organizations' ? 'active' : '' ?>">
                    <a href="<?= site_url('organizations') ?>"><i class="fa fa-institution"></i> <span>Organizations</span></a>
                </li>
                <li class="<?= $visited  === 'admins' ? 'active' : '' ?>">
                    <a href="<?= site_url('admins') ?>"><i class="fa fa-key"></i> <span>Admins</span></a>
                </li>
                <li class="<?= $visited === 'reports' ? 'active' : '' ?>">
                    <a href="<?= site_url('reports') ?>"><i class="fa fa-list-alt"></i> <span>Reports</span></a>
                </li>
                 <li class="<?= $visited === 'gis' ? 'active' : '' ?>">
                    <a href="<?= site_url('gis') ?>"><i class="fa fa-globe"></i> <span>GIS</span></a>
                </li>
            <?php endif;?>
           

            <?php if(login_type('a')):?>
            <li class="header">ADMIN MENU</li>
             <li class="<?= $visited  === 'dashboard' ? 'active' : '' ?>">
                <a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> <span>Home</span></a>
            </li>
            <li class="<?= $visited === 'volunteers' ? 'active' : '' ?>">
                <a href="<?= site_url('volunteers') ?>"><i class="fa fa-users"></i> <span>Responders</span></a>
            </li>
            <li class="<?= in_array($visited, ['vehicles', 'vehicle-types']) ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-car"></i> <span>Vehicles</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $visited === 'vehicles' ? 'active' : '' ?>">
                        <a href="<?= site_url('vehicles') ?>"><i class="fa fa-circle-o"></i> Manage</a>
                    </li>
                    <li class="<?= $visited === 'vehicle-types' ? 'active' : '' ?>">
                        <a href="<?= site_url('vehicle-types') ?>"><i class="fa fa-circle-o"></i> Types</a>
                    </li>
                </ul>
            </li>
            <?php $inIncidentsPage = in_array($visited, ['reports']); ?>
            <li class="<?= $inIncidentsPage ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-map"></i> <span>Incidents</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php $status = $this->input->get('status');?>
                    <li class="<?= $inIncidentsPage && $status === 'approved' ? 'active' : '' ?>">
                        <a href="<?= site_url('reports?status=approved') ?>"><i class="fa fa-circle-o"></i> Approved</a>
                    </li>
                    <li class="<?= $inIncidentsPage && !in_array($status, ['approved', 'rejected']) ? 'active' : '' ?>">
                        <a href="<?= site_url('reports?status=pending') ?>"><i class="fa fa-circle-o"></i> Pending</a>
                    </li>
                    <li class="<?= $inIncidentsPage && $status === 'rejected' ? 'active' : '' ?>">
                        <a href="<?= site_url('reports?status=rejected') ?>"><i class="fa fa-circle-o"></i> Rejected</a>
                    </li>
                </ul>
            </li>
            <li class="<?= $visited === 'gis' ? 'active' : '' ?>">
                <a href="<?= site_url('gis') ?>"><i class="fa fa-globe"></i> <span>GIS</span></a>
            </li>
            <li class="<?= $visited  === 'attendance' ? 'active' : '' ?>">
                <a href="<?= site_url('attendance') ?>"><i class="fa fa-calendar"></i> <span>Attendance</span></a>
            </li>
            <?php endif;?>

            <?php if(login_type('v')):?>
            <li class="header">VOLUNTEER MENU</li>
            <li class="<?= $visited  === 'dashboard' ? 'active' : '' ?>">
                <a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> <span>Home</span></a>
            </li>
            <?php $inIncidentsPage = in_array($visited, ['reports']); ?>
            <li class="<?= $inIncidentsPage ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Incident Reports</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= site_url('reports') ?>"><i class="fa fa-circle-o"></i> All</a>
                    </li>
                    <li>
                        <a href="<?= site_url('reports?show=own') ?>"><i class="fa fa-circle-o"></i> My Reports</a>
                    </li>
                    
                </ul>
            </li>
            <li class="<?= $visited === 'gis' ? 'active' : '' ?>">
                <a href="<?= site_url('gis') ?>"><i class="fa fa-globe"></i> <span>GIS</span></a>
            </li>
             <li class="<?= $visited  === 'attendance' ? 'active' : '' ?>">
                <a href="<?= site_url('attendance') ?>"><i class="fa fa-calendar"></i> <span>Attendance</span></a>
            </li>
             <?php endif;?>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
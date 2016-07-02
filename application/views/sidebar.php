<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
        <div class="pull-left image">
            <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Alexander Pierce</p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
        </div>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <?php $visited = $this->uri->segment(1); ?>
            
           
            <!-- Optionally, you can add icons to the links -->
            <li class="header">ADMIN MENU</li>
             <li class="<?= $visited  === 'dashboard' ? 'active' : '' ?>">
                <a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> <span>Home</span></a>
            </li>
            <li class="<?= $visited === 'personnel' ? 'active' : '' ?>">
                <a href="<?= site_url('personnel') ?>"><i class="fa fa-users"></i> <span>Personnel</span></a>
            </li>
            <li class="<?= $visited === 'organizations' ? 'active' : '' ?>">
                <a href="<?= site_url('organizations') ?>"><i class="fa fa-institution"></i> <span>Organizations</span></a>
            </li>
            <li class="<?= $visited === 'vehicles' ? 'active' : '' ?>">
                <a href="<?= site_url('vehicles') ?>"><i class="fa fa-car"></i> <span>Vehicles</span></a>
            </li>
            <li class="<?= $visited === 'incidents' ? 'active' : '' ?>">
                <a href="<?= site_url('incidents') ?>"><i class="fa fa-map"></i> <span>Incidents</span></a>
            </li>
            <li class="<?= $visited === 'gis' ? 'active' : '' ?>">
                <a href="<?= site_url('gis') ?>"><i class="fa fa-globe"></i> <span>GIS</span></a>
            </li>
            <li class="header">USER MENU</li>
            <li class="<?= $visited  === 'dashboard' ? 'active' : '' ?>">
                <a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> <span>Home</span></a>
            </li>
            <li class="<?= $visited  === 'attendance' ? 'active' : '' ?>">
                <a href="<?= site_url('attendance') ?>"><i class="fa fa-calendar"></i> <span>Attendance</span></a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
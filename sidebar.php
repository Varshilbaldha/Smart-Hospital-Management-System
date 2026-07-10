<?php

$current_page = basename($_SERVER['PHP_SELF']);

?>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="sidebar.css">

<aside class="sidebar closed" id="sidebar">

    <div class="hospital-logo">

        <button type="button"
                class="sidebar-toggle"
                id="sidebarToggle">

            <i class="fa-solid fa-hospital"></i>

        </button>

        <h2>
            <?php
            echo htmlspecialchars(
                $_SESSION['hospital_name'] ?? 'Hospital'
            );
            ?>
        </h2>

    </div>


    <div class="admin-profile">

        <div class="admin-icon">

            <i class="fa-solid fa-user-doctor"></i>

        </div>

        <div>

            <h3>
                <?php
                echo htmlspecialchars(
                    $_SESSION['admin_name'] ?? 'Administrator'
                );
                ?>
            </h3>

            <p>Administrator</p>

        </div>

    </div>


    <nav class="menu">

        <a href="admin_dashboard.php"
           class="<?php echo $current_page === 'admin_dashboard.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-table-columns"></i>

            <span>Dashboard</span>

        </a>


        


        <a href="departments.php"
           class="<?php echo $current_page === 'departments.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-building"></i>

            <span>Departments</span>

        </a>


        <a href="doctors.php"
           class="<?php echo $current_page === 'doctors.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-user-doctor"></i>

            <span>Doctors</span>

        </a>


        <a href="staff.php"
           class="<?php echo $current_page === 'staff.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-users"></i>

            <span>Staff</span>

        </a>


        <a href="patients.php"
           class="<?php echo $current_page === 'patients.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-bed-pulse"></i>

            <span>Patients</span>

        </a>


        <a href="appointments.php"
           class="<?php echo $current_page === 'appointments.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-calendar-check"></i>

            <span>Appointments</span>

        </a>


        <a href="services.php"
           class="<?php echo $current_page === 'services.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-hand-holding-medical"></i>

            <span>Services</span>

        </a>


        <a href="reports.php"
           class="<?php echo $current_page === 'reports.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-chart-line"></i>

            <span>Reports</span>

        </a>


        <a href="settings.php"
           class="<?php echo $current_page === 'settings.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-gear"></i>

            <span>Settings</span>

        </a>


        <a href="logout.php"
             class="<?php echo $current_page === 'logout.php' ? 'active' : ''; ?>">

            <i class="fa-solid fa-right-from-bracket"></i>

            <span>Logout</span>

        </a>

    </nav>

</aside>
<script src="sidebar.js">   </script>

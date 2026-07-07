<?php

require 'auth.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Hospital Admin Dashboard</title>

    <link rel="stylesheet"
          href="admin_dashboard.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>




<body>



<div class="dashboard">

    <aside class="sidebar closed" id="sidebar">

        <div class="hospital-logo">

            <button class="sidebar-toggle" id="sidebarToggle">

                 <i class="fa-solid fa-hospital"></i>

</button>

            <h2>
                <?php
                echo htmlspecialchars(
                    $_SESSION['hospital_name']
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
                        $_SESSION['admin_name']
                    );
                    ?>
                </h3>

                <p>Administrator</p>

            </div>

        </div>


        

        <nav class="menu">

            <a href="admin_dashboard.php"
               class="active">

                <i class="fa-solid fa-table-columns"></i>

                <span>Dashboard</span>

            </a>


            <a href="hospital_profile.php">

                <i class="fa-solid fa-hospital-user"></i>

                <span>Hospital Profile</span>

            </a>


            <a href="departments.php">

                <i class="fa-solid fa-building"></i>

                <span>Departments</span>

            </a>


            <a href="doctors.php">

                <i class="fa-solid fa-user-doctor"></i>

                <span>Doctors</span>

            </a>


            <a href="staff.php">

                <i class="fa-solid fa-users"></i>

                <span>Staff</span>

            </a>


            <a href="patients.php">

                <i class="fa-solid fa-bed-pulse"></i>

                <span>Patients</span>

            </a>


            <a href="appointments.php">

                <i class="fa-solid fa-calendar-check"></i>

                <span>Appointments</span>

            </a>


            <a href="services.php">

                <i class="fa-solid fa-hand-holding-medical"></i>

                <span>Services</span>

            </a>


            <a href="reports.php">

                <i class="fa-solid fa-chart-line"></i>

                <span>Reports</span>

            </a>


            <a href="settings.php">

                <i class="fa-solid fa-gear"></i>

                <span>Settings</span>

            </a>


            <a href="logout.php">

                <i class="fa-solid fa-right-from-bracket"></i>

                <span>Logout</span>

            </a>

        </nav>

    </aside>


  

    <main class="main-content">


        <header class="topbar">

            <div class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text" placeholder="Search anything...">

            </div>


            <div class="top-icons">

                <i class="fa-regular fa-bell"></i>

                <i class="fa-regular fa-envelope"></i>

                <div class="admin-small">

                    <i class="fa-solid fa-user"></i>

                </div>

            </div>

        </header>



        <section class="welcome">

            <h1>Dashboard</h1>

            <p>
                Welcome back,
                <b>
                    <?php
                    echo htmlspecialchars(
                        $_SESSION['admin_name']
                    );
                    ?>
                </b>
                👋
            </p>

        </section>



        <section class="stats">

            <div class="stat-card">

                <i class="fa-solid fa-user-doctor"></i>

                <div>

                    <p>Total Doctors</p>

                    <h2>0</h2>

                </div>

            </div>


            <div class="stat-card">

                <i class="fa-solid fa-users"></i>

                <div>

                    <p>Total Staff</p>

                    <h2>0</h2>

                </div>

            </div>


            <div class="stat-card">

                <i class="fa-solid fa-calendar-check"></i>

                <div>

                    <p>Today's Appointments</p>

                    <h2>0</h2>

                </div>

            </div>


            <div class="stat-card">

                <i class="fa-solid fa-bed-pulse"></i>

                <div>

                    <p>Total Patients</p>

                    <h2>0</h2>

                </div>

            </div>

        </section>


        <section class="analytics">

    <div class="chart-card appointments-chart">

        <div class="card-header">

            <h3>Appointments Overview</h3>

            <i class="fa-solid fa-ellipsis"></i>

        </div>

        <div class="chart-placeholder">

            <canvas id="appointmentChart"></canvas>

        </div>

    </div>


    <div class="chart-card department-chart">

        <div class="card-header">

            <h3>Patients by Department</h3>

            <i class="fa-solid fa-ellipsis"></i>

        </div>

        <div class="department-content">

            <div class="donut-container">

                <canvas id="departmentChart"></canvas>

            </div>

        </div>

    </div>

</section>
<section class="dashboard-bottom">

    <div class="bottom-card">

        <div class="card-header">

            <h3>Recent Appointments</h3>

            <i class="fa-solid fa-ellipsis"></i>

        </div>


        <div class="appointment-list">

            <div class="appointment-item">

                <div class="patient-avatar">
                    RK
                </div>

                <div class="patient-info">
                    <h4>Rahul Kumar</h4>
                    <p>Cardiology</p>
                </div>

                <div class="appointment-time">
                    09:30 AM
                </div>

                <span class="status confirmed">
                    Confirmed
                </span>

            </div>


            <div class="appointment-item">

                <div class="patient-avatar">
                    PS
                </div>

                <div class="patient-info">
                    <h4>Priya Shah</h4>
                    <p>Neurology</p>
                </div>

                <div class="appointment-time">
                    10:00 AM
                </div>

                <span class="status confirmed">
                    Confirmed
                </span>

            </div>


            <div class="appointment-item">

                <div class="patient-avatar">
                    AM
                </div>

                <div class="patient-info">
                    <h4>Amit Mehta</h4>
                    <p>Orthopedics</p>
                </div>

                <div class="appointment-time">
                    10:30 AM
                </div>

                <span class="status pending">
                    Pending
                </span>

            </div>

        </div>

    </div>


    <div class="bottom-card">

        <div class="card-header">

            <h3>Hospital Activity</h3>

            <i class="fa-solid fa-ellipsis"></i>

        </div>


        <div class="activity-list">

            <div class="activity-item">

                <div class="activity-dot"></div>

                <div class="activity-info">
                    <p>New patient registered</p>
                    <span>5 min ago</span>
                </div>

            </div>


            <div class="activity-item">

                <div class="activity-dot"></div>

                <div class="activity-info">
                    <p>Appointment booked</p>
                    <span>15 min ago</span>
                </div>

            </div>


            <div class="activity-item">

                <div class="activity-dot"></div>

                <div class="activity-info">
                    <p>Doctor added</p>
                    <span>30 min ago</span>
                </div>

            </div>


            <div class="activity-item">

                <div class="activity-dot"></div>

                <div class="activity-info">
                    <p>Patient record updated</p>
                    <span>1 hour ago</span>
                </div>

            </div>

        </div>

    </div>

</section>

        


    </main>

</div>
<script src="admin_dashboard.js"></script>

</body>

</html>
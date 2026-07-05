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

</head>

<body>

<div class="dashboard">


    <aside class="sidebar">

        <div class="hospital-logo">

            <div class="logo-icon">
                <i class="fa-solid fa-hospital"></i>
            </div>

            <h2>
                <?php
                echo htmlspecialchars(
                    $_SESSION['hospital_name']
                );
                ?>
            </h2>

        </div>


        <!-- ADMIN PROFILE -->

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


        <!-- MENU -->

        <nav class="menu">

            <a href="admin_dashboard.php"
               class="active">

                <i class="fa-solid fa-table-columns"></i>

                Dashboard

            </a>


            <a href="hospital_profile.php">

                <i class="fa-solid fa-hospital-user"></i>

                Hospital Profile

            </a>


            <a href="departments.php">

                <i class="fa-solid fa-building"></i>

                Departments

            </a>


            <a href="doctors.php">

                <i class="fa-solid fa-user-doctor"></i>

                Doctors

            </a>


            <a href="staff.php">

                <i class="fa-solid fa-users"></i>

                Staff

            </a>


            <a href="patients.php">

                <i class="fa-solid fa-bed-pulse"></i>

                Patients

            </a>


            <a href="appointments.php">

                <i class="fa-solid fa-calendar-check"></i>

                Appointments

            </a>


            <a href="services.php">

                <i class="fa-solid fa-hand-holding-medical"></i>

                Services

            </a>


            <a href="reports.php">

                <i class="fa-solid fa-chart-line"></i>

                Reports

            </a>


            <a href="settings.php">

                <i class="fa-solid fa-gear"></i>

                Settings

            </a>


            <a href="logout.php">

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

            </a>

        </nav>

    </aside>


    <!-- MAIN CONTENT -->

    <main class="main-content">

        <!-- TOP BAR -->

        <header class="topbar">

            <div class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    placeholder="Search anything...">

            </div>


            <div class="top-icons">

                <i class="fa-regular fa-bell"></i>

                <i class="fa-regular fa-envelope"></i>

                <div class="admin-small">

                    <i class="fa-solid fa-user"></i>

                </div>

            </div>

        </header>


        <!-- PAGE TITLE -->

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


        <!-- STAT CARDS -->

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

    </main>

</div>

</body>

</html>
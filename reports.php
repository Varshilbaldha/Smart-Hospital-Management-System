<?php
// require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reports Dashboard</title>

    <link rel="stylesheet" href="sidebar.css">

    <link rel="stylesheet" href="reports.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="dashboard">

    <?php require 'sidebar.php'; ?>

    <main class="main-content">

        <!-- ==========================
                Page Header
        =========================== -->

        <div class="page-header">

            <div>

                <h1>Reports</h1>

                <p>

                    Generate and analyze hospital reports.

                </p>

            </div>

            <div class="header-buttons">

                <button class="pdf-btn">

                    <i class="fa-solid fa-file-pdf"></i>

                    Export PDF

                </button>

                <button class="excel-btn">

                    <i class="fa-solid fa-file-excel"></i>

                    Export Excel

                </button>

            </div>

        </div>


        <!-- Statistics Cards -->

        <div class="stats-container">

            <!-- Next Step -->
             <!-- Total Revenue -->

<div class="stat-card">

    <div class="stat-icon revenue">

        <i class="fa-solid fa-indian-rupee-sign"></i>

    </div>

    <div class="stat-info">

        <h4>Total Revenue</h4>

        <h2>₹ 32.5L</h2>

        <p>This Month</p>

    </div>

</div>


<!-- Total Patients -->

<div class="stat-card">

    <div class="stat-icon patients">

        <i class="fa-solid fa-bed-pulse"></i>

    </div>

    <div class="stat-info">

        <h4>Total Patients</h4>

        <h2>1,248</h2>

        <p>Registered Patients</p>

    </div>

</div>


<!-- Total Appointments -->

<div class="stat-card">

    <div class="stat-icon appointments">

        <i class="fa-solid fa-calendar-check"></i>

    </div>

    <div class="stat-info">

        <h4>Total Appointments</h4>

        <h2>1,286</h2>

        <p>This Month</p>

    </div>

</div>


<!-- Total Doctors -->

<div class="stat-card">

    <div class="stat-icon doctors">

        <i class="fa-solid fa-user-doctor"></i>

    </div>

    <div class="stat-info">

        <h4>Total Doctors</h4>

        <h2>45</h2>

        <p>Active Doctors</p>

    </div>

</div>

        </div>


        <!-- Charts Section -->

        <div class="charts-section">

            <!-- Next Step -->
             <!-- ==========================
        Revenue Chart
========================== -->

<div class="chart-card revenue-chart">

    <div class="card-header">

        <h3>Revenue Overview</h3>

        <i class="fa-solid fa-ellipsis"></i>

    </div>

    <div class="chart-box">

        <canvas id="revenueChart"></canvas>

    </div>

</div>



<!-- ==========================
        Department Chart
========================== -->

<div class="chart-card department-chart">

    <div class="card-header">

        <h3>Patients by Department</h3>

        <i class="fa-solid fa-ellipsis"></i>

    </div>

    <div class="donut-container">

        <canvas id="departmentChart"></canvas>

    </div>

</div>



<!-- ==========================
        Monthly Appointment Chart
========================== -->

<div class="chart-card appointment-chart">

    <div class="card-header">

        <h3>Monthly Appointments</h3>

        <i class="fa-solid fa-ellipsis"></i>

    </div>

    <div class="chart-box">

        <canvas id="appointmentChart"></canvas>

    </div>

</div>



<!-- ==========================
        Revenue Summary
========================== -->

<div class="chart-card summary-card">

    <div class="card-header">

        <h3>Revenue Summary</h3>

        <i class="fa-solid fa-ellipsis"></i>

    </div>

    <div class="summary-list">

        <div class="summary-item">

            <span>Cardiology</span>

            <strong>₹12,50,000</strong>

        </div>

        <div class="summary-item">

            <span>Neurology</span>

            <strong>₹8,20,000</strong>

        </div>

        <div class="summary-item">

            <span>Orthopedics</span>

            <strong>₹6,75,000</strong>

        </div>

        <div class="summary-item">

            <span>Pediatrics</span>

            <strong>₹4,60,000</strong>

        </div>

        <div class="summary-item">

            <span>Emergency</span>

            <strong>₹3,15,000</strong>

        </div>

    </div>

</div>

        </div>


        <!-- Reports Table -->

        <div class="table-container">

            <!-- Next Step -->
             <table>

    <thead>

        <tr>

            <th>Report Name</th>

            <th>Category</th>

            <th>Generated On</th>

            <th>Status</th>

            <th>Download</th>

        </tr>

    </thead>

    <tbody>

        <!-- Report 1 -->

        <tr>

            <td>

                <div class="report-info">

                    <div class="report-icon">

                        <i class="fa-solid fa-file-lines"></i>

                    </div>

                    <div>

                        <h4>Revenue Report</h4>

                        <span>Monthly Financial Report</span>

                    </div>

                </div>

            </td>

            <td>Finance</td>

            <td>05 Aug 2026</td>

            <td>

                <span class="status ready">

                    Ready

                </span>

            </td>

            <td>

                <button class="download-btn">

                    <i class="fa-solid fa-download"></i>

                    Download

                </button>

            </td>

        </tr>


        <!-- Report 2 -->

        <tr>

            <td>

                <div class="report-info">

                    <div class="report-icon">

                        <i class="fa-solid fa-user-injured"></i>

                    </div>

                    <div>

                        <h4>Patients Report</h4>

                        <span>Registered Patients</span>

                    </div>

                </div>

            </td>

            <td>Patients</td>

            <td>05 Aug 2026</td>

            <td>

                <span class="status ready">

                    Ready

                </span>

            </td>

            <td>

                <button class="download-btn">

                    <i class="fa-solid fa-download"></i>

                    Download

                </button>

            </td>

        </tr>


        <!-- Report 3 -->

        <tr>

            <td>

                <div class="report-info">

                    <div class="report-icon">

                        <i class="fa-solid fa-calendar-check"></i>

                    </div>

                    <div>

                        <h4>Appointments Report</h4>

                        <span>Appointment Summary</span>

                    </div>

                </div>

            </td>

            <td>Appointments</td>

            <td>05 Aug 2026</td>

            <td>

                <span class="status ready">

                    Ready

                </span>

            </td>

            <td>

                <button class="download-btn">

                    <i class="fa-solid fa-download"></i>

                    Download

                </button>

            </td>

        </tr>


        <!-- Report 4 -->

        <tr>

            <td>

                <div class="report-info">

                    <div class="report-icon">

                        <i class="fa-solid fa-user-doctor"></i>

                    </div>

                    <div>

                        <h4>Doctors Report</h4>

                        <span>Doctors Performance</span>

                    </div>

                </div>

            </td>

            <td>Doctors</td>

            <td>05 Aug 2026</td>

            <td>

                <span class="status processing">

                    Processing

                </span>

            </td>

            <td>

                <button class="download-btn" disabled>

                    <i class="fa-solid fa-clock"></i>

                    Pending

                </button>

            </td>

        </tr>

    </tbody>

</table>

        </div>

    </main>

</div>

<script src="reports.js"></script>

</body>
</html>
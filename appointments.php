<?php
// require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Appointments Management</title>

    <link rel="stylesheet" href="sidebar.css">

    <link rel="stylesheet" href="appointments.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

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

                <h1>Appointments</h1>

                <p>

                    Manage hospital appointments and schedules.

                </p>

            </div>

            <button class="add-btn">

                <i class="fa-solid fa-plus"></i>

                Add Appointment

            </button>

        </div>


        <!-- Statistics Cards -->

        <div class="stats-container">

            <!-- Next Step -->

            <!-- Total Appointments -->

<div class="stat-card">

    <div class="stat-icon total">

        <i class="fa-solid fa-calendar-check"></i>

    </div>

    <div class="stat-info">

        <h4>Total Appointments</h4>

        <h2>1,286</h2>

        <p>All Appointments</p>

    </div>

</div>


<!-- Today's Appointments -->

<div class="stat-card">

    <div class="stat-icon today">

        <i class="fa-solid fa-calendar-day"></i>

    </div>

    <div class="stat-info">

        <h4>Today's Appointments</h4>

        <h2>84</h2>

        <p>Scheduled Today</p>

    </div>

</div>


<!-- Completed -->

<div class="stat-card">

    <div class="stat-icon completed">

        <i class="fa-solid fa-circle-check"></i>

    </div>

    <div class="stat-info">

        <h4>Completed</h4>

        <h2>1,045</h2>

        <p>Successfully Completed</p>

    </div>

</div>


<!-- Pending -->

<div class="stat-card">

    <div class="stat-icon pending">

        <i class="fa-solid fa-clock"></i>

    </div>

    <div class="stat-info">

        <h4>Pending</h4>

        <h2>241</h2>

        <p>Waiting Confirmation</p>

    </div>

</div>

        </div>


        <!-- Search & Filter -->

        <div class="toolbar">

            <!-- Next Step -->
             <!-- ==========================
        Search Box
========================== -->

<div class="appointment-search-box">

    <i class="fa-solid fa-magnifying-glass"></i>

    <input
        type="text"
        placeholder="Search appointment...">

</div>


<!-- ==========================
        Department Filter
========================== -->

<div class="appointment-filter-box">

    <i class="fa-solid fa-building"></i>

    <select>

        <option>All Departments</option>

        <option>Cardiology</option>

        <option>Neurology</option>

        <option>Orthopedics</option>

        <option>Pediatrics</option>

    </select>

</div>


<!-- ==========================
        Doctor Filter
========================== -->

<div class="appointment-filter-box">

    <i class="fa-solid fa-user-doctor"></i>

    <select>

        <option>All Doctors</option>

        <option>Dr. Rahul Sharma</option>

        <option>Dr. Amit Patel</option>

        <option>Dr. Priya Mehta</option>

        <option>Dr. Neha Verma</option>

    </select>

</div>


<!-- ==========================
        Status Filter
========================== -->

<div class="appointment-filter-box">

    <i class="fa-solid fa-filter"></i>

    <select>

        <option>All Status</option>

        <option>Pending</option>

        <option>Confirmed</option>

        <option>Completed</option>

        <option>Cancelled</option>

    </select>

</div>


<!-- ==========================
        Filter Button
========================== -->

<button class="appointment-filter-btn">

    <i class="fa-solid fa-filter"></i>

    Filter

</button>

        </div>


        <!-- Appointment Table -->

        <div class="table-container">

            <!-- Next Step -->
             <table>

    <thead>

        <tr>

            <th>Patient</th>

            <th>Appointment ID</th>

            <th>Doctor</th>

            <th>Department</th>

            <th>Date</th>

            <th>Time</th>

            <th>Type</th>

            <th>Status</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        <!-- Row 1 -->

        <tr>

            <td>

                <div class="patient-info">

                    <img src="https://randomuser.me/api/portraits/men/32.jpg">

                    <div>

                        <h4>Rahul Sharma</h4>

                        <span>PAT-1001</span>

                    </div>

                </div>

            </td>

            <td>APT-2001</td>

            <td>Dr. Amit Patel</td>

            <td>Cardiology</td>

            <td>28 Jul 2026</td>

            <td>10:30 AM</td>

            <td>

                <span class="type online">

                    Online

                </span>

            </td>

            <td>

                <span class="status confirmed">

                    Confirmed

                </span>

            </td>

            <td>

                <button class="action-btn">

                    <i class="fa-solid fa-eye"></i>

                </button>

                <button class="action-btn">

                    <i class="fa-solid fa-pen"></i>

                </button>

                <button class="action-btn delete">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </td>

        </tr>


        <!-- Row 2 -->

        <tr>

            <td>

                <div class="patient-info">

                    <img src="https://randomuser.me/api/portraits/women/45.jpg">

                    <div>

                        <h4>Priya Patel</h4>

                        <span>PAT-1002</span>

                    </div>

                </div>

            </td>

            <td>APT-2002</td>

            <td>Dr. Neha Shah</td>

            <td>Neurology</td>

            <td>28 Jul 2026</td>

            <td>11:15 AM</td>

            <td>

                <span class="type offline">

                    Offline

                </span>

            </td>

            <td>

                <span class="status pending">

                    Pending

                </span>

            </td>

            <td>

                <button class="action-btn">

                    <i class="fa-solid fa-eye"></i>

                </button>

                <button class="action-btn">

                    <i class="fa-solid fa-pen"></i>

                </button>

                <button class="action-btn delete">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </td>

        </tr>


        <!-- Row 3 -->

        <tr>

            <td>

                <div class="patient-info">

                    <img src="https://randomuser.me/api/portraits/men/68.jpg">

                    <div>

                        <h4>Amit Kumar</h4>

                        <span>PAT-1003</span>

                    </div>

                </div>

            </td>

            <td>APT-2003</td>

            <td>Dr. Rahul Sharma</td>

            <td>Orthopedics</td>

            <td>29 Jul 2026</td>

            <td>02:00 PM</td>

            <td>

                <span class="type offline">

                    Offline

                </span>

            </td>

            <td>

                <span class="status completed">

                    Completed

                </span>

            </td>

            <td>

                <button class="action-btn">

                    <i class="fa-solid fa-eye"></i>

                </button>

                <button class="action-btn">

                    <i class="fa-solid fa-pen"></i>

                </button>

                <button class="action-btn delete">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </td>

        </tr>

    </tbody>

</table>

        </div>
        <!-- ==========================
        Pagination
========================== -->

<div class="pagination">

    <button>

        <i class="fa-solid fa-angle-left"></i>

    </button>

    <button class="active">1</button>

    <button>2</button>

    <button>3</button>

    <button>

        <i class="fa-solid fa-angle-right"></i>

    </button>

</div>



<!-- ==========================
        Add Appointment Modal
========================== -->

<div class="modal" id="appointmentModal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Add New Appointment</h2>

            <button class="close-btn">&times;</button>

        </div>

        <form id="appointmentForm">

            <div class="form-grid">

                <div class="form-group">

                    <label>Patient</label>

                    <select>

                        <option>Select Patient</option>

                        <option>Rahul Sharma</option>

                        <option>Priya Patel</option>

                        <option>Amit Kumar</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Doctor</label>

                    <select>

                        <option>Select Doctor</option>

                        <option>Dr. Amit Patel</option>

                        <option>Dr. Neha Shah</option>

                        <option>Dr. Rahul Sharma</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Department</label>

                    <select>

                        <option>Select Department</option>

                        <option>Cardiology</option>

                        <option>Neurology</option>

                        <option>Orthopedics</option>

                        <option>Pediatrics</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Appointment Date</label>

                    <input type="date">

                </div>


                <div class="form-group">

                    <label>Appointment Time</label>

                    <input type="time">

                </div>


                <div class="form-group">

                    <label>Appointment Type</label>

                    <select>

                        <option>Online</option>

                        <option>Offline</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Status</label>

                    <select>

                        <option>Pending</option>

                        <option>Confirmed</option>

                        <option>Completed</option>

                        <option>Cancelled</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Notes</label>

                    <input type="text" placeholder="Appointment notes">

                </div>

            </div>


            <div class="form-actions">

                <button
                    type="button"
                    class="cancel-btn">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="save-btn">

                    Save Appointment

                </button>

            </div>

        </form>

    </div>

</div>

    </main>

</div>

<script src="appointments.js"></script>

</body>

</html>
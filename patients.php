<?php
// require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Patients</title>

    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="patients.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="dashboard">

    <?php require 'sidebar.php'; ?>

    <main class="main-content">

        <!-- Page Header -->

        <div class="page-header">

            <div>

                <h1>Patients</h1>

                <p>
                    Manage hospital patients and their information.
                </p>

            </div>

            <button class="add-btn">

                <i class="fa-solid fa-plus"></i>

                Add Patient

            </button>

        </div>

        <!-- Statistics Cards -->

        <div class="stats-container">

            <!-- Next Step -->
             <div class="stat-card">

    <div class="stat-icon total">

        <i class="fa-solid fa-bed"></i>

    </div>

    <div class="stat-info">

        <h4>Total Patients</h4>

        <h2>1,248</h2>

        <p>Registered Patients</p>

    </div>

</div>


<div class="stat-card">

    <div class="stat-icon admitted">

        <i class="fa-solid fa-hospital-user"></i>

    </div>

    <div class="stat-info">

        <h4>Admitted Patients</h4>

        <h2>325</h2>

        <p>Currently Admitted</p>

    </div>

</div>


<div class="stat-card">

    <div class="stat-icon discharged">

        <i class="fa-solid fa-user-check"></i>

    </div>

    <div class="stat-info">

        <h4>Discharged</h4>

        <h2>890</h2>

        <p>Recovered Patients</p>

    </div>

</div>


<div class="stat-card">

    <div class="stat-icon today">

        <i class="fa-solid fa-user-plus"></i>

    </div>

    <div class="stat-info">

        <h4>Today's Registration</h4>

        <h2>33</h2>

        <p>New Patients Today</p>

    </div>

</div>

        </div>

        <!-- Toolbar -->

        <div class="toolbar">

            <!-- Next Step -->
             <!-- Search Box -->

<div class="patient-search-box">

    <i class="fa-solid fa-magnifying-glass"></i>

    <input type="text" placeholder="Search patient...">

</div>


<!-- Department Filter -->

<div class="patient-filter-box">

    <i class="fa-solid fa-building"></i>

    <select>

        <option>All Departments</option>
        <option>Cardiology</option>
        <option>Neurology</option>
        <option>Orthopedics</option>
        <option>Pediatrics</option>

    </select>

</div>


<!-- Gender Filter -->

<div class="patient-filter-box">

    <i class="fa-solid fa-venus-mars"></i>

    <select>

        <option>All Gender</option>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>

    </select>

</div>


<!-- Status Filter -->

<div class="patient-filter-box">

    <i class="fa-solid fa-filter"></i>

    <select>

        <option>All Status</option>
        <option>Admitted</option>
        <option>Discharged</option>

    </select>

</div>


<button class="patient-filter-btn">

    <i class="fa-solid fa-filter"></i>

    Filter

</button>

        </div>

        <!-- Patients Table -->

        <div class="table-container">

            <!-- Next Step -->
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
        Add Patient Modal
========================== -->

<div class="modal" id="patientModal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Add New Patient</h2>

            <button class="close-btn">&times;</button>

        </div>

        <form id="patientForm">

            <div class="form-grid">

                <div class="form-group">

                    <label>Full Name</label>

                    <input type="text" placeholder="Enter patient name">

                </div>

                <div class="form-group">

                    <label>Age</label>

                    <input type="number" placeholder="Enter age">

                </div>

                <div class="form-group">

                    <label>Gender</label>

                    <select>

                        <option>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Blood Group</label>

                    <select>

                        <option>Select Blood Group</option>
                        <option>A+</option>
                        <option>B+</option>
                        <option>AB+</option>
                        <option>O+</option>

                    </select>

                </div>

            </div>

            <div class="form-actions">

                <button type="button" class="cancel-btn">

                    Cancel

                </button>

                <button type="submit" class="save-btn">

                    Save Patient

                </button>

            </div>

        </form>

    </div>

</div>
             <table>

    <thead>

        <tr>

            <th>Patient</th>
            <th>Patient ID</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Doctor</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td>

                <div class="patient-info">

                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Patient">

                    <div>

                        <h4>Rahul Sharma</h4>

                        <span>Blood Group : O+</span>

                    </div>

                </div>

            </td>

            <td>PAT-1001</td>

            <td>32</td>

            <td>Male</td>

            <td>Cardiology</td>

            <td>Dr. Amit Patel</td>

            <td>+91 9876543210</td>

            <td>

                <span class="status admitted">

                    Admitted

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



        <tr>

            <td>

                <div class="patient-info">

                    <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Patient">

                    <div>

                        <h4>Priya Patel</h4>

                        <span>Blood Group : A+</span>

                    </div>

                </div>

            </td>

            <td>PAT-1002</td>

            <td>27</td>

            <td>Female</td>

            <td>Neurology</td>

            <td>Dr. Neha Shah</td>

            <td>+91 9988776655</td>

            <td>

                <span class="status discharged">

                    Discharged

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

    </main>

</div>

<script src="patients.js"></script>

</body>
</html>
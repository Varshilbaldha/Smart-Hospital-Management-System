<!DOCTYPE html>
<html lang="en">

<head>
    ...
    <link rel="stylesheet" href="departments.css">
</head>

<body>

<div class="dashboard">

    <?php require 'sidebar.php'; ?>
    <?php require 'topbar.php'; ?>

    <main class="main-content">
        <header class="topbar">

    <div></div>

    <div class="top-icons">

        <i class="fa-regular fa-bell"></i>

        <i class="fa-regular fa-envelope"></i>

        <div class="admin-small">

            <i class="fa-solid fa-user"></i>

        </div>

    </div>

    </header>

    <!-- Page Header -->

    <div class="page-header">

        <div>

            <h1>Departments</h1>

            <p>
                Manage hospital departments and their information.
            </p>

        </div>

        <button class="add-btn">

            <i class="fa-solid fa-plus"></i>

            Add Department

        </button>

    </div>



    <!-- Statistics Cards -->

    <div class="stats-container">

        <div class="stat-card">

            <div class="stat-icon purple">

                <i class="fa-solid fa-building"></i>

            </div>

            <div>

                <h4>Total Departments</h4>

                <h2>12</h2>

                <span>All Departments</span>

            </div>

        </div>



        <div class="stat-card">

            <div class="stat-icon green">

                <i class="fa-solid fa-user-doctor"></i>

            </div>

            <div>

                <h4>Total Doctors</h4>

                <h2>45</h2>

                <span>Across All Departments</span>

            </div>

        </div>



        <div class="stat-card">

            <div class="stat-icon blue">

                <i class="fa-solid fa-users"></i>

            </div>

            <div>

                <h4>Total Staff</h4>

                <h2>98</h2>

                <span>Across All Departments</span>

            </div>

        </div>



        <div class="stat-card">

            <div class="stat-icon orange">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>

            <div>

                <h4>Active Departments</h4>

                <h2>10</h2>

                <span>Currently Active</span>

            </div>

        </div>

    </div>


<!-- =========================
     Search & Filter
========================== -->

<div class="department-toolbar">

    <div class="search-box">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input
            type="text"
            placeholder="Search department...">

    </div>



    <select class="status-filter">

        <option>All Status</option>

        <option>Active</option>

        <option>Inactive</option>

    </select>



    <button class="filter-btn">

        <i class="fa-solid fa-filter"></i>

        Filter

    </button>

</div>
<!-- =====================================
        Department Table
====================================== -->

<div class="table-container">

    <table class="department-table">

        <thead>

            <tr>

                <th>Department Name</th>

                <th>Head Doctor</th>

                <th>Doctors</th>

                <th>Staff</th>

                <th>Location</th>

                <th>Status</th>

                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>

                    <div class="department-info">

                        <div class="department-icon">

                            <i class="fa-solid fa-heart-pulse"></i>

                        </div>

                        <div>

                            <h4>Cardiology</h4>

                            <p>Heart & Vascular Care</p>

                        </div>

                    </div>

                </td>

                <td>

                    <strong>Dr. Rahul Sharma</strong>

                    <p>MD Cardiology</p>

                </td>

                <td>

                    <span class="count doctor-count">

                        12

                    </span>

                </td>

                <td>

                    <span class="count staff-count">

                        18

                    </span>

                </td>

                <td>

                    Building A, Floor 2

                </td>

                <td>

                    <span class="status active">

                        Active

                    </span>

                </td>

                <td>

                    <div class="action-buttons">

                        <button>

                            <i class="fa-solid fa-eye"></i>

                        </button>

                        <button>

                            <i class="fa-solid fa-pen"></i>

                        </button>

                        <button>

                            <i class="fa-solid fa-ellipsis"></i>

                        </button>

                    </div>

                </td>

            </tr>
            <tr>

    <td>

        <div class="department-info">

            <div class="department-icon neuro">

                <i class="fa-solid fa-brain"></i>

            </div>

            <div>

                <h4>Neurology</h4>

                <p>Brain & Nervous System</p>

            </div>

        </div>

    </td>

    <td>

        <strong>Dr. Amit Patel</strong>

        <p>DM Neurology</p>

    </td>

    <td><span class="count doctor-count">8</span></td>

    <td><span class="count staff-count">14</span></td>

    <td>Building B, Floor 3</td>

    <td>

        <span class="status active">

            Active

        </span>

    </td>

    <td>

        <div class="action-buttons">

            <button><i class="fa-solid fa-eye"></i></button>

            <button><i class="fa-solid fa-pen"></i></button>

            <button><i class="fa-solid fa-ellipsis"></i></button>

        </div>

    </td>

</tr>




<tr>

    <td>

        <div class="department-info">

            <div class="department-icon bone">

                <i class="fa-solid fa-bone"></i>

            </div>

            <div>

                <h4>Orthopedics</h4>

                <p>Bones & Joints</p>

            </div>

        </div>

    </td>

    <td>

        <strong>Dr. Mehul Shah</strong>

        <p>MS Orthopedics</p>

    </td>

    <td><span class="count doctor-count">10</span></td>

    <td><span class="count staff-count">16</span></td>

    <td>Building A, Floor 1</td>

    <td>

        <span class="status active">

            Active

        </span>

    </td>

    <td>

        <div class="action-buttons">

            <button><i class="fa-solid fa-eye"></i></button>

            <button><i class="fa-solid fa-pen"></i></button>

            <button><i class="fa-solid fa-ellipsis"></i></button>

        </div>

    </td>

</tr>




<tr>

    <td>

        <div class="department-info">

            <div class="department-icon child">

                <i class="fa-solid fa-baby"></i>

            </div>

            <div>

                <h4>Pediatrics</h4>

                <p>Child Healthcare</p>

            </div>

        </div>

    </td>

    <td>

        <strong>Dr. Priya Patel</strong>

        <p>MD Pediatrics</p>

    </td>

    <td><span class="count doctor-count">7</span></td>

    <td><span class="count staff-count">12</span></td>

    <td>Building C</td>

    <td>

        <span class="status inactive">

            Inactive

        </span>

    </td>

    <td>

        <div class="action-buttons">

            <button><i class="fa-solid fa-eye"></i></button>

            <button><i class="fa-solid fa-pen"></i></button>

            <button><i class="fa-solid fa-ellipsis"></i></button>

        </div>

    </td>

</tr>




<tr>

    <td>

        <div class="department-info">

            <div class="department-icon emergency">

                <i class="fa-solid fa-truck-medical"></i>

            </div>

            <div>

                <h4>Emergency</h4>

                <p>24 × 7 Emergency Care</p>

            </div>

        </div>

    </td>

    <td>

        <strong>Dr. Hitesh Joshi</strong>

        <p>Emergency Specialist</p>

    </td>

    <td><span class="count doctor-count">15</span></td>

    <td><span class="count staff-count">24</span></td>

    <td>Ground Floor</td>

    <td>

        <span class="status active">

            Active

        </span>

    </td>

    <td>

        <div class="action-buttons">

            <button><i class="fa-solid fa-eye"></i></button>

            <button><i class="fa-solid fa-pen"></i></button>

            <button><i class="fa-solid fa-ellipsis"></i></button>

        </div>

    </td>

</tr>

        </tbody>

    </table>
    <div class="table-footer">

    <p>

        Showing 1 to 5 of 12 Departments

    </p>

    <div class="pagination">

        <button>

            <i class="fa-solid fa-angle-left"></i>

        </button>

        <button class="active-page">

            1

        </button>

        <button>

            2

        </button>

        <button>

            3

        </button>

        <button>

            <i class="fa-solid fa-angle-right"></i>

        </button>

    </div>

</div>
<!-- ===================================
        Add Department Modal
=================================== -->

<div class="modal-overlay" id="departmentModal">

    <div class="modal">

        <div class="modal-header">

            <h2>Add Department</h2>

            <button class="close-modal" id="closeModal">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>


        <form id="departmentForm">

            <div class="form-group">

                <label>

                    Department Name

                </label>

                <input
                    type="text"
                    placeholder="Enter Department Name">

            </div>


            <div class="form-group">

                <label>

                    Description

                </label>

                <textarea
                    placeholder="Department Description"></textarea>

            </div>


            <div class="form-row">

                <div class="form-group">

                    <label>

                        Location

                    </label>

                    <input
                        type="text"
                        placeholder="Building A">

                </div>


                <div class="form-group">

                    <label>

                        Status

                    </label>

                    <select>

                        <option>

                            Active

                        </option>

                        <option>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>


            <div class="modal-buttons">

                <button
                    type="button"
                    class="cancel-btn">

                    Cancel

                </button>


                <button
                    type="submit"
                    class="save-btn">

                    Save Department

                </button>

            </div>

        </form>

    </div>

</div>

</div>

</main>

</div>

<script src="departments.js"></script>

</body>
</html>
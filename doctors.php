<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>

    <link rel="stylesheet" href="doctors.css">
    <link rel="stylesheet" href="topbar.css">
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

            <h1>Doctors</h1>

            <p>
                Manage hospital doctors and their information.
            </p>

        </div>


        <button class="add-btn">

            <i class="fa-solid fa-plus"></i>

            Add Doctor

        </button>

    </div>



    <!-- ==========================
            Statistics Cards
    =========================== -->

    <div class="stats-container">

        <div class="stat-card">

            <div class="card-icon purple">

                <i class="fa-solid fa-user-doctor"></i>

            </div>

            <div>

                <p>Total Doctors</p>

                <h2>45</h2>

                <span>All Doctors</span>

            </div>

        </div>



        <div class="stat-card">

            <div class="card-icon green">

                <i class="fa-solid fa-stethoscope"></i>

            </div>

            <div>

                <p>Active Doctors</p>

                <h2>38</h2>

                <span>Currently Active</span>

            </div>

        </div>



        <div class="stat-card">

            <div class="card-icon blue">

                <i class="fa-solid fa-users"></i>

            </div>

            <div>

                <p>Total Departments</p>

                <h2>12</h2>

                <span>With Doctors</span>

            </div>

        </div>



        <div class="stat-card">

            <div class="card-icon orange">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>

            <div>

                <p>Total Specializations</p>

                <h2>18</h2>

                <span>Specializations Available</span>

            </div>

        </div>

    </div>

    <!-- ===================================
        Search & Filter Section
=================================== -->

<div class="toolbar">

    <!-- Search Box -->

    <div class="search-box">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input
            type="text"
            placeholder="Search doctor...">

    </div>



    <!-- Department Filter -->

    <div class="filter-box">

        <i class="fa-solid fa-filter"></i>

        <select>

            <option>

                All Departments

            </option>

            <option>

                Cardiology

            </option>

            <option>

                Orthopedics

            </option>

            <option>

                Neurology

            </option>

            <option>

                Pediatrics

            </option>

            <option>

                Pulmonology

            </option>

        </select>

    </div>



    <!-- Status Filter -->

    <div class="filter-box">

        <i class="fa-solid fa-filter"></i>

        <select>

            <option>

                All Status

            </option>

            <option>

                Active

            </option>

            <option>

                Inactive

            </option>

        </select>

    </div>



    <!-- Filter Button -->

    <button class="filter-btn">

        <i class="fa-solid fa-filter"></i>

        Filter

    </button>

</div>
<!-- ===================================
        Doctors Table
=================================== -->

<div class="table-container">

    <table>

        <thead>

            <tr>

                <th>Doctor Name</th>

                <th>Department</th>

                <th>Specialization</th>

                <th>Experience</th>

                <th>Patients</th>

                <th>Consultation Fee</th>

                <th>Status</th>

                <th>Actions</th>

            </tr>

        </thead>


        <tbody>

            <!-- Doctor 1 -->

            <tr>

                <td>

                    <div class="doctor-info">

                        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Doctor">

                        <div>

                            <h4>Dr. Rahul Sharma</h4>

                            <span>MD, DM Cardiology</span>

                        </div>

                    </div>

                </td>

                <td>Cardiology</td>

                <td>Interventional Cardiology</td>

                <td>12 Years</td>

                <td>1,245</td>

                <td>₹ 800</td>

                <td>

                    <span class="status active">

                        Active

                    </span>

                </td>

                <td>

                    <button>

                        <i class="fa-regular fa-eye"></i>

                    </button>

                    <button>

                        <i class="fa-regular fa-pen-to-square"></i>

                    </button>

                    <button>

                        <i class="fa-solid fa-ellipsis-vertical"></i>

                    </button>

                </td>

            </tr>


            <!-- Doctor 2 -->

            <tr>

                <td>

                    <div class="doctor-info">

                        <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Doctor">

                        <div>

                            <h4>Dr. Amit Patel</h4>

                            <span>MS Orthopedics</span>

                        </div>

                    </div>

                </td>

                <td>Orthopedics</td>

                <td>Joint Replacement</td>

                <td>10 Years</td>

                <td>987</td>

                <td>₹ 600</td>

                <td>

                    <span class="status active">

                        Active

                    </span>

                </td>

                <td>

                    <button>

                        <i class="fa-regular fa-eye"></i>

                    </button>

                    <button>

                        <i class="fa-regular fa-pen-to-square"></i>

                    </button>

                    <button>

                        <i class="fa-solid fa-ellipsis-vertical"></i>

                    </button>

                </td>

            </tr>


            <!-- Doctor 3 -->

            <tr>

                <td>

                    <div class="doctor-info">

                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Doctor">

                        <div>

                            <h4>Dr. Priya Mehta</h4>

                            <span>MD Neurology</span>

                        </div>

                    </div>

                </td>

                <td>Neurology</td>

                <td>Brain & Spine</td>

                <td>9 Years</td>

                <td>856</td>

                <td>₹ 700</td>

                <td>

                    <span class="status active">

                        Active

                    </span>

                </td>

                <td>

                    <button>

                        <i class="fa-regular fa-eye"></i>

                    </button>

                    <button>

                        <i class="fa-regular fa-pen-to-square"></i>

                    </button>

                    <button>

                        <i class="fa-solid fa-ellipsis-vertical"></i>

                    </button>

                </td>

            </tr>


            <!-- Doctor 4 -->

            <tr>

                <td>

                    <div class="doctor-info">

                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Doctor">

                        <div>

                            <h4>Dr. Neha Verma</h4>

                            <span>MD Pediatrics</span>

                        </div>

                    </div>

                </td>

                <td>Pediatrics</td>

                <td>Child Healthcare</td>

                <td>8 Years</td>

                <td>1102</td>

                <td>₹ 500</td>

                <td>

                    <span class="status active">

                        Active

                    </span>

                </td>

                <td>

                    <button>

                        <i class="fa-regular fa-eye"></i>

                    </button>

                    <button>

                        <i class="fa-regular fa-pen-to-square"></i>

                    </button>

                    <button>

                        <i class="fa-solid fa-ellipsis-vertical"></i>

                    </button>

                </td>

            </tr>


            <!-- Doctor 5 -->

            <tr>

                <td>

                    <div class="doctor-info">

                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Doctor">

                        <div>

                            <h4>Dr. Sandeep Nair</h4>

                            <span>MD Pulmonology</span>

                        </div>

                    </div>

                </td>

                <td>Pulmonology</td>

                <td>Respiratory Medicine</td>

                <td>7 Years</td>

                <td>743</td>

                <td>₹ 600</td>

                <td>

                    <span class="status inactive">

                        Inactive

                    </span>

                </td>

                <td>

                    <button>

                        <i class="fa-regular fa-eye"></i>

                    </button>

                    <button>

                        <i class="fa-regular fa-pen-to-square"></i>

                    </button>

                    <button>

                        <i class="fa-solid fa-ellipsis-vertical"></i>

                    </button>

                </td>

            </tr>

        </tbody>

    </table>
    <!-- ===================================
        Table Footer
=================================== -->

<div class="table-footer">

    <div class="table-info">

        Showing 1 to 5 of 45 entries

    </div>


    <div class="pagination">

        <button class="page-btn">

            <i class="fa-solid fa-angle-left"></i>

        </button>


        <button class="page-btn active">

            1

        </button>


        <button class="page-btn">

            2

        </button>


        <button class="page-btn">

            3

        </button>


        <button class="page-btn">

            ...

        </button>


        <button class="page-btn">

            9

        </button>


        <button class="page-btn">

            <i class="fa-solid fa-angle-right"></i>

        </button>

    </div>

</div>

</div>
<!-- =========================================
            Add Doctor Modal
========================================== -->

<div class="modal-overlay" id="doctorModal">

    <div class="doctor-modal">

        <div class="modal-header">

            <h2>

                Add New Doctor

            </h2>

            <button id="closeDoctorModal">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>


        <form>

            <div class="form-grid">

                <!-- Doctor Name -->

                <div class="form-group">

                    <label>

                        Doctor Name

                    </label>

                    <input
                    type="text"
                    placeholder="Enter Doctor Name">

                </div>



                <!-- Department -->

                <div class="form-group">

                    <label>

                        Department

                    </label>

                    <select>

                        <option>

                            Select Department

                        </option>

                        <option>

                            Cardiology

                        </option>

                        <option>

                            Neurology

                        </option>

                        <option>

                            Orthopedics

                        </option>

                        <option>

                            Pediatrics

                        </option>

                    </select>

                </div>



                <!-- Specialization -->

                <div class="form-group">

                    <label>

                        Specialization

                    </label>

                    <input
                    type="text"
                    placeholder="Specialization">

                </div>



                <!-- Qualification -->

                <div class="form-group">

                    <label>

                        Qualification

                    </label>

                    <input
                    type="text"
                    placeholder="MBBS, MD">

                </div>



                <!-- Experience -->

                <div class="form-group">

                    <label>

                        Experience

                    </label>

                    <input
                    type="number"
                    placeholder="Years">

                </div>



                <!-- Consultation Fee -->

                <div class="form-group">

                    <label>

                        Consultation Fee

                    </label>

                    <input
                    type="number"
                    placeholder="₹">

                </div>



                <!-- Email -->

                <div class="form-group">

                    <label>

                        Email

                    </label>

                    <input
                    type="email"
                    placeholder="doctor@email.com">

                </div>



                <!-- Mobile -->

                <div class="form-group">

                    <label>

                        Mobile Number

                    </label>

                    <input
                    type="text"
                    placeholder="+91 XXXXX XXXXX">

                </div>



                <!-- Room -->

                <div class="form-group">

                    <label>

                        Room Number

                    </label>

                    <input
                    type="text"
                    placeholder="Room 203">

                </div>



                <!-- Status -->

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



            <!-- About -->

            <div class="form-group">

                <label>

                    About Doctor

                </label>

                <textarea
                placeholder="Doctor Description"></textarea>

            </div>



            <!-- Profile -->

            <div class="form-group">

                <label>

                    Profile Photo

                </label>

                <input
                type="file">

            </div>



            <div class="modal-footer">

                <button
                type="button"
                class="cancel-btn">

                    Cancel

                </button>

                <button
                type="submit"
                class="save-btn">

                    Save Doctor

                </button>

            </div>

        </form>

    </div>

</div>

</main>

</div>
<script src="doctors.js"></script>
</body>
</html>
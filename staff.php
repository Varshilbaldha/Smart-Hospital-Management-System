<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff</title>

    <link rel="stylesheet" href="staff.css">

    

</head>

<body>

<div class="dashboard">

    <?php require 'sidebar.php'; ?>

    <main class="main-content">

         <?php require 'topbar.php'; ?>

      

        <div class="page-header">

            <div>

                <h1>Staff</h1>

                <p>
                    Manage hospital staff and their information.
                </p>

            </div>

            <button class="add-btn">

                <i class="fa-solid fa-plus"></i>

                Add Staff

            </button>

        </div>
        <!-- ==========================
        Statistics Cards
========================== -->

<div class="stats-container">

    <div class="stat-card">

        <div class="stat-icon total">

            <i class="fa-solid fa-users"></i>

        </div>

        <div class="stat-info">

            <h4>Total Staff</h4>

            <h2>98</h2>

            <p>All Staff Members</p>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon active">

            <i class="fa-solid fa-shield-check"></i>

        </div>

        <div class="stat-info">

            <h4>Active Staff</h4>

            <h2>85</h2>

            <p>Currently Active</p>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon department">

            <i class="fa-solid fa-hospital"></i>

        </div>

        <div class="stat-info">

            <h4>Total Departments</h4>

            <h2>12</h2>

            <p>Departments</p>

        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon role">

            <i class="fa-solid fa-user-tag"></i>

        </div>

        <div class="stat-info">

            <h4>Total Roles</h4>

            <h2>15</h2>

            <p>Different Roles</p>

        </div>

    </div>

</div>
<!-- ==========================
        Search & Filter
========================== -->

<div class="toolbar">

    <!-- Search Box -->

    <div class="search-box">

        <i class="fa-solid fa-magnifying-glass"></i>

        <input
            type="text"
            placeholder="Search staff...">

    </div>


    <!-- Department Filter -->

    <div class="filter-box">

        <i class="fa-solid fa-building"></i>

        <select>

            <option>All Departments</option>

            <option>Administration</option>

            <option>Reception</option>

            <option>Laboratory</option>

            <option>Pharmacy</option>

            <option>Nursing</option>

        </select>

    </div>


    <!-- Role Filter -->

    <div class="filter-box">

        <i class="fa-solid fa-user-tag"></i>

        <select>

            <option>All Roles</option>

            <option>Receptionist</option>

            <option>Nurse</option>

            <option>Lab Technician</option>

            <option>Pharmacist</option>

            <option>Accountant</option>

        </select>

    </div>


    <!-- Status Filter -->

    <div class="filter-box">

        <i class="fa-solid fa-circle-check"></i>

        <select>

            <option>All Status</option>

            <option>Active</option>

            <option>Inactive</option>

        </select>

    </div>


    <!-- Filter Button -->

    <button class="filter-btn">

        <i class="fa-solid fa-filter"></i>

        Filter

    </button>

</div>
<!-- ==========================
        Staff Table
========================== -->

<div class="table-container">

    <table>

        <thead>

            <tr>

                <th>Staff</th>
                <th>Department</th>
                <th>Role</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Experience</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td>

                    <div class="staff-info">

                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="">

                        <div>

                            <h4>Priya Sharma</h4>

                            <span>EMP-1001</span>

                        </div>

                    </div>

                </td>

                <td>Reception</td>

                <td>Receptionist</td>

                <td>priya@hospital.com</td>

                <td>+91 9876543210</td>

                <td>5 Years</td>

                <td>

                    <span class="status active">
                        Active
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

                    <div class="staff-info">

                        <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="">

                        <div>

                            <h4>Rahul Patel</h4>

                            <span>EMP-1002</span>

                        </div>

                    </div>

                </td>

                <td>Laboratory</td>

                <td>Lab Technician</td>

                <td>rahul@hospital.com</td>

                <td>+91 9988776655</td>

                <td>7 Years</td>

                <td>

                    <span class="status active">
                        Active
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

                    <div class="staff-info">

                        <img src="https://randomuser.me/api/portraits/women/30.jpg" alt="">

                        <div>

                            <h4>Anjali Verma</h4>

                            <span>EMP-1003</span>

                        </div>

                    </div>

                </td>

                <td>Pharmacy</td>

                <td>Pharmacist</td>

                <td>anjali@hospital.com</td>

                <td>+91 9123456789</td>

                <td>4 Years</td>

                <td>

                    <span class="status inactive">
                        Inactive
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
        Add Staff Modal
========================== -->

<div class="modal" id="staffModal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Add New Staff</h2>

            <button class="close-btn">&times;</button>

        </div>

        <form id="staffForm">

            <div class="form-grid">

                <div class="form-group">

                    <label>Full Name</label>

                    <input type="text" placeholder="Enter full name">

                </div>

                <div class="form-group">

                    <label>Email</label>

                    <input type="email" placeholder="Enter email">

                </div>

                <div class="form-group">

                    <label>Phone</label>

                    <input type="text" placeholder="Enter phone number">

                </div>

                <div class="form-group">

                    <label>Department</label>

                    <select>

                        <option>Select Department</option>
                        <option>Administration</option>
                        <option>Reception</option>
                        <option>Laboratory</option>
                        <option>Pharmacy</option>
                        <option>Nursing</option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Role</label>

                    <select>

                        <option>Select Role</option>
                        <option>Receptionist</option>
                        <option>Lab Technician</option>
                        <option>Pharmacist</option>
                        <option>Nurse</option>
                        <option>Accountant</option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Experience</label>

                    <input type="text" placeholder="Example: 5 Years">

                </div>

            </div>

            <div class="form-actions">

                <button type="button" class="cancel-btn">

                    Cancel

                </button>

                <button type="submit" class="save-btn">

                    Save Staff

                </button>

            </div>

        </form>

    </div>

</div>

    </main>

</div>

<script src="staff.js"></script>

</body>

</html>
<?php
// require 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Services Management</title>

    <link rel="stylesheet" href="sidebar.css">

    <link rel="stylesheet" href="services.css">

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

                <h1>Services</h1>

                <p>

                    Manage hospital services and charges.

                </p>

            </div>

            <button class="add-btn">

                <i class="fa-solid fa-plus"></i>

                Add Service

            </button>

        </div>


        <!-- Statistics Cards -->

        <div class="stats-container">

            <!-- Next Step -->
             <!-- Total Services -->

<div class="stat-card">

    <div class="stat-icon total">

        <i class="fa-solid fa-hand-holding-medical"></i>

    </div>

    <div class="stat-info">

        <h4>Total Services</h4>

        <h2>48</h2>

        <p>Hospital Services</p>

    </div>

</div>


<!-- Active Services -->

<div class="stat-card">

    <div class="stat-icon active">

        <i class="fa-solid fa-circle-check"></i>

    </div>

    <div class="stat-info">

        <h4>Active Services</h4>

        <h2>42</h2>

        <p>Currently Available</p>

    </div>

</div>


<!-- Categories -->

<div class="stat-card">

    <div class="stat-icon category">

        <i class="fa-solid fa-layer-group"></i>

    </div>

    <div class="stat-info">

        <h4>Categories</h4>

        <h2>8</h2>

        <p>Service Categories</p>

    </div>

</div>


<!-- Available Today -->

<div class="stat-card">

    <div class="stat-icon available">

        <i class="fa-solid fa-star"></i>

    </div>

    <div class="stat-info">

        <h4>Available Today</h4>

        <h2>36</h2>

        <p>Ready to Serve</p>

    </div>

</div>

        </div>


        <!-- Search & Filter -->

        <div class="toolbar">

            <!-- Next Step -->
             <!-- ==========================
        Search Box
========================== -->

<div class="service-search-box">

    <i class="fa-solid fa-magnifying-glass"></i>

    <input
        type="text"
        placeholder="Search service...">

</div>


<!-- ==========================
        Category Filter
========================== -->

<div class="service-filter-box">

    <i class="fa-solid fa-layer-group"></i>

    <select>

        <option>All Categories</option>

        <option>Diagnostic</option>

        <option>Laboratory</option>

        <option>Radiology</option>

        <option>Surgery</option>

        <option>Emergency</option>

        <option>Pharmacy</option>

    </select>

</div>


<!-- ==========================
        Status Filter
========================== -->

<div class="service-filter-box">

    <i class="fa-solid fa-filter"></i>

    <select>

        <option>All Status</option>

        <option>Active</option>

        <option>Inactive</option>

    </select>

</div>


<!-- ==========================
        Filter Button
========================== -->

<button class="service-filter-btn">

    <i class="fa-solid fa-filter"></i>

    Filter

</button>

        </div>


        <!-- Services Table -->

        <div class="table-container">

            <!-- Next Step -->
             <table>

    <thead>

        <tr>

            <th>Service</th>

            <th>Service ID</th>

            <th>Category</th>

            <th>Duration</th>

            <th>Price</th>

            <th>Status</th>

            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        <!-- Row 1 -->

        <tr>

            <td>

                <div class="service-info">

                    <div class="service-icon">

                        <i class="fa-solid fa-magnifying-glass-plus"></i>

                    </div>

                    <div>

                        <h4>MRI Scan</h4>

                        <span>Advanced Diagnostic Service</span>

                    </div>

                </div>

            </td>

            <td>SER-1001</td>

            <td>Radiology</td>

            <td>45 Minutes</td>

            <td>₹ 2,500</td>

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


        <!-- Row 2 -->

        <tr>

            <td>

                <div class="service-info">

                    <div class="service-icon">

                        <i class="fa-solid fa-vial"></i>

                    </div>

                    <div>

                        <h4>Blood Test</h4>

                        <span>Laboratory Investigation</span>

                    </div>

                </div>

            </td>

            <td>SER-1002</td>

            <td>Laboratory</td>

            <td>20 Minutes</td>

            <td>₹ 500</td>

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


        <!-- Row 3 -->

        <tr>

            <td>

                <div class="service-info">

                    <div class="service-icon">

                        <i class="fa-solid fa-truck-medical"></i>

                    </div>

                    <div>

                        <h4>Emergency Care</h4>

                        <span>24×7 Emergency Service</span>

                    </div>

                </div>

            </td>

            <td>SER-1003</td>

            <td>Emergency</td>

            <td>24 Hours</td>

            <td>₹ 1,200</td>

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
        Add Service Modal
========================== -->

<div class="modal" id="serviceModal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Add New Service</h2>

            <button class="close-btn">&times;</button>

        </div>

        <form id="serviceForm">

            <div class="form-grid">

                <div class="form-group">

                    <label>Service Name</label>

                    <input
                        type="text"
                        placeholder="Enter service name">

                </div>


                <div class="form-group">

                    <label>Category</label>

                    <select>

                        <option>Select Category</option>

                        <option>Radiology</option>

                        <option>Laboratory</option>

                        <option>Emergency</option>

                        <option>Pharmacy</option>

                        <option>Surgery</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Duration</label>

                    <input
                        type="text"
                        placeholder="Example : 30 Minutes">

                </div>


                <div class="form-group">

                    <label>Price</label>

                    <input
                        type="number"
                        placeholder="Enter Price">

                </div>


                <div class="form-group">

                    <label>Status</label>

                    <select>

                        <option>Active</option>

                        <option>Inactive</option>

                    </select>

                </div>


                <div class="form-group">

                    <label>Description</label>

                    <input
                        type="text"
                        placeholder="Service Description">

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

                    Save Service

                </button>

            </div>

        </form>

    </div>

</div>

    </main>

</div>

<script src="services.js"></script>

</body>

</html>
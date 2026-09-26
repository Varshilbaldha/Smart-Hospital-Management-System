<?php
declare(strict_types=1);

$page_title = "Find Hospitals";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Find Hospitals</title>

    <link
        rel="stylesheet"
        href="css/hospitals.css"
    >
</head>

<body>

<div class="mobile-app">

    <!-- HEADER -->
    <header class="mobile-header">

        <button
            class="back-btn"
            onclick="history.back()"
        >
            ←
        </button>

        <div>
            <span class="header-small">
                SMART HOSPITAL
            </span>

            <h1>
                Find Hospitals
            </h1>
        </div>

    </header>


    <!-- SEARCH -->
    <section class="search-section">

        <div class="search-box">

            <span>🔎</span>

            <input
                type="text"
                id="hospitalSearch"
                placeholder="Search hospital or city..."
                autocomplete="off"
            >

        </div>


        <button
            id="locationBtn"
            class="location-btn"
        >
            📍 Find Hospitals Near Me
        </button>

    </section>


    <!-- STATUS -->
    <div
        id="searchStatus"
        class="search-status"
    >
        Search for a hospital or use your location.
    </div>


    <!-- RESULTS -->
    <main id="hospitalResults">

        <div class="empty-state">

            <div class="empty-icon">
                🏥
            </div>

            <h2>
                Find a Hospital
            </h2>

            <p>
                Search by hospital name or city,
                or find hospitals near your location.
            </p>

        </div>

    </main>


    <!-- BOTTOM NAV -->
    <nav class="bottom-nav">

        <a href="index.php">
            <span>🏠</span>
            Home
        </a>

        <a href="my_appointments.php">
            <span>📅</span>
            Appointments
        </a>

        <a
            href="book.php"
            class="nav-active"
        >
            <span>➕</span>
            Book
        </a>

        <a href="profile.php">
            <span>👤</span>
            Profile
        </a>

    </nav>

</div>

<script src="js/hospitals.js"></script>

</body>
</html>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Hospitals
    </title>

    <link
        rel="stylesheet"
        href="../style.css"
    >

</head>


<body>


<div class="mobile-app">


    <!--================================================
        HEADER
    =================================================-->

    <header class="mobile-header">

        <button
            class="back-button"
            onclick="goHome()"
        >
            ←
        </button>


        <div>

            <h1>
                Hospitals
            </h1>

            <span>
                Find your hospital
            </span>

        </div>

    </header>


    <!--================================================
        CONTENT
    =================================================-->

    <main class="hospital-page">


        <!-- SEARCH -->

        <div class="hospital-search-box hospital-page-search">

            <span>
                🔎
            </span>

            <input
                type="search"
                id="hospitalSearch"
                placeholder="Search hospital or city..."
                autocomplete="off"
            >

        </div>


        <!-- RESULT COUNT -->

        <div class="hospital-result-header">

            <strong>
                Hospitals
            </strong>

            <span id="hospitalCount">
                0 hospitals
            </span>

        </div>


        <!-- LOADING -->

        <div
            id="hospitalLoading"
            class="mobile-loading"
        >

            Loading hospitals...

        </div>


        <!-- HOSPITAL LIST -->

        <div
            id="hospitalList"
            class="mobile-hospital-list"
        ></div>


    </main>


    <!--================================================
        BOTTOM NAVIGATION
    =================================================-->

    <nav class="bottom-navigation">

        <button
            onclick="goHome()"
        >

            🏠

            <span>
                Home
            </span>

        </button>


        <button
            onclick="openAppointments()"
        >

            📅

            <span>
                Appointments
            </span>

        </button>


        <button
            onclick="openBooking()"
        >

            ➕

            <span>
                Book
            </span>

        </button>


        <button
            class="active"
        >

            🏥

            <span>
                Hospitals
            </span>

        </button>

    </nav>


</div>


<script src="../app.js"></script>


<script>

/*====================================================
    ELEMENTS
====================================================*/

const hospitalSearch =
    document.getElementById(
        'hospitalSearch'
    );


const hospitalList =
    document.getElementById(
        'hospitalList'
    );


const hospitalLoading =
    document.getElementById(
        'hospitalLoading'
    );


const hospitalCount =
    document.getElementById(
        'hospitalCount'
    );


/*====================================================
    LOAD HOSPITALS
====================================================*/

document.addEventListener(
    'DOMContentLoaded',
    function () {

        loadHospitals('');

    }
);


/*====================================================
    SEARCH
====================================================*/

let searchTimer;


hospitalSearch.addEventListener(
    'input',
    function () {

        clearTimeout(
            searchTimer
        );


        const keyword =
            this.value.trim();


        searchTimer =
            setTimeout(
                function () {

                    loadHospitals(
                        keyword
                    );

                },
                300
            );

    }
);


/*====================================================
    API
====================================================*/

async function loadHospitals(
    search
) {

    hospitalLoading.style.display =
        'block';


    hospitalList.innerHTML =
        '';


    try {

        const url =
            search === ''
                ? '../api/hospitals.php'
                : '../api/hospitals.php?search='
                    +
                    encodeURIComponent(
                        search
                    );


        const response =
            await fetch(
                url,
                {
                    credentials:
                        'same-origin',

                    cache:
                        'no-store'
                }
            );


        const result =
            await response.json();


        hospitalLoading.style.display =
            'none';


        if (!result.success) {

            hospitalList.innerHTML = `

                <div class="empty-state">

                    <div>
                        ⚠️
                    </div>

                    <strong>
                        Unable to load hospitals
                    </strong>

                    <span>
                        ${escapeHospitalHtml(
                            result.message
                        )}
                    </span>

                    <button
                        class="primary-button"
                        onclick="loadHospitals('')"
                    >
                        Try Again
                    </button>

                </div>

            `;

            return;
        }


        const hospitals =
            result.data.hospitals || [];


        hospitalCount.textContent =
            hospitals.length +
            (
                hospitals.length === 1
                    ? ' hospital'
                    : ' hospitals'
            );


        if (
            hospitals.length === 0
        ) {

            hospitalList.innerHTML = `

                <div class="empty-state">

                    <div>
                        🏥
                    </div>

                    <strong>
                        No Hospital Found
                    </strong>

                    <span>
                        Try another hospital name or city.
                    </span>

                </div>

            `;

            return;
        }


        hospitalList.innerHTML =
            hospitals
                .map(
                    renderHospital
                )
                .join('');

    }
    catch (error) {

        hospitalLoading.style.display =
            'none';


        hospitalList.innerHTML = `

            <div class="empty-state">

                <div>
                    ⚠️
                </div>

                <strong>
                    Connection Error
                </strong>

                <span>
                    Please try again.
                </span>

                <button
                    class="primary-button"
                    onclick="loadHospitals('')"
                >
                    Try Again
                </button>

            </div>

        `;

        console.error(
            error
        );

    }

}


/*====================================================
    HOSPITAL CARD
====================================================*/

function renderHospital(
    hospital
) {

    const location =
        [
            hospital.city,
            hospital.state
        ]
        .filter(Boolean)
        .join(', ');


    const address =
        [
            hospital.address1,
            hospital.address2,
            location,
            hospital.zip
        ]
        .filter(Boolean)
        .join(', ');


    return `

        <article
            class="mobile-hospital-card"
        >


            <div
                class="hospital-card-header"
            >

                <div
                    class="mobile-hospital-icon"
                >
                    🏥
                </div>


                <div
                    class="mobile-hospital-title"
                >

                    <strong>
                        ${escapeHospitalHtml(
                            hospital.hospital_name
                        )}
                    </strong>

                    <span>
                        ${escapeHospitalHtml(
                            hospital.hospital_type
                            || 'Hospital'
                        )}
                    </span>

                </div>

            </div>


            <div
                class="mobile-hospital-location"
            >

                📍

                <span>
                    ${escapeHospitalHtml(
                        address || 'Location not available'
                    )}
                </span>

            </div>


            <div
                class="hospital-contact-row"
            >

                ${
                    hospital.hospital_phone
                    ?
                    `
                    <a
                        href="tel:${escapeHospitalHtml(
                            hospital.hospital_phone
                        )}"
                    >
                        📞
                        Call
                    </a>
                    `
                    :
                    ''
                }


                ${
                    hospital.website
                    ?
                    `
                    <a
                        href="${escapeHospitalHtml(
                            hospital.website
                        )}"
                        target="_blank"
                        rel="noopener"
                    >
                        🌐
                        Website
                    </a>
                    `
                    :
                    ''
                }

            </div>


            <div
                class="hospital-card-actions"
            >

                <button
                    class="primary-button hospital-book-button"
                    onclick="bookAtHospital(
                        ${Number(
                            hospital.hospital_id
                        )}
                    )"
                >

                    Book Appointment

                </button>

            </div>


        </article>

    `;

}


/*====================================================
    BOOK
====================================================*/

function bookAtHospital(
    hospitalId
) {

    /*
        Next step me booking API ke through
        selected hospital ko automatically
        book page me pass karenge.
    */

    window.location.href =
        '../book.php?hospital_id='
        +
        encodeURIComponent(
            hospitalId
        );

}


/*====================================================
    ESCAPE
====================================================*/

function escapeHospitalHtml(
    value
) {

    const div =
        document.createElement(
            'div'
        );


    div.textContent =
        String(
            value ?? ''
        );


    return div.innerHTML;

}

</script>


</body>

</html>
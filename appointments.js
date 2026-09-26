document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       ELEMENTS
    ===================================================== */

    const addAppointmentBtn =
        document.getElementById("addAppointmentBtn");

    const appointmentModal =
        document.getElementById("appointmentModal");

    const viewModal =
        document.getElementById("viewAppointmentModal");

    const editModal =
        document.getElementById("editAppointmentModal");

    const deleteModal =
        document.getElementById("deleteAppointmentModal");


    /* =====================================================
       LOCAL TODAY
       Do not use toISOString() because it can change
       the date according to UTC.
    ===================================================== */

    function todayString() {

        const now = new Date();

        const year =
            now.getFullYear();

        const month =
            String(
                now.getMonth() + 1
            ).padStart(2, "0");

        const day =
            String(
                now.getDate()
            ).padStart(2, "0");

        return (
            year +
            "-" +
            month +
            "-" +
            day
        );
    }


    /* =====================================================
       ADD APPOINTMENT
    ===================================================== */

    if (
        addAppointmentBtn &&
        appointmentModal
    ) {

        addAppointmentBtn.addEventListener(
            "click",
            function () {

                appointmentModal.style.display =
                    "flex";

                const dateInput =
                    appointmentModal.querySelector(
                        'input[name="appointment_date"]'
                    );

                const timeInput =
                    appointmentModal.querySelector(
                        'input[name="appointment_time"]'
                    );

                if (dateInput) {

                    const today =
                        todayString();

                    dateInput.min =
                        today;

                    if (!dateInput.value) {
                        dateInput.value =
                            today;
                    }
                }

                if (timeInput) {

                    timeInput.min =
                        "09:30";

                    if (!timeInput.value) {
                        timeInput.value =
                            "09:30";
                    }
                }

            }
        );

    }


    /* =====================================================
       CLOSE MODALS
    ===================================================== */

    document
        .querySelectorAll("[data-close]")
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function () {

                    const modalId =
                        this.getAttribute(
                            "data-close"
                        );

                    const modal =
                        document.getElementById(
                            modalId
                        );

                    if (modal) {
                        modal.style.display =
                            "none";
                    }

                }
            );

        });


    /* =====================================================
       OUTSIDE CLICK
    ===================================================== */

    window.addEventListener(
        "click",
        function (event) {

            if (
                event.target.classList
                    .contains("modal")
            ) {

                event.target.style.display =
                    "none";
            }

        }
    );


    /* =====================================================
       ESC KEY
    ===================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape"
            ) {

                document
                    .querySelectorAll(".modal")
                    .forEach(function (modal) {

                        modal.style.display =
                            "none";

                    });

            }

        }
    );


    /* =====================================================
       VIEW APPOINTMENT
    ===================================================== */

    document
        .querySelectorAll(".view-btn")
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function () {

                    const id =
                        this.getAttribute(
                            "data-id"
                        );

                    const data =
                        document.getElementById(
                            "appointment-" + id
                        );

                    if (
                        !data ||
                        !viewModal
                    ) {
                        return;
                    }

                    document.getElementById(
                        "viewAppointmentNo"
                    ).textContent =
                        data.dataset.appointmentNo ||
                        "N/A";

                    document.getElementById(
                        "viewPatient"
                    ).textContent =
                        data.dataset.patient ||
                        "N/A";

                    document.getElementById(
                        "viewPatientCode"
                    ).textContent =
                        data.dataset.patientCode ||
                        "N/A";

                    document.getElementById(
                        "viewMobile"
                    ).textContent =
                        data.dataset.mobile ||
                        "N/A";

                    document.getElementById(
                        "viewDoctor"
                    ).textContent =
                        "Dr. " +
                        (
                            data.dataset.doctor ||
                            "N/A"
                        );

                    document.getElementById(
                        "viewDepartment"
                    ).textContent =
                        data.dataset.department ||
                        "N/A";

                    document.getElementById(
                        "viewService"
                    ).textContent =
                        data.dataset.service ||
                        "N/A";

                    document.getElementById(
                        "viewDate"
                    ).textContent =
                        formatDate(
                            data.dataset.date
                        );

                    document.getElementById(
                        "viewTime"
                    ).textContent =
                        formatTime(
                            data.dataset.time
                        );

                    document.getElementById(
                        "viewType"
                    ).textContent =
                        data.dataset.type ||
                        "N/A";

                    document.getElementById(
                        "viewMode"
                    ).textContent =
                        data.dataset.mode ||
                        "N/A";

                    document.getElementById(
                        "viewToken"
                    ).textContent =
                        data.dataset.token &&
                        data.dataset.token !== "0"
                            ? "#" +
                              data.dataset.token
                            : "N/A";

                    document.getElementById(
                        "viewStatus"
                    ).textContent =
                        data.dataset.status ||
                        "N/A";

                    document.getElementById(
                        "viewSymptoms"
                    ).textContent =
                        data.dataset.symptoms ||
                        "N/A";

                    document.getElementById(
                        "viewNotes"
                    ).textContent =
                        data.dataset.notes ||
                        "N/A";

                    document.getElementById(
                        "viewCancellation"
                    ).textContent =
                        data.dataset.cancellation ||
                        "N/A";

                    viewModal.style.display =
                        "flex";

                }
            );

        });


    /* =====================================================
       EDIT APPOINTMENT
    ===================================================== */

    document
        .querySelectorAll(".edit-btn")
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function () {

                    const id =
                        this.getAttribute(
                            "data-id"
                        );

                    const data =
                        document.getElementById(
                            "appointment-" + id
                        );

                    if (
                        !data ||
                        !editModal
                    ) {
                        return;
                    }

                    document.getElementById(
                        "editAppointmentId"
                    ).value =
                        data.dataset.id || "";

                    document.getElementById(
                        "editPatientDisplay"
                    ).value =
                        data.dataset.patient ||
                        "";

                    const doctorSelect =
                        document.getElementById(
                            "editDoctor"
                        );

                    const serviceSelect =
                        document.getElementById(
                            "editService"
                        );

                    if (doctorSelect) {

                        doctorSelect.value =
                            data.dataset.doctorId ||
                            "";
                    }

                    if (serviceSelect) {

                        serviceSelect.value =
                            data.dataset.serviceId ||
                            "";
                    }

                    document.getElementById(
                        "editDate"
                    ).value =
                        data.dataset.date ||
                        "";

                    document.getElementById(
                        "editTime"
                    ).value =
                        data.dataset.time ||
                        "09:30";

                    document.getElementById(
                        "editType"
                    ).value =
                        data.dataset.type ||
                        "Walk-In";

                    document.getElementById(
                        "editMode"
                    ).value =
                        data.dataset.mode ||
                        "In-Person";

                    document.getElementById(
                        "editStatus"
                    ).value =
                        data.dataset.status ||
                        "Scheduled";

                    document.getElementById(
                        "editSymptoms"
                    ).value =
                        data.dataset.symptoms ||
                        "";

                    document.getElementById(
                        "editNotes"
                    ).value =
                        data.dataset.notes ||
                        "";

                    const editDate =
                        document.getElementById(
                            "editDate"
                        );

                    const editTime =
                        document.getElementById(
                            "editTime"
                        );

                    if (editDate) {
                        editDate.min =
                            todayString();
                    }

                    if (editTime) {
                        editTime.min =
                            "09:30";
                    }

                    editModal.style.display =
                        "flex";

                }
            );

        });


    /* =====================================================
       DELETE APPOINTMENT
    ===================================================== */

    document
        .querySelectorAll(".delete-btn")
        .forEach(function (button) {

            button.addEventListener(
                "click",
                function () {

                    const id =
                        this.getAttribute(
                            "data-id"
                        );

                    const name =
                        this.getAttribute(
                            "data-name"
                        );

                    const idInput =
                        document.getElementById(
                            "deleteAppointmentId"
                        );

                    const nameElement =
                        document.getElementById(
                            "deletePatientName"
                        );

                    if (idInput) {
                        idInput.value =
                            id;
                    }

                    if (nameElement) {
                        nameElement.textContent =
                            name ||
                            "this patient";
                    }

                    if (deleteModal) {
                        deleteModal.style.display =
                            "flex";
                    }

                }
            );

        });


    /* =====================================================
       EDIT VALIDATION
    ===================================================== */

    const editDate =
        document.getElementById(
            "editDate"
        );

    const editTime =
        document.getElementById(
            "editTime"
        );

    if (editDate) {

        editDate.min =
            todayString();
    }

    if (editTime) {

        editTime.min =
            "09:30";
    }

    const editForm =
        editModal
            ? editModal.querySelector("form")
            : null;

    if (editForm) {

        editForm.addEventListener(
            "submit",
            function (event) {

                const dateValue =
                    editDate
                        ? editDate.value
                        : "";

                const timeValue =
                    editTime
                        ? editTime.value
                        : "";

                if (!dateValue) {

                    event.preventDefault();

                    alert(
                        "Please select appointment date."
                    );

                    return;
                }

                if (!timeValue) {

                    event.preventDefault();

                    alert(
                        "Please select appointment time."
                    );

                    return;
                }

                if (
                    timeValue < "09:30"
                ) {

                    event.preventDefault();

                    alert(
                        "Appointment time cannot be earlier than 9:30 AM."
                    );

                    return;
                }

                const today =
                    todayString();

                if (
                    dateValue < today
                ) {

                    event.preventDefault();

                    alert(
                        "Appointment date cannot be in the past."
                    );
                }

            }
        );

    }


    /* =====================================================
       ADD VALIDATION
    ===================================================== */

    if (appointmentModal) {

        const addForm =
            appointmentModal.querySelector(
                "form"
            );

        const addDate =
            appointmentModal.querySelector(
                'input[name="appointment_date"]'
            );

        const addTime =
            appointmentModal.querySelector(
                'input[name="appointment_time"]'
            );

        if (addDate) {

            addDate.min =
                todayString();
        }

        if (addTime) {

            addTime.min =
                "09:30";
        }

        if (addForm) {

            addForm.addEventListener(
                "submit",
                function (event) {

                    const dateValue =
                        addDate
                            ? addDate.value
                            : "";

                    const timeValue =
                        addTime
                            ? addTime.value
                            : "";

                    if (!dateValue) {

                        event.preventDefault();

                        alert(
                            "Please select appointment date."
                        );

                        return;
                    }

                    if (!timeValue) {

                        event.preventDefault();

                        alert(
                            "Please select appointment time."
                        );

                        return;
                    }

                    if (
                        timeValue < "09:30"
                    ) {

                        event.preventDefault();

                        alert(
                            "Appointment time cannot be earlier than 9:30 AM."
                        );

                        return;
                    }

                    if (
                        dateValue <
                        todayString()
                    ) {

                        event.preventDefault();

                        alert(
                            "Appointment date cannot be in the past."
                        );
                    }

                }
            );

        }

    }


    /* =====================================================
       DEPARTMENT → DOCTOR FILTER
    ===================================================== */

    const departmentFilter =
        document.getElementById(
            "departmentFilter"
        );

    const doctorFilter =
        document.getElementById(
            "doctorFilter"
        );

    if (
        departmentFilter &&
        doctorFilter
    ) {

        departmentFilter.addEventListener(
            "change",
            function () {

                const departmentId =
                    this.value;

                const options =
                    doctorFilter.querySelectorAll(
                        "option"
                    );

                options.forEach(
                    function (
                        option,
                        index
                    ) {

                        if (index === 0) {

                            option.hidden =
                                false;

                            return;
                        }

                        const optionDepartment =
                            option.dataset.department;

                        option.hidden =
                            !(
                                departmentId === "" ||
                                optionDepartment ===
                                departmentId
                            );

                    }
                );

                const selected =
                    doctorFilter.options[
                        doctorFilter.selectedIndex
                    ];

                if (
                    selected &&
                    selected.hidden
                ) {

                    doctorFilter.value =
                        "";
                }

            }
        );

    }


    /* =====================================================
       ADD MODAL DEPARTMENT FILTER
    ===================================================== */

    const appointmentDepartment =
        document.getElementById(
            "appointmentDepartment"
        );

    const appointmentDoctor =
        document.getElementById(
            "appointmentDoctor"
        );

    const appointmentService =
        document.getElementById(
            "appointmentService"
        );

    function filterOptions(
        select,
        departmentId
    ) {

        if (!select) {
            return;
        }

        Array.from(
            select.options
        ).forEach(
            function (
                option,
                index
            ) {

                if (index === 0) {

                    option.hidden =
                        false;

                    return;
                }

                const optionDepartment =
                    option.dataset.department;

                option.hidden =
                    !(
                        departmentId === "" ||
                        optionDepartment ===
                        departmentId
                    );

            }
        );
    }

    if (appointmentDepartment) {

        appointmentDepartment.addEventListener(
            "change",
            function () {

                const departmentId =
                    this.value;

                filterOptions(
                    appointmentDoctor,
                    departmentId
                );

                filterOptions(
                    appointmentService,
                    departmentId
                );

                if (appointmentDoctor) {
                    appointmentDoctor.value =
                        "";
                }

                if (appointmentService) {
                    appointmentService.value =
                        "";
                }

            }
        );

    }


    /* =====================================================
       DOCTOR → DEPARTMENT
    ===================================================== */

    if (
        appointmentDoctor &&
        appointmentDepartment
    ) {

        appointmentDoctor.addEventListener(
            "change",
            function () {

                const selected =
                    appointmentDoctor.options[
                        appointmentDoctor.selectedIndex
                    ];

                if (
                    selected &&
                    selected.dataset.department
                ) {

                    appointmentDepartment.value =
                        selected.dataset.department;

                    filterOptions(
                        appointmentService,
                        selected.dataset.department
                    );

                }

            }
        );

    }


    /* =====================================================
       ADD MODAL DATE
    ===================================================== */

    if (appointmentModal) {

        const dateInput =
            appointmentModal.querySelector(
                'input[name="appointment_date"]'
            );

        const timeInput =
            appointmentModal.querySelector(
                'input[name="appointment_time"]'
            );

        if (dateInput) {

            dateInput.min =
                todayString();
        }

        if (timeInput) {

            timeInput.min =
                "09:30";
        }

    }


    /* =====================================================
       FORMAT DATE
    ===================================================== */

    function formatDate(dateString) {

        if (!dateString) {
            return "N/A";
        }

        const date =
            new Date(
                dateString +
                "T00:00:00"
            );

        if (
            isNaN(
                date.getTime()
            )
        ) {
            return dateString;
        }

        return date.toLocaleDateString(
            "en-IN",
            {
                day: "2-digit",
                month: "short",
                year: "numeric"
            }
        );
    }


    /* =====================================================
       FORMAT TIME
    ===================================================== */

    function formatTime(timeString) {

        if (!timeString) {
            return "N/A";
        }

        const parts =
            timeString.split(":");

        if (parts.length < 2) {
            return timeString;
        }

        let hour =
            parseInt(
                parts[0],
                10
            );

        const minute =
            parts[1];

        const ampm =
            hour >= 12
                ? "PM"
                : "AM";

        hour =
            hour % 12;

        if (hour === 0) {
            hour = 12;
        }

        return (
            hour
                .toString()
                .padStart(2, "0")
            +
            ":" +
            minute +
            " " +
            ampm
        );
    }

});
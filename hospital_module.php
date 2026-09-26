<?php

declare(strict_types=1);

require_once __DIR__ . '/hospital_context.php';


/*
|--------------------------------------------------------------------------
| MODULE
|--------------------------------------------------------------------------
*/

$module =
    (string)(
        $_GET['module']
        ?? 'availability'
    );


$allowed = [
    'availability',
    'medical_records',
    'prescriptions',
    'lab_tests',
    'admissions',
    'rooms_beds',
    'billing',
    'payments'
];


if (!in_array(
    $module,
    $allowed,
    true
)) {

    $module = 'availability';
}


/*
|--------------------------------------------------------------------------
| HELPERS
|--------------------------------------------------------------------------
*/

function mh(string $value): string
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES,
        'UTF-8'
    );
}


function module_redirect(
    string $module,
    string $message,
    string $type = 'success'
): never {

    $_SESSION['module_flash'] = [
        'message' => $message,
        'type' => $type
    ];

    header(
        'Location: hospital_module.php?module=' .
        rawurlencode($module)
    );

    exit;
}


function fetch_all_assoc(
    mysqli $conn,
    string $sql
): array {

    $rows = [];

    $result =
        mysqli_query(
            $conn,
            $sql
        );

    if ($result) {

        while (
            $row =
                mysqli_fetch_assoc($result)
        ) {

            $rows[] = $row;
        }

        mysqli_free_result($result);
    }

    return $rows;
}


$flash =
    $_SESSION['module_flash']
    ?? null;

unset(
    $_SESSION['module_flash']
);


$search =
    trim(
        (string)(
            $_GET['search']
            ?? ''
        )
    );


$status =
    trim(
        (string)(
            $_GET['status']
            ?? ''
        )
    );


/*
|--------------------------------------------------------------------------
| PAGE META
|--------------------------------------------------------------------------
*/

$meta = [

    'availability' => [
        'Doctor Availability',
        'Create and manage doctor schedules, slots and consultation modes.',
        'Doctor Availability',
        'fa-clock'
    ],

    'medical_records' => [
        'Medical Records',
        'Maintain clinical records for hospital appointments.',
        'Medical Records',
        'fa-file-medical'
    ],

    'prescriptions' => [
        'Prescriptions',
        'Create and manage prescriptions linked to medical records.',
        'Prescriptions',
        'fa-prescription-bottle-medical'
    ],

    'lab_tests' => [
        'Lab Tests',
        'Order, update and track laboratory investigations.',
        'Lab Tests',
        'fa-flask'
    ],

    'admissions' => [
        'Admissions',
        'Manage inpatient admissions and discharge workflow.',
        'Admissions',
        'fa-hospital-user'
    ],

    'rooms_beds' => [
        'Rooms & Beds',
        'Manage rooms, beds and occupancy.',
        'Rooms & Beds',
        'fa-bed'
    ],

    'billing' => [
        'Billing',
        'Create and track patient bills.',
        'Billing',
        'fa-file-invoice-dollar'
    ],

    'payments' => [
        'Payments',
        'Record and review hospital payments.',
        'Payments',
        'fa-money-bill-wave'
    ]
];


[
    $title,
    $description,
    $heading,
    $icon
] = $meta[$module];


/*
|--------------------------------------------------------------------------
| POST ACTIONS
|--------------------------------------------------------------------------
*/

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $action =
            (string)(
                $_POST['action']
                ?? ''
            );


        /*
        |--------------------------------------------------------------------------
        | DOCTOR AVAILABILITY
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'availability'
            &&
            $action === 'save_availability'
        ) {

            $id =
                (int)(
                    $_POST['availability_id']
                    ?? 0
                );

            $doctorId =
                (int)(
                    $_POST['doctor_id']
                    ?? 0
                );

            $day =
                trim(
                    (string)(
                        $_POST['day_of_week']
                        ?? ''
                    )
                );

            $start =
                trim(
                    (string)(
                        $_POST['start_time']
                        ?? ''
                    )
                );

            $end =
                trim(
                    (string)(
                        $_POST['end_time']
                        ?? ''
                    )
                );

            $slot =
                max(
                    1,
                    (int)(
                        $_POST[
                            'slot_duration_minutes'
                        ] ?? 15
                    )
                );

            $max =
                max(
                    1,
                    (int)(
                        $_POST['max_patients']
                        ?? 1
                    )
                );

            $mode =
                trim(
                    (string)(
                        $_POST[
                            'consultation_mode'
                        ] ?? 'In-Person'
                    )
                );

            $recordStatus =
                trim(
                    (string)(
                        $_POST[
                            'record_status'
                        ] ?? 'Active'
                    )
                );


            $days = [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            ];


            $modes = [
                'In-Person',
                'Video',
                'Both'
            ];


            if (
                $doctorId <= 0 ||
                !in_array(
                    $day,
                    $days,
                    true
                ) ||
                !preg_match(
                    '/^\d{2}:\d{2}$/',
                    $start
                ) ||
                !preg_match(
                    '/^\d{2}:\d{2}$/',
                    $end
                ) ||
                $start >= $end ||
                !in_array(
                    $mode,
                    $modes,
                    true
                ) ||
                !in_array(
                    $recordStatus,
                    ['Active', 'Inactive'],
                    true
                )
            ) {

                throw new RuntimeException(
                    'Please enter valid availability details.'
                );
            }


            if ($id > 0) {

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        UPDATE doctor_availability

                        SET
                            doctor_id = ?,
                            day_of_week = ?,
                            start_time = ?,
                            end_time = ?,
                            slot_duration_minutes = ?,
                            max_patients = ?,
                            consultation_mode = ?,
                            status = ?

                        WHERE availability_id = ?
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'isssiissi',
                    $doctorId,
                    $day,
                    $start,
                    $end,
                    $slot,
                    $max,
                    $mode,
                    $recordStatus,
                    $id
                );

            } else {

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        INSERT INTO doctor_availability
                        (
                            doctor_id,
                            day_of_week,
                            start_time,
                            end_time,
                            slot_duration_minutes,
                            max_patients,
                            consultation_mode,
                            status
                        )
                        VALUES
                        (?,?,?,?,?,?,?,?)
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'isssiiss',
                    $doctorId,
                    $day,
                    $start,
                    $end,
                    $slot,
                    $max,
                    $mode,
                    $recordStatus
                );
            }


            if (
                !$st ||
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    $st
                        ? mysqli_stmt_error($st)
                        : mysqli_error($hospital_conn)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                $id > 0
                    ? 'Doctor availability updated successfully.'
                    : 'Doctor availability added successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE AVAILABILITY
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'availability'
            &&
            $action === 'delete_availability'
        ) {

            $id =
                (int)(
                    $_POST['availability_id']
                    ?? 0
                );


            $st =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    DELETE FROM doctor_availability
                    WHERE availability_id = ?
                    "
                );


            mysqli_stmt_bind_param(
                $st,
                'i',
                $id
            );


            if (
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    mysqli_stmt_error($st)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                'Availability deleted successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | MEDICAL RECORDS
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'medical_records'
            &&
            $action === 'save_medical_record'
        ) {

            $id =
                (int)(
                    $_POST['medical_record_id']
                    ?? 0
                );

            $appointmentId =
                (int)(
                    $_POST['appointment_id']
                    ?? 0
                );

            $chief =
                trim(
                    (string)(
                        $_POST['chief_complaint']
                        ?? ''
                    )
                );

            $illness =
                trim(
                    (string)(
                        $_POST['present_illness']
                        ?? ''
                    )
                );

            $history =
                trim(
                    (string)(
                        $_POST[
                            'past_medical_history'
                        ] ?? ''
                    )
                );

            $family =
                trim(
                    (string)(
                        $_POST['family_history']
                        ?? ''
                    )
                );

            $allergies =
                trim(
                    (string)(
                        $_POST['allergies']
                        ?? ''
                    )
                );

            $notes =
                trim(
                    (string)(
                        $_POST['clinical_notes']
                        ?? ''
                    )
                );

            $diagnosis =
                trim(
                    (string)(
                        $_POST['diagnosis_summary']
                        ?? ''
                    )
                );

            $follow =
                trim(
                    (string)(
                        $_POST['follow_up_date']
                        ?? ''
                    )
                );

            $followNotes =
                trim(
                    (string)(
                        $_POST['follow_up_notes']
                        ?? ''
                    )
                );

            $recordStatus =
                trim(
                    (string)(
                        $_POST['record_status']
                        ?? 'Open'
                    )
                );


            if (
                $appointmentId <= 0 ||
                !in_array(
                    $recordStatus,
                    [
                        'Open',
                        'Completed',
                        'Archived'
                    ],
                    true
                )
            ) {

                throw new RuntimeException(
                    'Appointment and valid record status are required.'
                );
            }


            if ($id > 0) {

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        UPDATE medical_records

                        SET
                            appointment_id = ?,
                            chief_complaint = ?,
                            present_illness = ?,
                            past_medical_history = ?,
                            family_history = ?,
                            allergies = ?,
                            clinical_notes = ?,
                            diagnosis_summary = ?,
                            follow_up_date =
                                NULLIF(?, ''),
                            follow_up_notes = ?,
                            record_status = ?

                        WHERE medical_record_id = ?
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'issssssssssi',
                    $appointmentId,
                    $chief,
                    $illness,
                    $history,
                    $family,
                    $allergies,
                    $notes,
                    $diagnosis,
                    $follow,
                    $followNotes,
                    $recordStatus,
                    $id
                );

            } else {

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        INSERT INTO medical_records
                        (
                            appointment_id,
                            chief_complaint,
                            present_illness,
                            past_medical_history,
                            family_history,
                            allergies,
                            clinical_notes,
                            diagnosis_summary,
                            follow_up_date,
                            follow_up_notes,
                            record_status
                        )
                        VALUES
                        (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            NULLIF(?, ''),
                            ?,
                            ?
                        )
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'issssssssss',
                    $appointmentId,
                    $chief,
                    $illness,
                    $history,
                    $family,
                    $allergies,
                    $notes,
                    $diagnosis,
                    $follow,
                    $followNotes,
                    $recordStatus
                );
            }


            if (
                !$st ||
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    $st
                        ? mysqli_stmt_error($st)
                        : mysqli_error($hospital_conn)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                $id > 0
                    ? 'Medical record updated successfully.'
                    : 'Medical record added successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE MEDICAL RECORD
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'medical_records'
            &&
            $action === 'delete_medical_record'
        ) {

            $id =
                (int)(
                    $_POST[
                        'medical_record_id'
                    ] ?? 0
                );


            $st =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    DELETE FROM medical_records
                    WHERE medical_record_id = ?
                    "
                );


            mysqli_stmt_bind_param(
                $st,
                'i',
                $id
            );


            if (
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    mysqli_stmt_error($st)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                'Medical record deleted successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PRESCRIPTIONS
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'prescriptions'
            &&
            $action === 'save_prescription'
        ) {

            $id =
                (int)(
                    $_POST['prescription_id']
                    ?? 0
                );

            $recordId =
                (int)(
                    $_POST['medical_record_id']
                    ?? 0
                );

            $advice =
                trim(
                    (string)(
                        $_POST['advice']
                        ?? ''
                    )
                );

            $follow =
                trim(
                    (string)(
                        $_POST['follow_up_date']
                        ?? ''
                    )
                );

            $presStatus =
                trim(
                    (string)(
                        $_POST[
                            'prescription_status'
                        ] ?? 'Active'
                    )
                );

            $no =
                trim(
                    (string)(
                        $_POST['prescription_no']
                        ?? ''
                    )
                );


            if (
                $recordId <= 0 ||
                !in_array(
                    $presStatus,
                    [
                        'Active',
                        'Completed',
                        'Cancelled'
                    ],
                    true
                )
            ) {

                throw new RuntimeException(
                    'Medical record and valid prescription status are required.'
                );
            }


            if ($id > 0) {

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        UPDATE prescriptions

                        SET
                            medical_record_id = ?,
                            advice = ?,
                            follow_up_date =
                                NULLIF(?, ''),
                            status = ?

                        WHERE prescription_id = ?
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'isssi',
                    $recordId,
                    $advice,
                    $follow,
                    $presStatus,
                    $id
                );

            } else {

                if ($no === '') {

                    $no =
                        'RX' .
                        date('YmdHis') .
                        random_int(100, 999);
                }


                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        INSERT INTO prescriptions
                        (
                            medical_record_id,
                            prescription_no,
                            advice,
                            follow_up_date,
                            status
                        )
                        VALUES
                        (
                            ?,
                            ?,
                            ?,
                            NULLIF(?, ''),
                            ?
                        )
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'issss',
                    $recordId,
                    $no,
                    $advice,
                    $follow,
                    $presStatus
                );
            }


            if (
                !$st ||
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    $st
                        ? mysqli_stmt_error($st)
                        : mysqli_error($hospital_conn)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                $id > 0
                    ? 'Prescription updated successfully.'
                    : 'Prescription added successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE PRESCRIPTION
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'prescriptions'
            &&
            $action === 'delete_prescription'
        ) {

            $id =
                (int)(
                    $_POST[
                        'prescription_id'
                    ] ?? 0
                );


            $st =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    DELETE FROM prescriptions
                    WHERE prescription_id = ?
                    "
                );


            mysqli_stmt_bind_param(
                $st,
                'i',
                $id
            );


            if (
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    mysqli_stmt_error($st)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                'Prescription deleted successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | LAB TESTS
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'lab_tests'
            &&
            $action === 'save_lab_test'
        ) {

            $id =
                (int)(
                    $_POST['lab_test_id']
                    ?? 0
                );

            $recordId =
                (int)(
                    $_POST['medical_record_id']
                    ?? 0
                );

            $name =
                trim(
                    (string)(
                        $_POST['test_name']
                        ?? ''
                    )
                );

            $category =
                trim(
                    (string)(
                        $_POST['test_category']
                        ?? ''
                    )
                );

            $doctorId =
                (int)(
                    $_POST[
                        'ordered_by_doctor_id'
                    ] ?? 0
                );

            $sample =
                trim(
                    (string)(
                        $_POST['sample_type']
                        ?? 'Blood'
                    )
                );

            $result =
                trim(
                    (string)(
                        $_POST['test_result']
                        ?? ''
                    )
                );

            $normal =
                trim(
                    (string)(
                        $_POST['normal_range']
                        ?? ''
                    )
                );

            $testStatus =
                trim(
                    (string)(
                        $_POST['test_status']
                        ?? 'Ordered'
                    )
                );

            $testDate =
                trim(
                    (string)(
                        $_POST['test_date']
                        ?? ''
                    )
                );

            $remarks =
                trim(
                    (string)(
                        $_POST['remarks']
                        ?? ''
                    )
                );


            $samples = [
                'Blood',
                'Urine',
                'Stool',
                'Saliva',
                'Sputum',
                'Other'
            ];


            $statuses = [
                'Ordered',
                'Sample Collected',
                'Processing',
                'Completed',
                'Cancelled'
            ];


            if (
                $recordId <= 0 ||
                $name === '' ||
                $doctorId <= 0 ||
                !in_array(
                    $sample,
                    $samples,
                    true
                ) ||
                !in_array(
                    $testStatus,
                    $statuses,
                    true
                )
            ) {

                throw new RuntimeException(
                    'Medical record, test name, doctor and valid status are required.'
                );
            }


            if ($id > 0) {

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        UPDATE lab_tests

                        SET
                            medical_record_id = ?,
                            test_name = ?,
                            test_category = ?,
                            ordered_by_doctor_id = ?,
                            sample_type = ?,
                            test_result = ?,
                            normal_range = ?,
                            test_status = ?,
                            test_date =
                                NULLIF(?, ''),
                            remarks = ?,
                            completed_at =
                                IF(
                                    ? = 'Completed',
                                    COALESCE(
                                        completed_at,
                                        NOW()
                                    ),
                                    NULL
                                )

                        WHERE lab_test_id = ?
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'ississsssssi',
                    $recordId,
                    $name,
                    $category,
                    $doctorId,
                    $sample,
                    $result,
                    $normal,
                    $testStatus,
                    $testDate,
                    $remarks,
                    $testStatus,
                    $id
                );

            } else {

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        INSERT INTO lab_tests
                        (
                            medical_record_id,
                            test_name,
                            test_category,
                            ordered_by_doctor_id,
                            sample_type,
                            test_result,
                            normal_range,
                            test_status,
                            test_date,
                            remarks,
                            completed_at
                        )
                        VALUES
                        (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            NULLIF(?, ''),
                            ?,
                            IF(
                                ? = 'Completed',
                                NOW(),
                                NULL
                            )
                        )
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'ississsssss',
                    $recordId,
                    $name,
                    $category,
                    $doctorId,
                    $sample,
                    $result,
                    $normal,
                    $testStatus,
                    $testDate,
                    $remarks,
                    $testStatus
                );
            }


            if (
                !$st ||
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    $st
                        ? mysqli_stmt_error($st)
                        : mysqli_error($hospital_conn)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                $id > 0
                    ? 'Lab test updated successfully.'
                    : 'Lab test added successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE LAB TEST
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'lab_tests'
            &&
            $action === 'delete_lab_test'
        ) {

            $id =
                (int)(
                    $_POST['lab_test_id']
                    ?? 0
                );


            $st =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    DELETE FROM lab_tests
                    WHERE lab_test_id = ?
                    "
                );


            mysqli_stmt_bind_param(
                $st,
                'i',
                $id
            );


            if (
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    mysqli_stmt_error($st)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                'Lab test deleted successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ADMISSION - IMPORTANT NEW CODE
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'admissions'
            &&
            $action === 'add_admission'
        ) {

            $mappingId =
                (int)(
                    $_POST['mapping_id']
                    ?? 0
                );

            $appointmentId =
                (int)(
                    $_POST['appointment_id']
                    ?? 0
                );

            $roomType =
                trim(
                    (string)(
                        $_POST['room_type']
                        ?? ''
                    )
                );

            $bedId =
                (int)(
                    $_POST['bed_id']
                    ?? 0
                );

            $doctorId =
                (int)(
                    $_POST[
                        'admitted_by_doctor_id'
                    ] ?? 0
                );

            $admissionDate =
                trim(
                    (string)(
                        $_POST['admission_date']
                        ?? ''
                    )
                );

            $expected =
                trim(
                    (string)(
                        $_POST[
                            'expected_discharge_date'
                        ] ?? ''
                    )
                );

            $reason =
                trim(
                    (string)(
                        $_POST['admission_reason']
                        ?? ''
                    )
                );


            if (
                $mappingId <= 0 ||
                $bedId <= 0 ||
                $doctorId <= 0 ||
                $roomType === ''
            ) {

                throw new RuntimeException(
                    'Patient, room type, bed and admitting doctor are required.'
                );
            }


            /*
            Admission date.
            */

            if ($admissionDate === '') {

                $admissionDate =
                    date('Y-m-d H:i:s');

            } else {

                $admissionDate =
                    str_replace(
                        'T',
                        ' ',
                        $admissionDate
                    );


                if (
                    strlen($admissionDate)
                    === 16
                ) {

                    $admissionDate .= ':00';
                }


                $ts =
                    strtotime(
                        $admissionDate
                    );


                if ($ts === false) {

                    throw new RuntimeException(
                        'Invalid admission date.'
                    );
                }


                $admissionDate =
                    date(
                        'Y-m-d H:i:s',
                        $ts
                    );
            }


            /*
            Verify patient belongs
            to current hospital.
            */

            $st =
                mysqli_prepare(
                    $conn,
                    "
                    SELECT mapping_id
                    FROM patient_hospital_mapping

                    WHERE mapping_id = ?
                      AND hospital_id = ?

                    LIMIT 1
                    "
                );


            if (!$st) {

                throw new RuntimeException(
                    mysqli_error($conn)
                );
            }


            mysqli_stmt_bind_param(
                $st,
                'ii',
                $mappingId,
                $hospital_id
            );


            mysqli_stmt_execute($st);


            $res =
                mysqli_stmt_get_result($st);


            $patientExists =
                $res
                    ? mysqli_fetch_assoc($res)
                    : null;


            if ($res) {
                mysqli_free_result($res);
            }


            mysqli_stmt_close($st);


            if (!$patientExists) {

                throw new RuntimeException(
                    'Selected patient is not registered in this hospital.'
                );
            }


            /*
            Hospital DB transaction.
            */

            mysqli_begin_transaction(
                $hospital_conn
            );


            try {

                /*
                ------------------------------------------------------------
                SELECTED APPOINTMENT VALIDATION
                ------------------------------------------------------------
                */

                if ($appointmentId > 0) {

                    $st =
                        mysqli_prepare(
                            $hospital_conn,
                            "
                            SELECT
                                appointment_id,
                                mapping_id,
                                appointment_date,
                                appointment_status

                            FROM appointments

                            WHERE appointment_id = ?
                              AND mapping_id = ?

                            LIMIT 1
                            "
                        );


                    if (!$st) {

                        throw new RuntimeException(
                            mysqli_error(
                                $hospital_conn
                            )
                        );
                    }


                    mysqli_stmt_bind_param(
                        $st,
                        'ii',
                        $appointmentId,
                        $mappingId
                    );


                    mysqli_stmt_execute($st);


                    $res =
                        mysqli_stmt_get_result(
                            $st
                        );


                    $appointment =
                        $res
                            ? mysqli_fetch_assoc($res)
                            : null;


                    if ($res) {
                        mysqli_free_result($res);
                    }


                    mysqli_stmt_close($st);


                    if (!$appointment) {

                        throw new RuntimeException(
                            'Selected appointment does not belong to this patient.'
                        );
                    }


                    if (
                        in_array(
                            $appointment[
                                'appointment_status'
                            ],
                            [
                                'Cancelled',
                                'No-Show'
                            ],
                            true
                        )
                    ) {

                        throw new RuntimeException(
                            'Cancelled or No-Show appointment cannot be linked to admission.'
                        );
                    }


                    /*
                    Past appointment is NOT allowed.
                    */

                    if (
                        $appointment[
                            'appointment_date'
                        ] < date('Y-m-d')
                    ) {

                        throw new RuntimeException(
                            'Past appointments cannot be selected for a new admission.'
                        );
                    }

                } else {

                    $appointmentId = 0;
                }


                /*
                ------------------------------------------------------------
                BED + ROOM TYPE VALIDATION
                ------------------------------------------------------------
                */

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        SELECT
                            b.bed_id,
                            b.status,
                            r.room_id,
                            r.room_number,
                            r.room_type,
                            r.status AS room_status

                        FROM beds b

                        JOIN rooms r
                            ON r.room_id = b.room_id

                        WHERE b.bed_id = ?

                        FOR UPDATE
                        "
                    );


                if (!$st) {

                    throw new RuntimeException(
                        mysqli_error(
                            $hospital_conn
                        )
                    );
                }


                mysqli_stmt_bind_param(
                    $st,
                    'i',
                    $bedId
                );


                mysqli_stmt_execute($st);


                $res =
                    mysqli_stmt_get_result(
                        $st
                    );


                $bed =
                    $res
                        ? mysqli_fetch_assoc($res)
                        : null;


                if ($res) {
                    mysqli_free_result($res);
                }


                mysqli_stmt_close($st);


                if (!$bed) {

                    throw new RuntimeException(
                        'Selected bed was not found.'
                    );
                }


                if (
                    $bed['status'] !==
                    'Available'
                ) {

                    throw new RuntimeException(
                        'Selected bed is no longer available.'
                    );
                }


                if (
                    $bed['room_status'] !==
                    'Available'
                ) {

                    throw new RuntimeException(
                        'Selected room is not available.'
                    );
                }


                if (
                    $bed['room_type'] !==
                    $roomType
                ) {

                    throw new RuntimeException(
                        'Selected bed does not belong to the selected room type.'
                    );
                }


                /*
                ------------------------------------------------------------
                CREATE ADMISSION
                ------------------------------------------------------------
                */

                $admissionNo =
                    'ADM' .
                    date('YmdHis') .
                    random_int(
                        100,
                        999
                    );


                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        INSERT INTO admissions
                        (
                            mapping_id,
                            appointment_id,
                            bed_id,
                            admitted_by_doctor_id,
                            admission_no,
                            admission_date,
                            expected_discharge_date,
                            admission_reason,
                            admission_status
                        )
                        VALUES
                        (
                            ?,
                            NULLIF(?, 0),
                            ?,
                            ?,
                            ?,
                            ?,
                            NULLIF(?, ''),
                            ?,
                            'Admitted'
                        )
                        "
                    );


                if (!$st) {

                    throw new RuntimeException(
                        mysqli_error(
                            $hospital_conn
                        )
                    );
                }


                mysqli_stmt_bind_param(
                    $st,
                    'iiiissss',
                    $mappingId,
                    $appointmentId,
                    $bedId,
                    $doctorId,
                    $admissionNo,
                    $admissionDate,
                    $expected,
                    $reason
                );


                if (
                    !mysqli_stmt_execute($st)
                ) {

                    throw new RuntimeException(
                        mysqli_stmt_error($st)
                    );
                }


                mysqli_stmt_close($st);


                /*
                Mark bed occupied.
                */

                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        UPDATE beds

                        SET status = 'Occupied'

                        WHERE bed_id = ?
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'i',
                    $bedId
                );


                if (
                    !mysqli_stmt_execute($st)
                ) {

                    throw new RuntimeException(
                        mysqli_stmt_error($st)
                    );
                }


                mysqli_stmt_close($st);


                mysqli_commit(
                    $hospital_conn
                );

            } catch (Throwable $e) {

                mysqli_rollback(
                    $hospital_conn
                );

                throw $e;
            }


            module_redirect(
                $module,
                'Admission created successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DISCHARGE
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'admissions'
            &&
            $action === 'discharge'
        ) {

            $id =
                (int)(
                    $_POST['admission_id']
                    ?? 0
                );

            $summary =
                trim(
                    (string)(
                        $_POST[
                            'discharge_summary'
                        ] ?? ''
                    )
                );


            mysqli_begin_transaction(
                $hospital_conn
            );


            try {

                $bedId = 0;


                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        SELECT bed_id

                        FROM admissions

                        WHERE admission_id = ?
                          AND admission_status =
                              'Admitted'

                        FOR UPDATE
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'i',
                    $id
                );


                mysqli_stmt_execute($st);


                $res =
                    mysqli_stmt_get_result($st);


                if (
                    $res &&
                    (
                        $row =
                            mysqli_fetch_assoc($res)
                    )
                ) {

                    $bedId =
                        (int)$row['bed_id'];
                }


                if ($res) {
                    mysqli_free_result($res);
                }


                mysqli_stmt_close($st);


                if ($bedId <= 0) {

                    throw new RuntimeException(
                        'Active admission not found.'
                    );
                }


                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        UPDATE admissions

                        SET
                            admission_status =
                                'Discharged',
                            actual_discharge_date =
                                NOW(),
                            discharge_summary = ?

                        WHERE admission_id = ?
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'si',
                    $summary,
                    $id
                );


                if (
                    !mysqli_stmt_execute($st)
                ) {

                    throw new RuntimeException(
                        mysqli_stmt_error($st)
                    );
                }


                mysqli_stmt_close($st);


                $st =
                    mysqli_prepare(
                        $hospital_conn,
                        "
                        UPDATE beds

                        SET status = 'Available'

                        WHERE bed_id = ?
                        "
                    );


                mysqli_stmt_bind_param(
                    $st,
                    'i',
                    $bedId
                );


                mysqli_stmt_execute($st);

                mysqli_stmt_close($st);


                mysqli_commit(
                    $hospital_conn
                );

            } catch (Throwable $e) {

                mysqli_rollback(
                    $hospital_conn
                );

                throw $e;
            }


            module_redirect(
                $module,
                'Patient discharged successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ROOMS / BEDS
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'rooms_beds'
            &&
            $action === 'add_room'
        ) {

            $room =
                trim(
                    (string)(
                        $_POST['room_number']
                        ?? ''
                    )
                );

            $roomType =
                trim(
                    (string)(
                        $_POST['room_type']
                        ?? 'General Ward'
                    )
                );

            $floor =
                trim(
                    (string)(
                        $_POST['floor_number']
                        ?? ''
                    )
                );

            $charge =
                (float)(
                    $_POST['room_charge']
                    ?? 0
                );


            $st =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    INSERT INTO rooms
                    (
                        room_number,
                        room_type,
                        floor_number,
                        room_charge
                    )
                    VALUES
                    (?,?,?,?)
                    "
                );


            mysqli_stmt_bind_param(
                $st,
                'sssd',
                $room,
                $roomType,
                $floor,
                $charge
            );


            if (
                !$st ||
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    $st
                        ? mysqli_stmt_error($st)
                        : mysqli_error($hospital_conn)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                'Room added successfully.'
            );
        }


        if (
            $module === 'rooms_beds'
            &&
            $action === 'add_bed'
        ) {

            $roomId =
                (int)(
                    $_POST['room_id']
                    ?? 0
                );

            $bed =
                trim(
                    (string)(
                        $_POST['bed_number']
                        ?? ''
                    )
                );

            $charge =
                (float)(
                    $_POST['bed_charge']
                    ?? 0
                );


            $st =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    INSERT INTO beds
                    (
                        room_id,
                        bed_number,
                        bed_charge
                    )
                    VALUES
                    (?,?,?)
                    "
                );


            mysqli_stmt_bind_param(
                $st,
                'isd',
                $roomId,
                $bed,
                $charge
            );


            if (
                !$st ||
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    $st
                        ? mysqli_stmt_error($st)
                        : mysqli_error($hospital_conn)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                'Bed added successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BILLING
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'billing'
            &&
            $action === 'add_bill'
        ) {

            $appointmentId =
                (int)(
                    $_POST[
                        'appointment_id'
                    ] ?? 0
                );

            $total =
                (float)(
                    $_POST[
                        'total_amount'
                    ] ?? 0
                );

            $discount =
                (float)(
                    $_POST[
                        'discount_amount'
                    ] ?? 0
                );

            $tax =
                (float)(
                    $_POST['tax_amount']
                    ?? 0
                );

            $remarks =
                trim(
                    (string)(
                        $_POST['remarks']
                        ?? ''
                    )
                );


            $payable =
                max(
                    0,
                    $total -
                    $discount +
                    $tax
                );


            $no =
                'BILL' .
                date('YmdHis') .
                random_int(100, 999);


            $st =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    INSERT INTO billing
                    (
                        appointment_id,
                        bill_no,
                        total_amount,
                        discount_amount,
                        tax_amount,
                        payable_amount,
                        remarks
                    )
                    VALUES
                    (?,?,?,?,?,?,?)
                    "
                );


            mysqli_stmt_bind_param(
                $st,
                'isdddds',
                $appointmentId,
                $no,
                $total,
                $discount,
                $tax,
                $payable,
                $remarks
            );


            if (
                !$st ||
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    $st
                        ? mysqli_stmt_error($st)
                        : mysqli_error($hospital_conn)
                );
            }


            mysqli_stmt_close($st);


            module_redirect(
                $module,
                'Bill created successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PAYMENTS
        |--------------------------------------------------------------------------
        */

        if (
            $module === 'payments'
            &&
            $action === 'add_payment'
        ) {

            $billId =
                (int)(
                    $_POST['bill_id']
                    ?? 0
                );

            $method =
                trim(
                    (string)(
                        $_POST[
                            'payment_method'
                        ] ?? 'Cash'
                    )
                );

            $amount =
                (float)(
                    $_POST['amount']
                    ?? 0
                );

            $ref =
                trim(
                    (string)(
                        $_POST[
                            'transaction_reference'
                        ] ?? ''
                    )
                );

            $remarks =
                trim(
                    (string)(
                        $_POST['remarks']
                        ?? ''
                    )
                );


            $no =
                'PAY' .
                date('YmdHis') .
                random_int(100, 999);


            $st =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    INSERT INTO payments
                    (
                        bill_id,
                        payment_no,
                        payment_method,
                        amount,
                        transaction_reference,
                        payment_status,
                        remarks
                    )
                    VALUES
                    (
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        'Success',
                        ?
                    )
                    "
                );


            mysqli_stmt_bind_param(
                $st,
                'isdsss',
                $billId,
                $no,
                $method,
                $amount,
                $ref,
                $remarks
            );


            if (
                !$st ||
                !mysqli_stmt_execute($st)
            ) {

                throw new RuntimeException(
                    $st
                        ? mysqli_stmt_error($st)
                        : mysqli_error($hospital_conn)
                );
            }


            mysqli_stmt_close($st);


            /*
            Update bill status.
            */

            $sum =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    SELECT
                        COALESCE(
                            SUM(p.amount),
                            0
                        ),
                        b.payable_amount

                    FROM payments p

                    JOIN billing b
                        ON b.bill_id =
                           p.bill_id

                    WHERE p.bill_id = ?
                      AND p.payment_status =
                          'Success'

                    GROUP BY
                        b.payable_amount
                    "
                );


            mysqli_stmt_bind_param(
                $sum,
                'i',
                $billId
            );


            mysqli_stmt_execute($sum);


            mysqli_stmt_bind_result(
                $sum,
                $paid,
                $payable
            );


            mysqli_stmt_fetch($sum);

            mysqli_stmt_close($sum);


            $newStatus =
                $paid >= $payable
                    ? 'Paid'
                    : (
                        $paid > 0
                            ? 'Partially Paid'
                            : 'Pending'
                    );


            $up =
                mysqli_prepare(
                    $hospital_conn,
                    "
                    UPDATE billing

                    SET bill_status = ?

                    WHERE bill_id = ?
                    "
                );


            mysqli_stmt_bind_param(
                $up,
                'si',
                $newStatus,
                $billId
            );


            mysqli_stmt_execute($up);

            mysqli_stmt_close($up);


            module_redirect(
                $module,
                'Payment recorded successfully.'
            );
        }
    }


} catch (Throwable $e) {

    if (
        isset($hospital_conn) &&
        $hospital_conn instanceof mysqli
    ) {

        @mysqli_rollback(
            $hospital_conn
        );
    }


    $_SESSION['module_flash'] = [
        'message' =>
            'Operation failed: ' .
            $e->getMessage(),

        'type' => 'error'
    ];


    header(
        'Location: hospital_module.php?module=' .
        rawurlencode($module)
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| DATA
|--------------------------------------------------------------------------
*/

$doctors = [];
$appointments = [];
$admissionAppointments = [];
$records = [];
$rooms = [];
$beds = [];
$bills = [];
$centralPatients = [];


/*
|--------------------------------------------------------------------------
| DOCTORS
|--------------------------------------------------------------------------
*/

$doctors =
    fetch_all_assoc(
        $hospital_conn,
        "
        SELECT
            doctor_id,
            doctor_name
        FROM doctors
        ORDER BY doctor_name
        "
    );


/*
|--------------------------------------------------------------------------
| ALL APPOINTMENTS
|--------------------------------------------------------------------------
|
| Used by medical records/billing etc.
|--------------------------------------------------------------------------
*/

$appointments =
    fetch_all_assoc(
        $hospital_conn,
        "
        SELECT
            a.appointment_id,
            a.mapping_id,
            a.appointment_no,
            a.appointment_date,
            a.appointment_time,
            a.appointment_status,
            d.doctor_name

        FROM appointments a

        JOIN doctors d
            ON d.doctor_id =
               a.doctor_id

        ORDER BY
            a.appointment_date DESC,
            a.appointment_time DESC

        LIMIT 500
        "
    );


/*
|--------------------------------------------------------------------------
| ADMISSION APPOINTMENTS
|--------------------------------------------------------------------------
|
| ONLY TODAY + FUTURE
| Cancelled / No-Show excluded
|--------------------------------------------------------------------------
*/

$admissionAppointments =
    fetch_all_assoc(
        $hospital_conn,
        "
        SELECT
            a.appointment_id,
            a.mapping_id,
            a.appointment_no,
            a.appointment_date,
            a.appointment_time,
            a.appointment_status,
            d.doctor_name

        FROM appointments a

        JOIN doctors d
            ON d.doctor_id =
               a.doctor_id

        WHERE a.appointment_date >=
              CURDATE()

          AND a.appointment_status NOT IN
              (
                  'Cancelled',
                  'No-Show'
              )

        ORDER BY
            a.appointment_date ASC,
            a.appointment_time ASC

        LIMIT 500
        "
    );


/*
|--------------------------------------------------------------------------
| MEDICAL RECORDS
|--------------------------------------------------------------------------
*/

$records =
    fetch_all_assoc(
        $hospital_conn,
        "
        SELECT
            mr.medical_record_id,
            mr.appointment_id,
            mr.record_status,
            a.appointment_no,
            a.appointment_date,
            d.doctor_name

        FROM medical_records mr

        JOIN appointments a
            ON a.appointment_id =
               mr.appointment_id

        JOIN doctors d
            ON d.doctor_id =
               a.doctor_id

        ORDER BY
            mr.created_at DESC

        LIMIT 500
        "
    );


/*
|--------------------------------------------------------------------------
| ROOMS
|--------------------------------------------------------------------------
*/

$rooms =
    fetch_all_assoc(
        $hospital_conn,
        "
        SELECT
            room_id,
            room_number,
            room_type,
            floor_number,
            status

        FROM rooms

        ORDER BY
            room_type,
            room_number
        "
    );


/*
|--------------------------------------------------------------------------
| BEDS
|--------------------------------------------------------------------------
|
| Room type included.
|--------------------------------------------------------------------------
*/

$beds =
    fetch_all_assoc(
        $hospital_conn,
        "
        SELECT
            b.bed_id,
            b.room_id,
            b.bed_number,
            b.bed_charge,
            b.status,

            r.room_number,
            r.room_type,
            r.floor_number,
            r.status AS room_status

        FROM beds b

        JOIN rooms r
            ON r.room_id =
               b.room_id

        WHERE r.status =
              'Available'

        ORDER BY
            r.room_type,
            r.room_number,
            b.bed_number
        "
    );


/*
|--------------------------------------------------------------------------
| BILLS
|--------------------------------------------------------------------------
*/

$bills =
    fetch_all_assoc(
        $hospital_conn,
        "
        SELECT
            bill_id,
            bill_no,
            payable_amount,
            bill_status

        FROM billing

        ORDER BY
            created_at DESC

        LIMIT 500
        "
    );


/*
|--------------------------------------------------------------------------
| CENTRAL PATIENTS
|--------------------------------------------------------------------------
|
| IMPORTANT:
| Use central $conn.
| Do NOT connect again with hard-coded credentials.
|--------------------------------------------------------------------------
*/

$patient_stmt =
    mysqli_prepare(
        $conn,
        "
        SELECT
            phm.mapping_id,
            phm.hospital_patient_code,
            phm.account_id,

            pa.first_name,
            pa.last_name,
            pa.mobile

        FROM patient_hospital_mapping phm

        JOIN patient_accounts pa
            ON pa.account_id =
               phm.account_id

        WHERE phm.hospital_id = ?
          AND phm.patient_status =
              'Active'

        ORDER BY
            pa.first_name,
            pa.last_name

        LIMIT 500
        "
    );


if ($patient_stmt) {

    mysqli_stmt_bind_param(
        $patient_stmt,
        'i',
        $hospital_id
    );

    mysqli_stmt_execute(
        $patient_stmt
    );


    $result =
        mysqli_stmt_get_result(
            $patient_stmt
        );


    if ($result) {

        while (
            $p =
                mysqli_fetch_assoc($result)
        ) {

            $p['patient_name'] =
                trim(
                    ($p['first_name'] ?? '') .
                    ' ' .
                    ($p['last_name'] ?? '')
                );


            $centralPatients[] =
                $p;
        }


        mysqli_free_result(
            $result
        );
    }


    mysqli_stmt_close(
        $patient_stmt
    );
}


/*
|--------------------------------------------------------------------------
| TABLE DATA
|--------------------------------------------------------------------------
*/

$rows = [];


if ($module === 'availability') {

    $rows =
        fetch_all_assoc(
            $hospital_conn,
            "
            SELECT
                da.*,
                d.doctor_name

            FROM doctor_availability da

            JOIN doctors d
                ON d.doctor_id =
                   da.doctor_id

            ORDER BY
                d.doctor_name,
                FIELD(
                    da.day_of_week,
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                    'Sunday'
                ),
                da.start_time
            "
        );


} elseif (
    $module === 'medical_records'
) {

    $rows =
        fetch_all_assoc(
            $hospital_conn,
            "
            SELECT
                mr.*,
                a.appointment_no,
                a.appointment_date,
                d.doctor_name

            FROM medical_records mr

            JOIN appointments a
                ON a.appointment_id =
                   mr.appointment_id

            JOIN doctors d
                ON d.doctor_id =
                   a.doctor_id

            ORDER BY
                mr.created_at DESC

            LIMIT 500
            "
        );


} elseif (
    $module === 'prescriptions'
) {

    $rows =
        fetch_all_assoc(
            $hospital_conn,
            "
            SELECT
                p.*,
                a.appointment_no,
                a.appointment_date,
                d.doctor_name,
                mr.medical_record_id

            FROM prescriptions p

            JOIN medical_records mr
                ON mr.medical_record_id =
                   p.medical_record_id

            JOIN appointments a
                ON a.appointment_id =
                   mr.appointment_id

            JOIN doctors d
                ON d.doctor_id =
                   a.doctor_id

            ORDER BY
                p.created_at DESC

            LIMIT 500
            "
        );


} elseif ($module === 'lab_tests') {

    $rows =
        fetch_all_assoc(
            $hospital_conn,
            "
            SELECT
                l.*,
                a.appointment_no,
                d.doctor_name

            FROM lab_tests l

            JOIN medical_records mr
                ON mr.medical_record_id =
                   l.medical_record_id

            JOIN appointments a
                ON a.appointment_id =
                   mr.appointment_id

            JOIN doctors d
                ON d.doctor_id =
                   l.ordered_by_doctor_id

            ORDER BY
                l.created_at DESC

            LIMIT 500
            "
        );


} elseif ($module === 'admissions') {

    $rows =
        fetch_all_assoc(
            $hospital_conn,
            "
            SELECT
                a.*,

                b.bed_number,

                r.room_number,
                r.room_type,

                d.doctor_name,

                phm.hospital_patient_code,

                pa.first_name,
                pa.last_name

            FROM admissions a

            JOIN beds b
                ON b.bed_id =
                   a.bed_id

            JOIN rooms r
                ON r.room_id =
                   b.room_id

            JOIN doctors d
                ON d.doctor_id =
                   a.admitted_by_doctor_id

            JOIN hospital_management.patient_hospital_mapping phm
                ON phm.mapping_id =
                   a.mapping_id

            JOIN hospital_management.patient_accounts pa
                ON pa.account_id =
                   phm.account_id

            WHERE phm.hospital_id =
                  <?=intval($hospital_id)?>

            ORDER BY
                a.admission_date DESC

            LIMIT 500
            "
        );


} elseif ($module === 'rooms_beds') {

    $rows =
        fetch_all_assoc(
            $hospital_conn,
            "
            SELECT
                r.*,
                COUNT(b.bed_id) AS bed_count,
                SUM(
                    b.status = 'Occupied'
                ) AS occupied

            FROM rooms r

            LEFT JOIN beds b
                ON b.room_id =
                   r.room_id

            GROUP BY
                r.room_id

            ORDER BY
                r.room_number
            "
        );


} elseif ($module === 'billing') {

    $rows =
        fetch_all_assoc(
            $hospital_conn,
            "
            SELECT
                b.*,
                a.appointment_no

            FROM billing b

            JOIN appointments a
                ON a.appointment_id =
                   b.appointment_id

            ORDER BY
                b.created_at DESC

            LIMIT 500
            "
        );


} else {

    $rows =
        fetch_all_assoc(
            $hospital_conn,
            "
            SELECT
                p.*,
                b.bill_no

            FROM payments p

            JOIN billing b
                ON b.bill_id =
                   p.bill_id

            ORDER BY
                p.paid_at DESC

            LIMIT 500
            "
        );
}


/*
|--------------------------------------------------------------------------
| SEARCH / FILTER
|--------------------------------------------------------------------------
*/

$filtered = [];


foreach (
    $rows as $row
) {

    $hay =
        strtolower(
            json_encode(
                $row,
                JSON_UNESCAPED_UNICODE
            )
        );


    if (
        $search !== '' &&
        strpos(
            $hay,
            strtolower($search)
        ) === false
    ) {

        continue;
    }


    $rowStatus =
        (string)(
            $row['status']
            ??
            $row['record_status']
            ??
            $row['test_status']
            ??
            $row['admission_status']
            ??
            $row['bill_status']
            ??
            $row['payment_status']
            ??
            ''
        );


    if (
        $status !== '' &&
        $rowStatus !== $status
    ) {

        continue;
    }


    $filtered[] =
        $row;
}


/*
|--------------------------------------------------------------------------
| STATUS OPTIONS
|--------------------------------------------------------------------------
*/

$statusOptions =
    match ($module) {

        'availability' => [
            'Active',
            'Inactive'
        ],

        'medical_records' => [
            'Open',
            'Completed',
            'Archived'
        ],

        'prescriptions' => [
            'Active',
            'Completed',
            'Cancelled'
        ],

        'lab_tests' => [
            'Ordered',
            'Sample Collected',
            'Processing',
            'Completed',
            'Cancelled'
        ],

        'admissions' => [
            'Admitted',
            'Discharged',
            'Transferred',
            'Cancelled'
        ],

        'rooms_beds' => [
            'Available',
            'Maintenance',
            'Inactive'
        ],

        'billing' => [
            'Pending',
            'Partially Paid',
            'Paid',
            'Cancelled'
        ],

        'payments' => [
            'Pending',
            'Success',
            'Failed',
            'Refunded'
        ],

        default => []
    };


/*
|--------------------------------------------------------------------------
| STATS
|--------------------------------------------------------------------------
*/

$stats = [
    'total' => count($rows),
    'active' => 0,
    'today' => 0,
    'filtered' => count($filtered)
];


foreach (
    $rows as $r
) {

    $s =
        (string)(
            $r['status']
            ??
            $r['record_status']
            ??
            $r['test_status']
            ??
            $r['admission_status']
            ??
            $r['bill_status']
            ??
            $r['payment_status']
            ??
            ''
        );


    if (
        in_array(
            $s,
            [
                'Active',
                'Open',
                'Ordered',
                'Admitted',
                'Pending'
            ],
            true
        )
    ) {

        $stats['active']++;
    }


    if (
        (
            $r['test_date']
            ??
            $r['appointment_date']
            ??
            ''
        )
        === date('Y-m-d')
    ) {

        $stats['today']++;
    }
}

?>
<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta
    name="viewport"
    content="width=device-width,initial-scale=1"
>

<title><?=mh($title)?></title>

<link
    rel="stylesheet"
    href="sidebar.css"
>

<link
    rel="stylesheet"
    href="hospital_modules.css"
>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
>

</head>


<body>

<div class="dashboard">

<?php require __DIR__ . '/sidebar.php'; ?>


<main class="main-content">


<!-- HEADER -->

<div class="page-header">

<div>

<div class="eyebrow">

<i
    class="fa-solid <?=mh($icon)?>"
></i>

Hospital Management

</div>


<h1>
    <?=mh($heading)?>
</h1>


<p>
    <?=mh($description)?>
</p>

</div>


<div class="header-actions">


<?php if (
    $module === 'availability'
): ?>

<button
    class="primary-btn"
    data-open="availabilityModal"
>

<i class="fa-solid fa-plus"></i>

Add Availability

</button>

<?php endif; ?>


<?php if (
    $module === 'medical_records'
): ?>

<button
    class="primary-btn"
    data-open="recordModal"
>

<i class="fa-solid fa-plus"></i>

Add Record

</button>

<?php endif; ?>


<?php if (
    $module === 'prescriptions'
): ?>

<button
    class="primary-btn"
    data-open="prescriptionModal"
>

<i class="fa-solid fa-plus"></i>

Add Prescription

</button>

<?php endif; ?>


<?php if (
    $module === 'lab_tests'
): ?>

<button
    class="primary-btn"
    data-open="labModal"
>

<i class="fa-solid fa-plus"></i>

Add Lab Test

</button>

<?php endif; ?>


<?php if (
    $module === 'admissions'
): ?>

<button
    class="primary-btn"
    data-open="admissionModal"
>

<i class="fa-solid fa-plus"></i>

New Admission

</button>

<?php endif; ?>


<?php if (
    $module === 'rooms_beds'
): ?>

<button
    class="primary-btn"
    data-open="roomModal"
>

<i class="fa-solid fa-plus"></i>

Add Room

</button>


<button
    class="secondary-btn"
    data-open="bedModal"
>

<i class="fa-solid fa-bed"></i>

Add Bed

</button>

<?php endif; ?>


<?php if (
    $module === 'billing'
): ?>

<button
    class="primary-btn"
    data-open="billModal"
>

<i class="fa-solid fa-plus"></i>

Create Bill

</button>

<?php endif; ?>


<?php if (
    $module === 'payments'
): ?>

<button
    class="primary-btn"
    data-open="paymentModal"
>

<i class="fa-solid fa-plus"></i>

Record Payment

</button>

<?php endif; ?>


</div>

</div>


<!-- FLASH -->

<?php if ($flash): ?>

<div
    class="page-message <?=mh(
        (string)$flash['type']
    )?>"
>

<i class="fa-solid fa-circle-check"></i>

<?=mh(
    (string)$flash['message']
)?>

</div>

<?php endif; ?>


<!-- STATS -->

<div class="stats-row">

<div class="mini-stat">

<span>Total</span>

<strong>
    <?=number_format(
        $stats['total']
    )?>
</strong>

<i class="fa-solid fa-layer-group"></i>

</div>


<div class="mini-stat">

<span>
    Active / Open
</span>

<strong>
    <?=number_format(
        $stats['active']
    )?>
</strong>

<i class="fa-solid fa-circle-check"></i>

</div>


<div class="mini-stat">

<span>
    Today
</span>

<strong>
    <?=number_format(
        $stats['today']
    )?>
</strong>

<i class="fa-solid fa-calendar-day"></i>

</div>


<div class="mini-stat">

<span>
    Showing
</span>

<strong>
    <?=number_format(
        $stats['filtered']
    )?>
</strong>

<i class="fa-solid fa-filter"></i>

</div>

</div>


<!-- FILTER -->

<form
    class="module-toolbar"
    method="get"
>

<input
    type="hidden"
    name="module"
    value="<?=mh($module)?>"
>


<div class="search-wrap">

<i class="fa-solid fa-magnifying-glass"></i>

<input
    name="search"
    value="<?=mh($search)?>"
    placeholder="
        Search <?=mh(
            strtolower($heading)
        )?>...
    "
>

</div>


<select name="status">

<option value="">
    All Status
</option>


<?php foreach (
    $statusOptions as $s
): ?>

<option
    value="<?=mh($s)?>"
    <?=$status === $s
        ? 'selected'
        : ''?>
>

<?=mh($s)?>

</option>

<?php endforeach; ?>

</select>


<button
    class="filter-btn"
    type="submit"
>

<i class="fa-solid fa-filter"></i>

Filter

</button>


<a
    class="reset-btn"
    href="
        hospital_module.php?module=
        <?=mh($module)?>
    "
>

<i class="fa-solid fa-rotate-left"></i>

Reset

</a>

</form>


<!-- TABLE -->

<div class="table-card">

<div class="table-head">

<div>

<h2>
    <?=mh($heading)?> List
</h2>

<span>
    <?=number_format(
        count($filtered)
    )?>
    record(s)
</span>

</div>

</div>


<div class="table-scroll">

<table>

<thead>

<tr>


<?php if (
    $module === 'availability'
): ?>

<th>Doctor</th>
<th>Day</th>
<th>Time</th>
<th>Slot</th>
<th>Max</th>
<th>Mode</th>
<th>Status</th>
<th>Actions</th>


<?php elseif (
    $module === 'medical_records'
): ?>

<th>Appointment</th>
<th>Doctor</th>
<th>Complaint</th>
<th>Diagnosis</th>
<th>Follow Up</th>
<th>Status</th>
<th>Actions</th>


<?php elseif (
    $module === 'prescriptions'
): ?>

<th>Prescription</th>
<th>Appointment</th>
<th>Doctor</th>
<th>Follow Up</th>
<th>Status</th>
<th>Actions</th>


<?php elseif (
    $module === 'lab_tests'
): ?>

<th>Test</th>
<th>Appointment</th>
<th>Doctor</th>
<th>Category</th>
<th>Status</th>
<th>Date</th>
<th>Actions</th>


<?php elseif (
    $module === 'admissions'
): ?>

<th>Patient</th>
<th>Admission</th>
<th>Room / Bed</th>
<th>Doctor</th>
<th>Date</th>
<th>Status</th>
<th>Actions</th>


<?php elseif (
    $module === 'rooms_beds'
): ?>

<th>Room</th>
<th>Type</th>
<th>Floor</th>
<th>Beds</th>
<th>Occupied</th>
<th>Status</th>
<th>Actions</th>


<?php elseif (
    $module === 'billing'
): ?>

<th>Bill</th>
<th>Appointment</th>
<th>Total</th>
<th>Payable</th>
<th>Status</th>
<th>Actions</th>


<?php else: ?>

<th>Payment</th>
<th>Bill</th>
<th>Method</th>
<th>Amount</th>
<th>Status</th>
<th>Paid At</th>
<th>Actions</th>

<?php endif; ?>


</tr>

</thead>


<tbody>


<?php foreach (
    $filtered as $r
): ?>

<tr>


<?php if (
    $module === 'availability'
): ?>

<td>
<strong>
<?=mh($r['doctor_name'])?>
</strong>
</td>

<td>
<?=mh($r['day_of_week'])?>
</td>

<td>
<?=mh(
    substr(
        $r['start_time'],
        0,
        5
    )
    .
    ' - '
    .
    substr(
        $r['end_time'],
        0,
        5
    )
)?>
</td>

<td>
<?=intval(
    $r['slot_duration_minutes']
)?> min
</td>

<td>
<?=intval(
    $r['max_patients']
)?>
</td>

<td>
<?=mh(
    $r['consultation_mode']
)?>
</td>

<td>

<span class="status-pill">

<?=mh(
    $r['status']
)?>

</span>

</td>

<td class="actions">

<button
    class="icon-btn"
    title="View"
    data-view='<?=mh(
        json_encode($r)
    )?>'
>

<i class="fa-regular fa-eye"></i>

</button>


<button
    class="icon-btn"
    title="Edit"
    data-edit='<?=mh(
        json_encode($r)
    )?>'
    data-open="availabilityModal"
>

<i class="fa-regular fa-pen-to-square"></i>

</button>


<form
    method="post"
    class="inline-form"
    onsubmit="
        return confirm(
            'Delete this availability?'
        );
    "
>

<input
    type="hidden"
    name="action"
    value="delete_availability"
>

<input
    type="hidden"
    name="availability_id"
    value="<?=intval(
        $r['availability_id']
    )?>"
>

<button
    class="icon-btn danger"
    title="Delete"
>

<i class="fa-regular fa-trash-can"></i>

</button>

</form>

</td>


<?php elseif (
    $module === 'medical_records'
): ?>

<td>

<strong>
<?=mh($r['appointment_no'])?>
</strong>

<small>
<?=mh($r['appointment_date'])?>
</small>

</td>

<td>
<?=mh($r['doctor_name'])?>
</td>

<td>
<?=mh(
    mb_strimwidth(
        (string)$r['chief_complaint'],
        0,
        55,
        '...'
    )
)?>
</td>

<td>
<?=mh(
    mb_strimwidth(
        (string)$r['diagnosis_summary'],
        0,
        55,
        '...'
    )
)?>
</td>

<td>
<?=mh(
    $r['follow_up_date']
    ?? '—'
)?>
</td>

<td>
<span class="status-pill">
<?=mh(
    $r['record_status']
)?>
</span>
</td>

<td class="actions">

<button
    class="icon-btn"
    data-view='<?=mh(
        json_encode($r)
    )?>'
>

<i class="fa-regular fa-eye"></i>

</button>


<button
    class="icon-btn"
    data-edit='<?=mh(
        json_encode($r)
    )?>'
    data-open="recordModal"
>

<i class="fa-regular fa-pen-to-square"></i>

</button>


<form
    method="post"
    class="inline-form"
    onsubmit="
        return confirm(
            'Delete this medical record?'
        );
    "
>

<input
    type="hidden"
    name="action"
    value="delete_medical_record"
>

<input
    type="hidden"
    name="medical_record_id"
    value="<?=intval(
        $r['medical_record_id']
    )?>"
>

<button
    class="icon-btn danger"
>

<i class="fa-regular fa-trash-can"></i>

</button>

</form>

</td>


<?php elseif (
    $module === 'prescriptions'
): ?>

<td>
<strong>
<?=mh($r['prescription_no'])?>
</strong>
</td>

<td>
<?=mh($r['appointment_no'])?>
</td>

<td>
<?=mh($r['doctor_name'])?>
</td>

<td>
<?=mh(
    $r['follow_up_date']
    ?? '—'
)?>
</td>

<td>
<span class="status-pill">
<?=mh($r['status'])?>
</span>
</td>

<td class="actions">

<button
    class="icon-btn"
    data-view='<?=mh(
        json_encode($r)
    )?>'
>

<i class="fa-regular fa-eye"></i>

</button>


<button
    class="icon-btn"
    data-edit='<?=mh(
        json_encode($r)
    )?>'
    data-open="prescriptionModal"
>

<i class="fa-regular fa-pen-to-square"></i>

</button>


<form
    method="post"
    class="inline-form"
    onsubmit="
        return confirm(
            'Delete this prescription?'
        );
    "
>

<input
    type="hidden"
    name="action"
    value="delete_prescription"
>

<input
    type="hidden"
    name="prescription_id"
    value="<?=intval(
        $r['prescription_id']
    )?>"
>

<button
    class="icon-btn danger"
>

<i class="fa-regular fa-trash-can"></i>

</button>

</form>

</td>


<?php elseif (
    $module === 'lab_tests'
): ?>

<td>

<strong>
<?=mh($r['test_name'])?>
</strong>

<small>
<?=mh($r['sample_type'])?>
</small>

</td>

<td>
<?=mh($r['appointment_no'])?>
</td>

<td>
<?=mh($r['doctor_name'])?>
</td>

<td>
<?=mh(
    $r['test_category']
    ?? '—'
)?>
</td>

<td>
<span class="status-pill">
<?=mh($r['test_status'])?>
</span>
</td>

<td>
<?=mh(
    $r['test_date']
    ?? '—'
)?>
</td>

<td class="actions">

<button
    class="icon-btn"
    data-view='<?=mh(
        json_encode($r)
    )?>'
>

<i class="fa-regular fa-eye"></i>

</button>


<button
    class="icon-btn"
    data-edit='<?=mh(
        json_encode($r)
    )?>'
    data-open="labModal"
>

<i class="fa-regular fa-pen-to-square"></i>

</button>


<form
    method="post"
    class="inline-form"
    onsubmit="
        return confirm(
            'Delete this lab test?'
        );
    "
>

<input
    type="hidden"
    name="action"
    value="delete_lab_test"
>

<input
    type="hidden"
    name="lab_test_id"
    value="<?=intval(
        $r['lab_test_id']
    )?>"
>

<button
    class="icon-btn danger"
>

<i class="fa-regular fa-trash-can"></i>

</button>

</form>

</td>


<?php elseif (
    $module === 'admissions'
): ?>

<td>

<strong>
<?=mh(
    trim(
        $r['first_name'] .
        ' ' .
        $r['last_name']
    )
)?>
</strong>

<small>
<?=mh(
    $r['hospital_patient_code']
)?>
</small>

</td>

<td>

<strong>
<?=mh($r['admission_no'])?>
</strong>

<small>
<?php if (
    !empty(
        $r['appointment_id']
    )
): ?>

Appointment Linked

<?php else: ?>

No Appointment

<?php endif; ?>
</small>

</td>

<td>

<?=mh(
    $r['room_type']
)?>
<br>

<?=mh(
    $r['room_number'] .
    ' / ' .
    $r['bed_number']
)?>

</td>

<td>
<?=mh($r['doctor_name'])?>
</td>

<td>
<?=mh(
    substr(
        $r['admission_date'],
        0,
        16
    )
)?>
</td>

<td>

<span class="status-pill">

<?=mh(
    $r['admission_status']
)?>

</span>

</td>

<td class="actions">

<button
    class="icon-btn"
    title="View"
    data-view='<?=mh(
        json_encode($r)
    )?>'
>

<i class="fa-regular fa-eye"></i>

</button>


<?php if (
    $r['admission_status']
    === 'Admitted'
): ?>

<button
    class="text-btn"
    data-discharge="<?=intval(
        $r['admission_id']
    )?>"
>

Discharge

</button>

<?php endif; ?>

</td>


<?php elseif (
    $module === 'rooms_beds'
): ?>

<td>
<strong>
<?=mh($r['room_number'])?>
</strong>
</td>

<td>
<?=mh($r['room_type'])?>
</td>

<td>
<?=mh(
    $r['floor_number']
    ?? '—'
)?>
</td>

<td>
<?=intval(
    $r['bed_count']
)?>
</td>

<td>
<?=intval(
    $r['occupied']
    ?? 0
)?>
</td>

<td>

<span class="status-pill">

<?=mh(
    $r['status']
)?>

</span>

</td>

<td class="actions">

<button
    class="icon-btn"
    data-view='<?=mh(
        json_encode($r)
    )?>'
>

<i class="fa-regular fa-eye"></i>

</button>

</td>


<?php elseif (
    $module === 'billing'
): ?>

<td>
<strong>
<?=mh($r['bill_no'])?>
</strong>
</td>

<td>
<?=mh(
    $r['appointment_no']
)?>
</td>

<td>
₹ <?=number_format(
    (float)$r['total_amount'],
    2
)?>
</td>

<td>
₹ <?=number_format(
    (float)$r['payable_amount'],
    2
)?>
</td>

<td>

<span class="status-pill">

<?=mh(
    $r['bill_status']
)?>

</span>

</td>

<td class="actions">

<button
    class="icon-btn"
    data-view='<?=mh(
        json_encode($r)
    )?>'
>

<i class="fa-regular fa-eye"></i>

</button>

</td>


<?php else: ?>

<td>
<strong>
<?=mh($r['payment_no'])?>
</strong>
</td>

<td>
<?=mh($r['bill_no'])?>
</td>

<td>
<?=mh($r['payment_method'])?>
</td>

<td>
₹ <?=number_format(
    (float)$r['amount'],
    2
)?>
</td>

<td>

<span class="status-pill">

<?=mh(
    $r['payment_status']
)?>

</span>

</td>

<td>
<?=mh($r['paid_at'])?>
</td>

<td class="actions">

<button
    class="icon-btn"
    data-view='<?=mh(
        json_encode($r)
    )?>'
>

<i class="fa-regular fa-eye"></i>

</button>

</td>

<?php endif; ?>


</tr>

<?php endforeach; ?>


<?php if (!$filtered): ?>

<tr>

<td
    colspan="8"
    class="empty"
>

<div>

<i class="fa-regular fa-folder-open"></i>

<strong>
    No records found
</strong>

<span>
    Try changing your search or filter,
    or add a new record.
</span>

</div>

</td>

</tr>

<?php endif; ?>


</tbody>

</table>

</div>

</div>


</main>

</div>


<!-- =========================================================
     AVAILABILITY MODAL
========================================================= -->

<?php if (
    $module === 'availability'
): ?>

<div
    class="module-modal"
    id="availabilityModal"
>

<div class="modal-card">

<div class="modal-title">

<div>

<span>
Doctor Availability
</span>

<h2>
Add Availability
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="save_availability"
>

<input
    type="hidden"
    name="availability_id"
    id="availability_id"
>


<div class="form-grid">


<label>

Doctor

<select
    name="doctor_id"
    id="availability_doctor"
    required
>

<option value="">
    Select Doctor
</option>

<?php foreach (
    $doctors as $d
): ?>

<option
    value="<?=intval(
        $d['doctor_id']
    )?>"
>

<?=mh(
    $d['doctor_name']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<label>

Day

<select
    name="day_of_week"
    id="availability_day"
    required
>

<?php foreach (
    [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
    ] as $d
): ?>

<option>
<?=mh($d)?>
</option>

<?php endforeach; ?>

</select>

</label>


<label>

Start Time

<input
    type="time"
    name="start_time"
    id="availability_start"
    required
>

</label>


<label>

End Time

<input
    type="time"
    name="end_time"
    id="availability_end"
    required
>

</label>


<label>

Slot Duration

<select
    name="slot_duration_minutes"
    id="availability_slot"
>

<option>10</option>
<option>15</option>
<option>20</option>
<option>30</option>
<option>60</option>

</select>

</label>


<label>

Maximum Patients

<input
    type="number"
    min="1"
    name="max_patients"
    id="availability_max"
    value="20"
    required
>

</label>


<label>

Consultation Mode

<select
    name="consultation_mode"
    id="availability_mode"
>

<option>
In-Person
</option>

<option>
Video
</option>

<option>
Both
</option>

</select>

</label>


<label>

Status

<select
    name="record_status"
    id="availability_status"
>

<option>
Active
</option>

<option>
Inactive
</option>

</select>

</label>


</div>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button
    class="primary-btn"
>
Save Availability
</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- =========================================================
     MEDICAL RECORD MODAL
========================================================= -->

<?php if (
    $module === 'medical_records'
): ?>

<div
    class="module-modal"
    id="recordModal"
>

<div class="modal-card wide">

<div class="modal-title">

<div>

<span>
Clinical
</span>

<h2>
Add Medical Record
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="save_medical_record"
>

<input
    type="hidden"
    name="medical_record_id"
    id="medical_record_id"
>


<div class="form-grid">


<label>

Appointment

<select
    name="appointment_id"
    id="record_appointment"
    required
>

<option value="">
Select Appointment
</option>

<?php foreach (
    $appointments as $a
): ?>

<option
    value="<?=intval(
        $a['appointment_id']
    )?>"
>

<?=mh(
    $a['appointment_no'] .
    ' — ' .
    $a['doctor_name'] .
    ' — ' .
    $a['appointment_date']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<label>

Status

<select
    name="record_status"
    id="record_status"
>

<option>
Open
</option>

<option>
Completed
</option>

<option>
Archived
</option>

</select>

</label>


<label class="full">

Chief Complaint

<textarea
    name="chief_complaint"
    id="record_complaint"
></textarea>

</label>


<label class="full">

Present Illness

<textarea
    name="present_illness"
    id="record_illness"
></textarea>

</label>


<label>

Past Medical History

<textarea
    name="past_medical_history"
    id="record_history"
></textarea>

</label>


<label>

Family History

<textarea
    name="family_history"
    id="record_family"
></textarea>

</label>


<label>

Allergies

<textarea
    name="allergies"
    id="record_allergies"
></textarea>

</label>


<label>

Clinical Notes

<textarea
    name="clinical_notes"
    id="record_notes"
></textarea>

</label>


<label>

Diagnosis Summary

<textarea
    name="diagnosis_summary"
    id="record_diagnosis"
></textarea>

</label>


<label>

Follow-up Date

<input
    type="date"
    name="follow_up_date"
    id="record_follow"
>

</label>


<label class="full">

Follow-up Notes

<textarea
    name="follow_up_notes"
    id="record_follow_notes"
></textarea>

</label>


</div>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button class="primary-btn">
Save Record
</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- =========================================================
     PRESCRIPTION MODAL
========================================================= -->

<?php if (
    $module === 'prescriptions'
): ?>

<div
    class="module-modal"
    id="prescriptionModal"
>

<div class="modal-card">

<div class="modal-title">

<div>

<span>
Clinical
</span>

<h2>
Prescription
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="save_prescription"
>

<input
    type="hidden"
    name="prescription_id"
    id="prescription_id"
>


<label>

Medical Record

<select
    name="medical_record_id"
    id="prescription_record"
    required
>

<option value="">
Select Medical Record
</option>

<?php foreach (
    $records as $r
): ?>

<option
    value="<?=intval(
        $r['medical_record_id']
    )?>"
>

<?=mh(
    $r['appointment_no'] .
    ' — ' .
    $r['doctor_name'] .
    ' — ' .
    $r['appointment_date']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<label>

Prescription No

<input
    name="prescription_no"
    id="prescription_no"
    placeholder="
        Auto generated if blank
    "
>

</label>


<label>

Advice

<textarea
    name="advice"
    id="prescription_advice"
></textarea>

</label>


<label>

Follow-up Date

<input
    type="date"
    name="follow_up_date"
    id="prescription_follow"
>

</label>


<label>

Status

<select
    name="prescription_status"
    id="prescription_status"
>

<option>
Active
</option>

<option>
Completed
</option>

<option>
Cancelled
</option>

</select>

</label>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button class="primary-btn">
Save Prescription
</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- =========================================================
     LAB TEST MODAL
========================================================= -->

<?php if (
    $module === 'lab_tests'
): ?>

<div
    class="module-modal"
    id="labModal"
>

<div class="modal-card wide">

<div class="modal-title">

<div>

<span>
Diagnostics
</span>

<h2>
Lab Test
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="save_lab_test"
>

<input
    type="hidden"
    name="lab_test_id"
    id="lab_test_id"
>


<div class="form-grid">


<label>

Medical Record

<select
    name="medical_record_id"
    id="lab_record"
    required
>

<option value="">
Select Medical Record
</option>

<?php foreach (
    $records as $r
): ?>

<option
    value="<?=intval(
        $r['medical_record_id']
    )?>"
>

<?=mh(
    $r['appointment_no'] .
    ' — ' .
    $r['doctor_name'] .
    ' — ' .
    $r['appointment_date']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<label>

Ordered By Doctor

<select
    name="ordered_by_doctor_id"
    id="lab_doctor"
    required
>

<option value="">
Select Doctor
</option>

<?php foreach (
    $doctors as $d
): ?>

<option
    value="<?=intval(
        $d['doctor_id']
    )?>"
>

<?=mh(
    $d['doctor_name']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<label>

Test Name

<input
    name="test_name"
    id="lab_name"
    required
>

</label>


<label>

Category

<input
    name="test_category"
    id="lab_category"
>

</label>


<label>

Sample Type

<select
    name="sample_type"
    id="lab_sample"
>

<option>
Blood
</option>

<option>
Urine
</option>

<option>
Stool
</option>

<option>
Saliva
</option>

<option>
Sputum
</option>

<option>
Other
</option>

</select>

</label>


<label>

Status

<select
    name="test_status"
    id="lab_status"
>

<option>
Ordered
</option>

<option>
Sample Collected
</option>

<option>
Processing
</option>

<option>
Completed
</option>

<option>
Cancelled
</option>

</select>

</label>


<label>

Test Date

<input
    type="date"
    name="test_date"
    id="lab_date"
>

</label>


<label>

Normal Range

<input
    name="normal_range"
    id="lab_normal"
>

</label>


<label class="full">

Result

<textarea
    name="test_result"
    id="lab_result"
></textarea>

</label>


<label class="full">

Remarks

<textarea
    name="remarks"
    id="lab_remarks"
></textarea>

</label>


</div>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button class="primary-btn">
Save Lab Test
</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- =========================================================
     ROOMS
========================================================= -->

<?php if (
    $module === 'rooms_beds'
): ?>

<div
    class="module-modal"
    id="roomModal"
>

<div class="modal-card">

<div class="modal-title">

<div>

<span>
Hospital
</span>

<h2>
Add Room
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="add_room"
>


<label>

Room Number

<input
    name="room_number"
    required
>

</label>


<label>

Room Type

<select name="room_type">

<option>
General Ward
</option>

<option>
Semi Private
</option>

<option>
Private
</option>

<option>
ICU
</option>

<option>
NICU
</option>

<option>
Operation Theatre
</option>

<option>
Emergency
</option>

</select>

</label>


<label>

Floor

<input
    name="floor_number"
>

</label>


<label>

Room Charge

<input
    type="number"
    step="0.01"
    name="room_charge"
    value="0"
>

</label>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button class="primary-btn">
Save Room
</button>

</div>

</form>

</div>

</div>


<!-- ADD BED -->

<div
    class="module-modal"
    id="bedModal"
>

<div class="modal-card">

<div class="modal-title">

<div>

<span>
Hospital
</span>

<h2>
Add Bed
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="add_bed"
>


<label>

Room

<select
    name="room_id"
    required
>

<?php foreach (
    $rooms as $r
): ?>

<option
    value="<?=intval(
        $r['room_id']
    )?>"
>

<?=mh(
    $r['room_number'] .
    ' — ' .
    $r['room_type']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<label>

Bed Number

<input
    name="bed_number"
    required
>

</label>


<label>

Bed Charge

<input
    type="number"
    step="0.01"
    name="bed_charge"
    value="0"
>

</label>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button class="primary-btn">
Save Bed
</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- =========================================================
     BILLING
========================================================= -->

<?php if (
    $module === 'billing'
): ?>

<div
    class="module-modal"
    id="billModal"
>

<div class="modal-card">

<div class="modal-title">

<div>

<span>
Finance
</span>

<h2>
Create Bill
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="add_bill"
>


<label>

Appointment

<select
    name="appointment_id"
    required
>

<?php foreach (
    $appointments as $a
): ?>

<option
    value="<?=intval(
        $a['appointment_id']
    )?>"
>

<?=mh(
    $a['appointment_no'] .
    ' — ' .
    $a['doctor_name'] .
    ' — ' .
    $a['appointment_date']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<label>

Total Amount

<input
    type="number"
    step="0.01"
    min="0"
    name="total_amount"
    required
>

</label>


<label>

Discount

<input
    type="number"
    step="0.01"
    min="0"
    name="discount_amount"
    value="0"
>

</label>


<label>

Tax

<input
    type="number"
    step="0.01"
    min="0"
    name="tax_amount"
    value="0"
>

</label>


<label>

Remarks

<textarea
    name="remarks"
></textarea>

</label>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button class="primary-btn">
Create Bill
</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- =========================================================
     PAYMENTS
========================================================= -->

<?php if (
    $module === 'payments'
): ?>

<div
    class="module-modal"
    id="paymentModal"
>

<div class="modal-card">

<div class="modal-title">

<div>

<span>
Finance
</span>

<h2>
Record Payment
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="add_payment"
>


<label>

Bill

<select
    name="bill_id"
    required
>

<?php foreach (
    $bills as $b
): ?>

<option
    value="<?=intval(
        $b['bill_id']
    )?>"
>

<?=mh(
    $b['bill_no'] .
    ' — ₹' .
    number_format(
        (float)$b['payable_amount'],
        2
    )
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<label>

Payment Method

<select name="payment_method">

<option>Cash</option>
<option>Card</option>
<option>UPI</option>
<option>Net Banking</option>
<option>Insurance</option>
<option>Other</option>

</select>

</label>


<label>

Amount

<input
    type="number"
    step="0.01"
    min="0"
    name="amount"
    required
>

</label>


<label>

Transaction Reference

<input
    name="transaction_reference"
>

</label>


<label>

Remarks

<textarea
    name="remarks"
></textarea>

</label>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button class="primary-btn">
Save Payment
</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- =========================================================
     ADMISSION MODAL
========================================================= -->

<?php if (
    $module === 'admissions'
): ?>

<div
    class="module-modal"
    id="admissionModal"
>

<div class="modal-card wide">

<div class="modal-title">

<div>

<span>
Hospital
</span>

<h2>
New Admission
</h2>

</div>


<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form
    method="post"
    id="admissionForm"
>

<input
    type="hidden"
    name="action"
    value="add_admission"
>


<div class="form-grid">


<!-- PATIENT -->

<label>

Patient

<select
    name="mapping_id"
    id="admissionPatient"
    required
>

<option value="">
Select Patient
</option>


<?php foreach (
    $centralPatients as $p
): ?>

<option
    value="<?=intval(
        $p['mapping_id']
    )?>"
>

<?=mh(
    (
        $p['patient_name']
        ?: 'Patient'
    )
    .
    ' — ' .
    $p['hospital_patient_code']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<!-- APPOINTMENT -->

<label>

Appointment (optional)

<select
    name="appointment_id"
    id="admissionAppointment"
>

<option value="0">
Select Patient First
</option>

</select>


<small
    id="appointmentHelp"
    style="
        display:block;
        margin-top:6px;
        color:#64748b;
    "
>

Select a patient to see
current/future appointments.

</small>

</label>


<!-- ROOM TYPE -->

<label>

Room Type

<select
    name="room_type"
    id="admissionRoomType"
    required
>

<option value="">
Select Room Type
</option>


<?php

$roomTypes = [];


foreach (
    $rooms as $room
) {

    if (
        !empty(
            $room['room_type']
        )
        &&
        !in_array(
            $room['room_type'],
            $roomTypes,
            true
        )
    ) {

        $roomTypes[] =
            $room['room_type'];
    }
}


foreach (
    $roomTypes as $roomType
):

?>

<option
    value="<?=mh($roomType)?>"
>

<?=mh($roomType)?>

</option>

<?php endforeach; ?>

</select>

</label>


<!-- BED -->

<label>

Bed

<select
    name="bed_id"
    id="admissionBed"
    required
    disabled
>

<option value="">
Select Room Type First
</option>


<?php foreach (
    $beds as $b
): ?>

<?php if (
    $b['status'] === 'Available'
    &&
    (
        $b['room_status']
        ?? 'Available'
    ) === 'Available'
): ?>

<option
    value="<?=intval(
        $b['bed_id']
    )?>"

    data-room-type="<?=mh(
        $b['room_type']
    )?>"
>

<?=mh(
    $b['room_type'] .
    ' — Room ' .
    $b['room_number'] .
    ' — Bed ' .
    $b['bed_number']
)?>

</option>

<?php endif; ?>

<?php endforeach; ?>

</select>

</label>


<!-- DOCTOR -->

<label>

Admitting Doctor

<select
    name="admitted_by_doctor_id"
    required
>

<option value="">
Select Doctor
</option>


<?php foreach (
    $doctors as $d
): ?>

<option
    value="<?=intval(
        $d['doctor_id']
    )?>"
>

<?=mh(
    $d['doctor_name']
)?>

</option>

<?php endforeach; ?>

</select>

</label>


<!-- ADMISSION DATE -->

<label>

Admission Date

<input
    type="datetime-local"
    name="admission_date"
    id="admissionDate"
    value="<?=date(
        'Y-m-d\TH:i'
    )?>"
    required
>

</label>


<!-- EXPECTED DISCHARGE -->

<label>

Expected Discharge

<input
    type="date"
    name="expected_discharge_date"
>

</label>


<!-- REASON -->

<label class="full">

Admission Reason

<textarea
    name="admission_reason"
    placeholder="
        Enter reason for admission...
    "
></textarea>

</label>


</div>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>

Cancel

</button>


<button
    class="primary-btn"
>

<i class="fa-solid fa-bed-pulse"></i>

Create Admission

</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- VIEW MODAL -->

<div
    class="module-modal"
    id="viewModal"
>

<div class="modal-card">

<div class="modal-title">

<div>

<span>
Details
</span>

<h2>
Record Details
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<div
    id="viewContent"
    class="view-details"
></div>


<div class="modal-footer">

<button
    type="button"
    class="primary-btn"
    data-close
>

Close

</button>

</div>

</div>

</div>


<!-- DISCHARGE -->

<?php if (
    $module === 'admissions'
): ?>

<div
    class="module-modal"
    id="dischargeModal"
>

<div class="modal-card">

<div class="modal-title">

<div>

<span>
Admission
</span>

<h2>
Discharge Patient
</h2>

</div>

<button
    type="button"
    data-close
>

<i class="fa-solid fa-xmark"></i>

</button>

</div>


<form method="post">

<input
    type="hidden"
    name="action"
    value="discharge"
>


<input
    type="hidden"
    name="admission_id"
    id="discharge_id"
>


<label>

Discharge Summary

<textarea
    name="discharge_summary"
    required
></textarea>

</label>


<div class="modal-footer">

<button
    type="button"
    class="reset-modal"
    data-close
>
Cancel
</button>

<button class="primary-btn">
Confirm Discharge
</button>

</div>

</form>

</div>

</div>

<?php endif; ?>


<!-- =========================================================
     ADMISSION JS
========================================================= -->

<?php if (
    $module === 'admissions'
): ?>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const patientSelect =
            document.getElementById(
                'admissionPatient'
            );


        const appointmentSelect =
            document.getElementById(
                'admissionAppointment'
            );


        const appointmentHelp =
            document.getElementById(
                'appointmentHelp'
            );


        const roomTypeSelect =
            document.getElementById(
                'admissionRoomType'
            );


        const bedSelect =
            document.getElementById(
                'admissionBed'
            );


        const admissionAppointments =
            <?=json_encode(
                $admissionAppointments,
                JSON_UNESCAPED_UNICODE |
                JSON_UNESCAPED_SLASHES
            )?>;


        /*
        ----------------------------------------------------------
        PATIENT -> APPOINTMENTS
        ----------------------------------------------------------
        */

        function loadPatientAppointments()
        {

            if (!appointmentSelect) {
                return;
            }


            const mappingId =
                patientSelect
                    ? patientSelect.value
                    : '';


            appointmentSelect.innerHTML =
                '';


            /*
            No patient selected.
            */

            if (!mappingId) {

                const option =
                    document.createElement(
                        'option'
                    );


                option.value = '0';

                option.textContent =
                    'Select Patient First';


                appointmentSelect.appendChild(
                    option
                );


                if (appointmentHelp) {

                    appointmentHelp.textContent =
                        'Select a patient to see current/future appointments.';
                }


                return;
            }


            /*
            ONLY selected patient's appointments.
            */

            const patientAppointments =
                admissionAppointments.filter(
                    function (appointment) {

                        return String(
                            appointment.mapping_id
                        )
                        ===
                        String(
                            mappingId
                        );
                    }
                );


            /*
            Always show No Appointment.
            */

            const noAppointment =
                document.createElement(
                    'option'
                );


            noAppointment.value =
                '0';

            noAppointment.textContent =
                'No Appointment';


            appointmentSelect.appendChild(
                noAppointment
            );


            /*
            Add current/future appointments.
            */

            patientAppointments.forEach(
                function (appointment) {

                    const option =
                        document.createElement(
                            'option'
                        );


                    option.value =
                        appointment.appointment_id;


                    let text =
                        appointment.appointment_no
                        +
                        ' — '
                        +
                        (
                            appointment.doctor_name
                            ||
                            'Doctor'
                        )
                        +
                        ' — '
                        +
                        appointment.appointment_date;


                    if (
                        appointment.appointment_time
                    ) {

                        text +=
                            ' ' +
                            appointment.appointment_time;
                    }


                    option.textContent =
                        text;


                    appointmentSelect.appendChild(
                        option
                    );

                }
            );


            /*
            Add Appointment option.
            */

            const addAppointment =
                document.createElement(
                    'option'
                );


            addAppointment.value =
                '__add_appointment__';


            addAppointment.textContent =
                '＋ Add Appointment';


            appointmentSelect.appendChild(
                addAppointment
            );


            if (appointmentHelp) {

                if (
                    patientAppointments.length
                    > 0
                ) {

                    appointmentHelp.textContent =
                        patientAppointments.length +
                        ' current/future appointment(s) found.';

                } else {

                    appointmentHelp.textContent =
                        'This patient has no current/future appointment. You can add an appointment.';
                }
            }

        }


        /*
        ----------------------------------------------------------
        ROOM TYPE -> BEDS
        ----------------------------------------------------------
        */

        function filterBeds()
        {

            if (
                !roomTypeSelect ||
                !bedSelect
            ) {

                return;
            }


            const selectedRoomType =
                roomTypeSelect.value;


            let availableBeds =
                0;


            Array.from(
                bedSelect.options
            ).forEach(
                function (option) {

                    if (!option.value) {
                        return;
                    }


                    const show =
                        selectedRoomType &&
                        option.dataset.roomType
                        ===
                        selectedRoomType;


                    option.hidden =
                        !show;


                    if (show) {
                        availableBeds++;
                    }

                }
            );


            bedSelect.value =
                '';


            bedSelect.disabled =
                !selectedRoomType ||
                availableBeds === 0;


            const firstOption =
                bedSelect.options[0];


            if (firstOption) {

                if (!selectedRoomType) {

                    firstOption.textContent =
                        'Select Room Type First';

                } else if (
                    availableBeds === 0
                ) {

                    firstOption.textContent =
                        'No Available Bed in this Room Type';

                } else {

                    firstOption.textContent =
                        'Select Available Bed';
                }
            }

        }


        /*
        ----------------------------------------------------------
        PATIENT CHANGE
        ----------------------------------------------------------
        */

        if (patientSelect) {

            patientSelect.addEventListener(
                'change',
                loadPatientAppointments
            );
        }


        /*
        ----------------------------------------------------------
        ROOM CHANGE
        ----------------------------------------------------------
        */

        if (roomTypeSelect) {

            roomTypeSelect.addEventListener(
                'change',
                filterBeds
            );
        }


        /*
        ----------------------------------------------------------
        ADD APPOINTMENT
        ----------------------------------------------------------
        */

        if (appointmentSelect) {

            appointmentSelect.addEventListener(
                'change',
                function () {

                    if (
                        this.value
                        ===
                        '__add_appointment__'
                    ) {

                        const mappingId =
                            patientSelect
                                ? patientSelect.value
                                : '';


                        window.location.href =
                            'appointments.php'
                            +
                            (
                                mappingId
                                    ? '?mapping_id='
                                      +
                                      encodeURIComponent(
                                          mappingId
                                      )
                                    : ''
                            );
                    }

                }
            );
        }


        /*
        ----------------------------------------------------------
        FORM VALIDATION
        ----------------------------------------------------------
        */

        const form =
            document.getElementById(
                'admissionForm'
            );


        if (form) {

            form.addEventListener(
                'submit',
                function (event) {

                    if (
                        appointmentSelect &&
                        appointmentSelect.value
                        ===
                        '__add_appointment__'
                    ) {

                        event.preventDefault();

                        alert(
                            'Please add the appointment first, then create the admission.'
                        );

                        return;
                    }


                    if (
                        roomTypeSelect &&
                        !roomTypeSelect.value
                    ) {

                        event.preventDefault();

                        alert(
                            'Please select a room type.'
                        );

                        roomTypeSelect.focus();

                        return;
                    }


                    if (
                        bedSelect &&
                        (
                            bedSelect.disabled
                            ||
                            !bedSelect.value
                        )
                    ) {

                        event.preventDefault();

                        alert(
                            'Please select an available bed.'
                        );

                        bedSelect.focus();

                        return;
                    }

                }
            );
        }


        /*
        Initial state.
        */

        loadPatientAppointments();

        filterBeds();

    }
);

</script>

<?php endif; ?>


<script src="hospital_modules.js"></script>

</body>

</html>
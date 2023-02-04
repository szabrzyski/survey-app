INSERT INTO
    `survey_statuses` (
        `name`,
        `default`,
        `visible`,
        `api_available`,
        `questions_required`,
        `additional_info`,
        `created_at`,
        `updated_at`
    )
VALUES
    (
        'Edycja',
        1,
        0,
        0,
        0,
        0,
        '2023-02-02 00:00:00',
        '2023-02-02 00:00:00'
    ),
    (
        'Testowanie',
        0,
        1,
        0,
        0,
        1,
        '2023-02-02 00:00:00',
        '2023-02-02 00:00:00'
    ),
    (
        'Gotowe',
        0,
        1,
        1,
        1,
        0,
        '2023-02-02 00:00:00',
        '2023-02-02 00:00:00'
    );
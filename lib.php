<?php

/* 
 * Define extra form validation functionality here (RJL addition).
 * Disallows generic email addresses.
 */
function auth_emailadmin_validate_extend_signup_form($data) {
    $bademail = 'Due to a recent spam attack this site is no longer accepting generic email address such as at gmail, hotmail, icloud etc. Instead you must provide an educational institution and your email address must be at that institution';
    $badinstitution = 'You must be at a recognised international educational institution with an internet presence that can be checked';
    $disallowed = ['gmail.com', 'hotmail', 'outlook', 'pochtampt', 'usgeek',
        'gmx.de', 'intermediate-website', 'yahoo', 'ragnortheblue', 'qq.com',
        'erpin.org', 'icloud.com', 'rrunua.xyz', 'shitmail'];
    $email = $data['email'];
    foreach ($disallowed as $bad) {
        if (strpos($email, $bad) !== false) {
            $errors['email'] = $bademail;
        }
    }
    $key = 'profile_field_EducationalInstitution';
    if (strlen($data[$key]) <= 3) {
        $errors[$key] = $badinstitution;
    }
    return $errors;
}


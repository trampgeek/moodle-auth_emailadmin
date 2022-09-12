<?php

/* 
 * Define extra form validation functionality here (RJL addition).
 * Disallows generic email addresses.
 */
function auth_emailadmin_validate_extend_signup_form($data) {
    $bademail = 'Due to a recent spam attack this site is no longer accepting generic email address such as at gmail, hotmail, icloud etc. Instead you must provide an educational institution and your email address must be at that institution';
    $badinstitution = 'Your institution does not appear to be a recognised international educational institution. If you still want access, please email the site administrator directly, explaining your situation and including a web link to your institution.';
    $disallowed = ['gmail.com', 'hotmail', 'outlook', 'pochtampt', 'usgeek','jenniferlawrence',
        'gmx.de', 'intermediate-website', 'yahoo', 'ragnortheblue', 'qq.com','faqq.org', 'yandex.ru',
        'erpin.org', 'icloud.com', 'rrunua.xyz', 'shitmail', 'mail.ru','vipcherry.com','mailcomfort.com'];
    $disallowedininstitution = [' AG', 'porn', 'consulting', 'Consulting', 'Porn', 'KG', 'Holding', 'Ltd', 'Services', 'mbH', 'GbR', 'LLC', 'cheat', 'Solutions'];
    $email = $data['email'];
    $errors = [];
    foreach ($disallowed as $bad) {
        if (strpos($email, $bad) !== false) {
            $errors['email'] = $bademail;
        }
    }
    $key = 'profile_field_EducationalInstitution';
    $institution = $data[$key];
    if (strlen($institution) <= 3) {
        $errors[$key] = $badinstitution;
    } else {
        foreach($disallowedininstitution as $bad) {
            if (strpos($institution, $bad) !== false) {
                $errors[$key] = $badinstitution;
            }
        }
    }
    return $errors;
}


<?php


function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}


function base_path($path)
{
    return BASE_PATH . $path;
}

function adaptText($value)
{

    return strip_tags(str_replace(' ', '', ucfirst(strtolower($value))));
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($uri)
{
    header('location: ' . $uri);
    exit();
}

//csrf
function generate_csrf_token()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf_token($token)
{
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token");
    }
}

function subTheString($mainString, $delimiter = ',')
{
    $emails = explode($delimiter, $mainString);
    $cleanedEmails = array_map('trim', $emails);
    $filteredEmails = array_filter($cleanedEmails);
    return array_values($filteredEmails);
}

function isEmailInString($emailString, $providedEmail)
{
    $emails = explode(',', $emailString);
    $emails = array_map('trim', $emails);

    $found = in_array($providedEmail, $emails);
    return $found ? $providedEmail : false;
}


function generate_followed_divs($followedArr)
{
    $followedArr = explode(',', $followedArr);
    if (!is_array($followedArr) || count($followedArr) === 0) {
        return 'You have no friends';
    }

    $output = '';
    foreach ($followedArr as $followed) {
        $profilePic = $followed['profile_pic'] ?? '/facebook/public/images/head_alizarin.png';
        $userName = explode('@', $followed)[0];
        $userEmail = $followed;
        $csrfToken = generate_csrf_token();

        $output .= <<<HTML
            <div class="dashboard_row">
                <div class="user_info">
                    <img src="{$profilePic}" alt="profile_pic">
                    <h4>{$userName}</h4>
                </div>
                <div class="delete_handler">
                    <form action="/manage-followed" method="POST">
                        <input type="hidden" name="csrf_token" value="{$csrfToken}">
                        <input type="hidden" name="user_email" value="{$userEmail}">
                        <input type="hidden" name="action" value="unfollow">
                        <button type="submit" class="fa fa-user-times"> UN-FOLLOW</button>
                    </form>
                </div>
            </div>
        HTML;
    }

    return $output;
}
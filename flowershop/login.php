<?php
// Start server-side buffering to output cookies and re-directs
ob_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="true" -->
<head>
    <title>Flo's Flowershop</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor=#9FB93D leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table width="957" height="617" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="28" background="images/leftsidefill.gif"><img src="images/spacer.gif" width="1" height="1"></td>
        <td width="755" valign="top">
            <table width="758" height="608" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="145" colspan="3">
                        <img src="images/menu.gif" alt="Search for flowers and arrangements" width="758" height="142" border="0" usemap="#Map" href="../account.php">
                        <map name="Map">
                            <area shape="rect" coords="12,101,86,130" href="selectflowers.php" alt="Select flowers to purchase">
                            <area shape="rect" coords="93,101,225,130" href="selectarrangements.php" alt="Select arrangements to purchase">
                            <area shape="rect" coords="666,100,707,134" href="checkout.php" alt="View cart and checkout">
                            <area shape="rect" coords="718,99,753,133" href="account.php" alt="View my account details">
                            <area shape="rect" coords="9,11,141,88" href="index.html">
                            <area shape="rect" coords="620,100,657,135" href="search.php" alt="Search for flowers and arrangements">
                        </map>
                    </td>
                </tr>
                <tr>
                    <td width="15" height="410"><img src="images/spacer.gif" width="1" height="1"></td>
                    <td width="752" align="left" valign="top">
                        <!-- InstanceBeginEditable name="Content" -->

                        <?php
                        require "flowershop.conf";
                        require "db_func.php";

                        if (!open_db()) {
                            die;
                        }

                        $loginName = stripslashes($_POST["login"]);
                        $loginPass = stripslashes($_POST["password"]);

                        // Check if the account is locked
                        $result = db_query("SELECT login_attempts, lock_time FROM users WHERE login='" . $loginName . "'");
                        $row = fetch_row($result);
                        $loginAttempts = $row["login_attempts"];
                        $lockTime = $row["lock_time"];

                        // If the account is locked



// Calculate the time 5 minutes ago
$fiveMinutesAgo = date('Y-m-d H:i:s', strtotime('-5 minutes'));

// Format lock time to match the format of $fiveMinutesAgo
$formattedLockTime = date('Y-m-d H:i:s', strtotime($lockTime));



// Check if the account is locked
if ($loginAttempts >= 5 && $formattedLockTime > $fiveMinutesAgo) {
    echo "Account has been locked. Please try again in 5 minutes.";
    exit;
} elseif ($loginAttempts >= 5 && $formattedLockTime <= $fiveMinutesAgo) {
    // If lock time has expired, reset login attempts and lock time
    db_query("UPDATE users SET login_attempts = 0, lock_time = NULL WHERE login = '$loginName'");
}






                        // Check login credentials
                        $result = db_query("SELECT * FROM users WHERE login='" . $loginName . "' AND password='" . $loginPass . "'");

                        if (num_rows($result) == 0) {
                            // Update login attempts and lock time
                            $loginAttempts++;
                            db_query("UPDATE users SET login_attempts = $loginAttempts, lock_time = NOW() WHERE login = '$loginName'");

                            echo "<p class=\"content\">Invalid login\n";
                        } else {
// Successful login
$row = fetch_row($result);
$userid = $row["uid"];
$uuid = uniqid();
// Reset login attempts and lock time
db_query("UPDATE users SET login_attempts = 0, lock_time = NULL WHERE login = '$loginName'");

// Give the user a session cookie (timeout in 1 week) and transfer to userdetails page
$sessionid = get_last_id();
// Hash the session ID before setting it in the cookie
$hashedSessionID = hash('sha256', $uuid);
// Set session cookie with secure and HTTP only flags
$cookieParams = session_get_cookie_params();
setcookie("flowershop_session", $hashedSessionID, time() + 604800, $cookieParams['path'], $cookieParams['domain'], true, true);

$result = db_query("INSERT INTO sessions VALUES ('$hashedSessionID', $userid)");


session_start();

// Check if CSRF token exists and is not expired
if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token_expiry'] < time()) {
    // Regenerate CSRF token and set expiry time
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    $_SESSION['csrf_token_expiry'] = time() + 604800; // Expiry time set to 1 week (604800 seconds)
}

$csrfToken = $_SESSION['csrf_token'];



header("Location: " . $GLOBALS["siteroot"] . "userdetails.php?id=$userid");
exit();



                        }
                        ?>

                        <!-- InstanceEndEditable -->
                    </td>
                    <td width="20"><img src="images/spacer.gif" width="1" height="1"></td>
                </tr>
                <tr>
                    <td height=53 colspan="3" align="left"><img src="images/logo.gif"></td>
                </tr>
            </table>
        </td>
        <td width="218" background="images/rightsidefill.gif"><img src="images/spacer.gif" width="1" height="1"></td>
    </tr>

</table>
</body>
<!-- InstanceEnd -->
</html>

<?php
// Flush server-side buffer
ob_end_flush();
?>

<?php
if (file_exists('./bootstrap.php')) {
    require_once('./bootstrap.php');
} else {
    die('Please put this file in the home directory !');
}


$versionToUpdate = '1.7';
$olderVersion = '1.6.3';

if ($config->version == $versionToUpdate && $config->filesVersion == $config->version) {
    die("Your website is already updated to {$versionToUpdate}, nothing to do.");
}
if ($config->version == $versionToUpdate && $config->filesVersion != $config->version) {
    die("Your website is database is updated to {$versionToUpdate}, but files are not uploaded, please upload all the files and make sure to use SFTP, all files should be overwritten.");
}

if ($config->version < $olderVersion) {
    die("Please update to v{$olderVersion} first version by version, your current version is: v" . $config->version);
}

if (!file_exists('update_langs')) {
    die('Folder ./update_langs is not uploaded and missing, please upload the update_langs folder.');
}


$updated = false;
if (!empty($_GET['updated'])) {
    $updated = true;
}
if (!empty($_POST['query'])) {
    $query = mysqli_query($conn, base64_decode($_POST['query']));
    if ($query) {
        $data['status'] = 200;
    } else {
        $data['status'] = 400;
        $data['error']  = mysqli_error($conn);
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}


if (!empty($_POST['update_langs'])) {
    $data  = array();
    $query = mysqli_query($conn, "SHOW COLUMNS FROM `langs`");
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = $fetched_data['Field'];
    }
    unset($data[0]);
    unset($data[1]);
    unset($data[2]);
    unset($data[3]);
    foreach ($data as $key => $value) {
        updateLangs($value);
    }

    $langs = LangsNamesFromDB();
    foreach ($langs as $key => $value) {
        $lang = strtolower($key);
        $count = $db->where("option_name",$lang)->getOne('options');
        if (empty($count)) {
            $db->insert('options',[
                'option_name' => $lang,
                'option_value' => 1
            ]);
        }
    }

    $files = ["lib", "requests/ajax/payu.php", "update_langs"];

    foreach ($files as $key => $value) {
        if (file_exists($value)) {
            if (is_dir($value)) {
                deleteDirectory($value);
            } else {
                @unlink($value);
            }
        }
    }

    $db->where('option_name', 'version')->update("options", ['option_value' => $versionToUpdate]);
    $name = md5(microtime()) . '_updated.php';
    rename('update.php', $name);
}

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }
    return rmdir($dir);
}

function updateLangs($lang) {
    global $conn;
    if (!file_exists("update_langs/{$lang}.txt")) {
        $filename = "update_langs/unknown.txt";
    } else {
        $filename = "update_langs/{$lang}.txt";
    }
    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines    = file($filename);
    // Loop through each line
    foreach ($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;
        // Add this line to the current segment
        $templine .= $line;
        $query = false;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            $templine = str_replace('`{unknown}`', "`{$lang}`", $templine);
            //echo $templine;
            $query    = mysqli_query($conn, $templine);
            // Reset temp variable to empty
            $templine = '';
        }
    }
}
?>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <title>Updating Quickdate</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <style>
         @import url('https://fonts.googleapis.com/css?family=Roboto:400,500');
         @media print {
            .wo_update_changelog {max-height: none !important; min-height: !important}
            .btn, .hide_print, .setting-well h4 {display:none;}
         }
         * {outline: none !important;}
         body {background: #f3f3f3;font-family: 'Roboto', sans-serif;}
         .light {font-weight: 400;}
         .bold {font-weight: 500;}
         .btn {height: 52px;line-height: 1;font-size: 16px;transition: all 0.3s;border-radius: 2em;font-weight: 500;padding: 0 28px;letter-spacing: .5px;}
         .btn svg {margin-left: 10px;margin-top: -2px;transition: all 0.3s;vertical-align: middle;}
         .btn:hover svg {-webkit-transform: translateX(3px);-moz-transform: translateX(3px);-ms-transform: translateX(3px);-o-transform: translateX(3px);transform: translateX(3px);}
         .btn-main {color: #ffffff;background-color: #b0088d;border-color: #b0088d;}
         .btn-main:disabled, .btn-main:focus {color: #fff;}
         .btn-main:hover {color: #ffffff;background-color: #0dcde2;border-color: #0dcde2;box-shadow: -2px 2px 14px rgba(168, 72, 73, 0.35);}
         svg {vertical-align: middle;}
         .main {color: #b0088d;}
         .wo_update_changelog {
          border: 1px solid #eee;
          padding: 10px !important;
         }
         .content-container {display: -webkit-box; width: 100%;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-flex-direction: column;flex-direction: column;min-height: 100vh;position: relative;}
         .content-container:before, .content-container:after {-webkit-box-flex: 1;box-flex: 1;-webkit-flex-grow: 1;flex-grow: 1;content: '';display: block;height: 50px;}
         .wo_install_wiz {position: relative;background-color: white;box-shadow: 0 1px 15px 2px rgba(0, 0, 0, 0.1);border-radius: 10px;padding: 20px 30px;border-top: 1px solid rgba(0, 0, 0, 0.04);}
         .wo_install_wiz h2 {margin-top: 10px;margin-bottom: 30px;display: flex;align-items: center;}
         .wo_install_wiz h2 span {margin-left: auto;font-size: 15px;}
         .wo_update_changelog {padding:0;list-style-type: none;margin-bottom: 15px;max-height: 440px;overflow-y: auto; min-height: 440px;}
         .wo_update_changelog li {margin-bottom:7px; max-height: 20px; overflow: hidden;}
         .wo_update_changelog li span {padding: 2px 7px;font-size: 12px;margin-right: 4px;border-radius: 2px;}
         .wo_update_changelog li span.added {background-color: #4CAF50;color: white;}
         .wo_update_changelog li span.changed {background-color: #e62117;color: white;}
         .wo_update_changelog li span.improved {background-color: #9C27B0;color: white;}
         .wo_update_changelog li span.compressed {background-color: #795548;color: white;}
         .wo_update_changelog li span.fixed {background-color: #2196F3;color: white;}
         input.form-control {background-color: #f4f4f4;border: 0;border-radius: 2em;height: 40px;padding: 3px 14px;color: #383838;transition: all 0.2s;}
input.form-control:hover {background-color: #e9e9e9;}
input.form-control:focus {background: #fff;box-shadow: 0 0 0 1.5px #a84849;}
         .empty_state {margin-top: 80px;margin-bottom: 80px;font-weight: 500;color: #6d6d6d;display: block;text-align: center;}
         .checkmark__circle {stroke-dasharray: 166;stroke-dashoffset: 166;stroke-width: 2;stroke-miterlimit: 10;stroke: #7ac142;fill: none;animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;}
         .checkmark {width: 80px;height: 80px; border-radius: 50%;display: block;stroke-width: 3;stroke: #fff;stroke-miterlimit: 10;margin: 100px auto 50px;box-shadow: inset 0px 0px 0px #7ac142;animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;}
         .checkmark__check {transform-origin: 50% 50%;stroke-dasharray: 48;stroke-dashoffset: 48;animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;}
         @keyframes stroke { 100% {stroke-dashoffset: 0;}}
         @keyframes scale {0%, 100% {transform: none;}  50% {transform: scale3d(1.1, 1.1, 1); }}
         @keyframes fill { 100% {box-shadow: inset 0px 0px 0px 54px #7ac142; }}
      </style>
   </head>
   <body>
      <div class="content-container container">
         <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
               <div class="wo_install_wiz">
                 <?php if ($updated == false) { ?>
                  <div>
                     <h2 class="light">Update to v1.7 </span></h2>
                     <div class="setting-well">
                        <h4>Changelog</h4>
                        <ul class="wo_update_changelog">
                        <li>[Added] support for PHP 8.1.*</li>
                             <li>[Added] the ability to disable a language.</li>
                             <li>[Added] webp support.</li>
                             <li>[Added] subscribe to newsletters on home page.</li>
                             <li>[Added] the ability to set minimum withdrawal amount.</li>
                             <li>[Added] new modern design for "love" theme. </li>
                             <li>[Added] deny username system.</li>
                             <li>[Added] BACKBLAZE cloud storage.</li>
                             <li>[Added] developer mode.</li>
                             <li>[Added] ffmpeg debuuger.</li>
                             <li>[Added] flutterwave payment method.</li>
                             <li>[Added] age restriction system. </li>
                             <li>[Added] system status. </li>
                             <li>[Added] Google recaptcha. </li>
                             <li>[Added] withdrawal payment methods. </li>
                             <li>[Updated] find matches system completely (backend).</li>
                             <li>[Updated] all PHP libs.</li>
                             <li>[Fixed] user can't change birthday from mobile.</li>
                             <li>[Fixed] user can't change birthday from desktop.</li>
                             <li>[Fixed] facebook and twitter links are not correct, they are reversed.</li>
                             <li>[Fixed] email sent from server didn't support HTML code.</li>
                             <li>[Fixed] some JS errros on console log.</li>
                             <li>[Fixed] male and female selection in find match page were not diselecting.</li>
                             <li>[Fixed] "Allowed E-mail Providers" was not working.</li>
                             <li>[Fixed] Agora live and video calls.</li>
                             <li>[Fixed] developer page is showing even if developer page is disabled.</li>
                             <li>[Fixed] can't upload image to messages while S3 enabled.</li>
                             <li>[Fixed] deleting users doesn't delete their data from same tables.</li>
                             <li>[Fixed] image verfication issues.</li>
                             <li>[Fixed] logging out doesn't work from admin panel.</li>
                             <li>[Fixed] day/night mode switcher problems.</li>
                             <li>[Fixed] right click + paste doesn't work in admin panel inputs.</li>
                             <li>[Fixed] SMS bugs, messagebird + msg91.</li>
                             <li>[Fixed] social media links in footer are disabled but is still shown. </li>
                             <li>[Fixed] login with VK + mail.ru</li>
                             <li>[Fixed] some php files showing on google search results.</li>
                             <li>[Fixed] "select box" custom fields not working.</li>
                             <li>[Fixed] when you try to remove a language from the admin panel, the site will be crushed.</li>
                             <li>[Fixed] for free users, you can write a message to more than 1 user.</li>
                             <li>[Fixed] private image is not working when using third party storage other than amazon.</li>
                             <li>[Fixed] If user registration is disabled in the admin panel, but social login is enabled, user can't register using social login.</li>
                             <li>[Fixed] 10+ API issues.</li>
                             <li>[Fixed] 20+ minor bugs.</li>
                        </ul>
                        <p class="hide_print">Note: The update process might take few minutes.</p>
                        <p class="hide_print">Important: If you got any fail queries, please copy them, open a support ticket and send us the details.</p>
                        <br>
                             <button class="pull-right btn btn-default" onclick="window.print();">Share Log</button>
                             <button type="button" class="btn btn-main" id="button-update">
                             Update
                             <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
                                <path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path>
                             </svg>
                          </button>
                     </div>
                     <?php }?>
                     <?php if ($updated == true) { ?>
                      <div>
                        <div class="empty_state">
                           <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                           </svg>
                           <p>Congratulations, you have successfully updated your site. Thanks for choosing WoWonder.</p>
                           <br>
                           <a href="<?php echo $wo['config']['site_url'] ?>" class="btn btn-main" style="line-height:50px;">Home</a>
                        </div>
                     </div>
                     <?php }?>
                  </div>
               </div>
            </div>
            <div class="col-md-1"></div>
         </div>
      </div>
   </body>
</html>
<script>
var queries = [
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'msg91_dlt_id', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'backblaze_storage', '0', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'backblaze_bucket_id', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'backblaze_bucket_name', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'backblaze_bucket_region', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'backblaze_access_key_id', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'backblaze_access_key', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'backblaze_endpoint', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'developer_mode', '0', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'pop_up_18', 'off', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'time_18', '1', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'reserved_usernames_system', '0', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'reserved_usernames', '404,about,age-block,app,apps,article,base,blog,contact,create-app,create-story,credit,developers,disliked,faqs,find-matches,forgot,friend-requests,friends,gifts,hot,index,info,interest,liked,likes,live-users,live,login,mail-otp,maintenance,matches,my-info,myprofile,oauth,page,popularity,privacy,pro-success,pro,profile,refund,register,reset,settings-2fa,settings-affiliate,settings-blocked,settings-delete,settings-email,settings-instagram,settings-links,settings-password,settings-payments,settings-privacy,settings-profile,settings-sessions,settings-social,settings,steps,stories,story,terms,third-party-payment,third-party-theme,transactions,unusual-login,user-live,user-info,userverify,verifymail,verifymailotp,verifyphone,verifyphoneotp,video-call,video,visits', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'withdrawal_payment_method', '{\"paypal\":1,\"bank\":0,\"skrill\":0,\"custom\":0}', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'custom_name', '', '2018-11-05 00:00:00');",
    "ALTER TABLE `affiliates_requests` ADD `transfer_info` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `address`, ADD INDEX (`transfer_info`);",
    "ALTER TABLE `affiliates_requests` ADD `type` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `transfer_info`, ADD INDEX (`type`);",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'bulksms_phone_number', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'infobip_phone_number', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'msg91_phone_number', '', '2018-11-05 00:00:00');",
    "ALTER TABLE `daily_credits` ADD `added` INT(11) NOT NULL DEFAULT '0' AFTER `created_at`, ADD INDEX (`added`);",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'cost_admob', '5', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'alipay_payment', '0', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'alipay_server', 'global', '2018-11-05 00:00:00');",
    "CREATE TABLE `email_subscribers` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `email` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `time` INT(15) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), INDEX (`email`), INDEX (`time`)) ENGINE = InnoDB;",
    "ALTER TABLE `users` CHANGE `updated_at` `updated_at` TIMESTAMP NULL;",
    "ALTER TABLE `users` CHANGE `deleted_at` `deleted_at` TIMESTAMP NULL;",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'recaptcha', 'off', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'recaptcha_site_key', '', '2018-11-05 00:00:00');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'recaptcha_secret_key', '', '2018-11-05 00:00:00');",
    "ALTER TABLE `users` ADD `find_match_data` VARCHAR(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `aamarpay_tran_id`;",
    "DROP INDEX show_me_to_2 ON `users`;",
    "DROP INDEX height_2 ON `users`;",
    "DROP INDEX body_2 ON `users`;",
    "DROP INDEX education_3 ON `users`;",
    "DROP INDEX work_status_2 ON `users`;",
    "DROP INDEX relationship_2 ON `users`;",
    "DROP INDEX location_2 ON `users`;",
    "DROP INDEX education_2 ON `users`;",
    "ALTER TABLE `affiliates_requests` ADD INDEX(`amount`);",
    "ALTER TABLE `affiliates_requests` ADD INDEX(`full_amount`);",
    "ALTER TABLE `bank_receipts` ADD INDEX(`approved`);",
    "ALTER TABLE `bank_receipts` ADD INDEX(`created_at`);",
    "ALTER TABLE `blog` ADD INDEX(`posted`);",
    "ALTER TABLE `blog` ADD INDEX(`created_at`);",
    "ALTER TABLE `custom_pages` ADD INDEX(`page_name`);",
    "ALTER TABLE `custom_pages` ADD INDEX(`page_type`);",
    "ALTER TABLE `daily_credits` ADD INDEX(`created_at`);",
    "ALTER TABLE `favorites` ADD INDEX(`user_id`);",
    "ALTER TABLE `favorites` ADD INDEX(`fav_user_id`);",
    "ALTER TABLE `favorites` ADD INDEX(`created_at`);",
    "ALTER TABLE `favorites` CHANGE `user_id` `user_id` INT(11) UNSIGNED NOT NULL DEFAULT '0';",
    "ALTER TABLE `favorites` CHANGE `fav_user_id` `fav_user_id` INT(11) UNSIGNED NOT NULL DEFAULT '0';",
    "ALTER TABLE `favorites` CHANGE `created_at` `created_at` INT(11) UNSIGNED NOT NULL DEFAULT '0';",
    "ALTER TABLE `mediafiles` ADD INDEX(`private_file`);",
    "ALTER TABLE `mediafiles` ADD INDEX(`is_video`);",
    "ALTER TABLE `mediafiles` ADD INDEX(`is_confirmed`);",
    "ALTER TABLE `mediafiles` ADD INDEX(`is_approved`);",
    "ALTER TABLE `notifications` ADD INDEX(`admin`);",
    "ALTER TABLE `payments` ADD INDEX(`amount`);",
    "ALTER TABLE `payments` ADD INDEX(`pro_plan`);",
    "ALTER TABLE `payments` ADD INDEX(`credit_amount`);",
    "ALTER TABLE `payments` ADD INDEX(`via`);",
    "ALTER TABLE `payments` ADD INDEX(`type`);",
    "ALTER TABLE `payments` ADD INDEX(`date`);",
    "ALTER TABLE `stickers` ADD INDEX(`is_pro`);",
    "ALTER TABLE `success_stories` CHANGE `description` `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;",
    "ALTER TABLE `success_stories` CHANGE `story_date` `story_date` DATE NULL DEFAULT NULL;",
    "ALTER TABLE `success_stories` CHANGE `user_id` `user_id` INT(11) UNSIGNED NOT NULL DEFAULT '0';",
    "ALTER TABLE `users` DROP INDEX `yoomoney_hash`;",
    "ALTER TABLE `users` DROP INDEX `aamarpay_tran_id`;",
    "ALTER TABLE `users` DROP INDEX `ngenius_ref`;",
    "ALTER TABLE `users` DROP INDEX `fortumo_hash`;",
    "ALTER TABLE `users` DROP INDEX `coinpayments_txn_id`;",
    "ALTER TABLE `users` DROP INDEX `coinbase_code`;",
    "ALTER TABLE `users` DROP INDEX `coinbase_hash`;",
    "ALTER TABLE `users` DROP INDEX `securionpay_key`;",
    "ALTER TABLE `users` ADD INDEX(`xlikes_created_at`, `xvisits_created_at`, `xmatches_created_at`, `is_pro`, `gender`, `hot_count`);",
    "ALTER TABLE `users` ADD INDEX(`web_device_id`);",
    "ALTER TABLE `users` ADD INDEX(`registered`);",
    "ALTER TABLE `users` ADD INDEX(`is_pro`);",
    "ALTER TABLE `users` ADD INDEX(`pro_type`);",
    "ALTER TABLE `users` ADD INDEX(`web_token_created_at`);",
    "ALTER TABLE `users` ADD INDEX(`approved_at`);",
    "ALTER TABLE `users` ADD INDEX(`conversation_id`);",
    "ALTER TABLE `users` ADD INDEX(`find_match_data`);",
    "ALTER TABLE `users` ADD INDEX(`hot_count`);",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'one_of_three_step');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'two_of_three_step');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'three_of_three_step');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'sign_up');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'let_s_begin_finding_matches');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'best_dating_website_for_any_age');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'terms_and_conditions');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'frequently_asked_questions');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'follow_us_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'anytime___anywhere');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'quick_links');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'why_quickdate_is_the_best_platform_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, '100__data_privacy');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'fully_secure___encrypted');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'start_dating');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'find_your_best_match');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'how_it_works');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_account');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'go_premium');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'go_live_now');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'story_begins');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'search_your_match');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'just_for_you');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'apply_filter');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'other_users___profiles');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'from');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'visited');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'started');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'view_details');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'price');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'last_update');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'daily_tribute');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'blocked');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'my_info');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'affiliates');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'invitation');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'two_factor');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'notifications');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'logout_all_sessions');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'add_thumbnail');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'package');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'choose_plan');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'special');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'yr_age');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'search_blog_you_want...');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'articles_of_the_day');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'read_now');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'topic_match_for_you');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'continue_reading');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'more_topic');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'we_have_made_it_easy_for_you_to_have_fun_while_you_use_our_quickdate_platform.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'register_your_account_with_quick_and_easy_steps__when_you_finish_you_will_get_a_good_looking_profile.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'search___connect_with_matches_which_are_perfect_for_you_to_date__it_s_easy___a_complete_fun.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'based_on_your_location__we_find_best_and_suitable_matches_for_you.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_account_is_safe_on_quickdate._we_never_share_your_data_with_third_party.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_have_full_control_over_your_personal_information_that_you_share.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'always_up_to_date_with_our_latest_offers_and_discounts_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'join_quickdate__where_you_could_meet_anyone__anywhere__it_s_a_complete_fun_to_find_a_perfect_match_for_you_and_continue_to_hook_up');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'quickdate__where_you_could_meet_anyone_digitally__it_s_a_complete_fun_to_find_a_perfect_match_for_you_and_continue_to_hook_up._real_time_messaging___lot_of_features_that_keeps_you_connected_with_your_love_24x365_days.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'age_block_text');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'age_block_extra');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'age_block_modal');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'nopop');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'yes');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'disallowed_username');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'skrill');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'transfer_to');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_select_payment_method');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'times');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_currently_live');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'go_premium');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'successfully_subscribed');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'already_subscribed');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_check_recaptcha');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'reCaptcha_error');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'confirmation_code_sent');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'view_no_more_to_show');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_enable_location');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'unlock_private_video_payment');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'to_unlock_private_video_feature_in_your_account__you_have_to_pay');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_have_to_match_with_media');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'all_countries');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'located_at');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'match_ignore');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'match_ignore');",
    
];

$('#input_code').bind("paste keyup input propertychange", function(e) {
    if (isPurchaseCode($(this).val())) {
        $('#button-update').removeAttr('disabled');
    } else {
        $('#button-update').attr('disabled', 'true');
    }
});

function isPurchaseCode(str) {
    var patt = new RegExp("(.*)-(.*)-(.*)-(.*)-(.*)");
    var res = patt.test(str);
    if (res) {
        return true;
    }
    return false;
}

$(document).on('click', '#button-update', function(event) {
    if ($('body').attr('data-update') == 'true') {
        window.location.href = '<?php echo $site_url?>';
        return false;
    }
    $(this).attr('disabled', true);
    $('.wo_update_changelog').html('');
    $('.wo_update_changelog').css({
        background: '#1e2321',
        color: '#fff'
    });
    $('.setting-well h4').text('Updating..');
    $(this).attr('disabled', true);
    RunQuery();
});

var queriesLength = queries.length;
var query = queries[0];
var count = 0;
function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
    }));
}
function RunQuery() {
    var query = queries[count];
    $.post('?update', {
        query: b64EncodeUnicode(query)
    }, function(data, textStatus, xhr) {
        if (data.status == 200) {
            $('.wo_update_changelog').append('<li><span class="added">SUCCESS</span> ~$ mysql > ' + query + '</li>');
        } else {
            $('.wo_update_changelog').append('<li><span class="changed">FAILED</span> ~$ mysql > ' + query + '</li>');
        }
        count = count + 1;
        if (queriesLength > count) {
            setTimeout(function() {
                RunQuery();
            }, 1500);
        } else {
            $('.wo_update_changelog').append('<li><span class="added">Updating Langauges & Categories</span> ~$ languages.sh, Please wait, this might take some time..</li>');
            $.post('?run_lang', {
                update_langs: 'true'
            }, function(data, textStatus, xhr) {
              $('.wo_update_changelog').append('<li><span class="fixed">Finished!</span> ~$ Congratulations! you have successfully updated your site. Thanks for choosing QuickDate.</li>');
              $('.setting-well h4').text('Update Log');
              $('#button-update').html('Home <svg viewBox="0 0 19 14" xmlns="http://www.w3.org/2000/svg" width="18" height="18"> <path fill="currentColor" d="M18.6 6.9v-.5l-6-6c-.3-.3-.9-.3-1.2 0-.3.3-.3.9 0 1.2l5 5H1c-.5 0-.9.4-.9.9s.4.8.9.8h14.4l-4 4.1c-.3.3-.3.9 0 1.2.2.2.4.2.6.2.2 0 .4-.1.6-.2l5.2-5.2h.2c.5 0 .8-.4.8-.8 0-.3 0-.5-.2-.7z"></path> </svg>');
              $('#button-update').attr('disabled', false);
              $(".wo_update_changelog").scrollTop($(".wo_update_changelog")[0].scrollHeight);
              $('body').attr('data-update', 'true');
            });
        }
        $(".wo_update_changelog").scrollTop($(".wo_update_changelog")[0].scrollHeight);
    });
}
</script>

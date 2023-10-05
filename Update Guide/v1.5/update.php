<?php
if (file_exists('./bootstrap.php')) {
    require_once('./bootstrap.php');
} else {
    die('Please put this file in the home directory !');
}
function PT_UpdateLangs($lang, $key, $value) {
    global $conn;
    $update_query         = "UPDATE langs SET `{lang}` = '{lang_text}' WHERE `lang_key` = '{lang_key}'";
    $update_replace_array = array(
        "{lang}",
        "{lang_text}",
        "{lang_key}"
    );
    return str_replace($update_replace_array, array(
        $lang,
        mysqli_real_escape_string($conn, $value),
        $key
    ), $update_query);
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
    $lang_update_queries = array();
    foreach ($data as $key => $value) {
        $value = ($value);
        if ($value == 'arabic') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'معلوماتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'يرجى اختيار المعلومات التي ترغب في تنزيلها');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'توليد الملف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'حقول مفقودة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'التغطية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'نوع العضو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'جلسات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'وسائل الإعلام');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'ملفك جاهز للتنزيل!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'مصرف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'طريقة الانسحاب');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'ايبان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'الاسم بالكامل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'رمز السرعة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'لديك بالفعل طلب معلق.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{user}} قد انتهت.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'Paystack.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'إنهاء المكالمة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'يعيش');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'نهاية مباشرة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'الذهاب مباشرة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'مصدر ميكروفون');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'مصدر كام');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'فيديو لايف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'المستخدمين الحية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'المستخدمين العيش');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'فيديو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'هو العيش');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'كان العيش');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'أكتب تعليقا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'المستخدم - لايف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'لا مزيد من مقاطع الفيديو لإظهارها.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'تسجيل الدخول مع QQ.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'تسجيل الدخول مع wechat.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'تسجيل الدخول مع الخلاف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'تسجيل الدخول مع mailru.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'المطورين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'إنشاء التطبيق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'إنشاء تطبيق جديد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'اختصاص');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'إعادة توجيه أوري');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'وصف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'برنامج');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'اسم التطبيق الخاص بك. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'الصفحة الرئيسية التي يمكن الوصول إليها في التطبيق الخاص بك.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'أين يجب أن نعود بعد المصادقة بنجاح؟');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'وصف التطبيق الخاص بك، والتي ستظهر في شاشات تفويض مواجهة المستخدم. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'صورة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'تطبيقك الصورة المصغرة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'اختر صورة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'تطبيقات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'يخلق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'إنشاء تطبيق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'OAuth.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'أذونات التطبيق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'URL غير صالح');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'هل أنت متأكد أنك تريد إزالة الفيديو؟');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Authorize.net.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'هل أنت متأكد أنك تريد إزالة هذا التعليق؟');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'securionpay.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'مناقشة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'روابط دعوة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'الروابط المتاحة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'روابط ولدت');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'روابط مستعملة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'توليد رابط');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'عنوان URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'دعوة المستخدم');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'ينسخ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'رمز الناتج بنجاح');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'نسخ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'وظيفة غير موجودة');
        } else if ($value == 'dutch') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'Mijn informatie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Kies welke informatie u wilt downloaden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Het genereren van het bestand');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Ontbrekende velden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Omslag');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Ledentype');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Sessies');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'Media');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Uw bestand is klaar om te downloaden!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'bank');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Trekmethode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'Iban');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Voor-en achternaam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'Swift code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'Je hebt al een hangende aanvraag.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{Gebruiker}} Stream is geëindigd.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'Paystack');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'Ophangen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'Eindigen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Ga leven');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Microfoon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Nokbron');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Live video\'s');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Live-gebruikers');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'live-gebruikers');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'video-');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'is live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'was live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Schrijf een reactie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'gebruiker');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'Geen video\'s meer om te laten zien.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Login met QQ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Login met Wechat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Inloggen met Discord');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Log in met MailRU');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Ontwikkelaars');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'aanmaken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Maak een nieuwe app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Domein');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Omleiden URI');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Beschrijving');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Uw toepassingsnaam. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'De publiek toegankelijke startpagina van uw toepassing.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Waar moeten we terugkeren na succesvol authenticeren?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Uw applicatiebeschrijving, die wordt getoond in autorisatieschermen door de gebruiker. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Afbeelding');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Uw applicatieminiatuur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'Kies afbeelding');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Creëren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Maak app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'OAUTH');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'App-machtigingen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'Ongeldige URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Weet je zeker dat je de video wilt verwijderen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Autoriseer.net');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Weet je zeker dat je deze opmerking wilt verwijderen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'Securionpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Discussie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Uitnodigingsverbindingen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Beschikbare links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Gegenereerde links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Gebruikte links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Link genereren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'uitgenodigde gebruiker');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'kopiëren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Code succesvol gegenereerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'gekopieerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'Functie niet gevonden');
        } else if ($value == 'french') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'Mon information');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Veuillez choisir les informations que vous souhaitez télécharger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Générer un fichier');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Champs manquants');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Couvrir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Type de membre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Sessions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'Médias');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Votre fichier est prêt à télécharger!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'Banque');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Retirer la méthode');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'IBAN');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Nom complet');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'Code rapide');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'Vous avez déjà une demande en attente.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{utilisateur}}} est terminé.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'Paysack');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'Fin d\'appel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Vivre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'Finir en direct');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Aller en direct');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Source micro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Source de came');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Vidéos en direct');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Des utilisateurs vivants');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'utilisateurs en direct');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'vidéo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'est en direct');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'était en direct');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Écrire un commentaire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'en direct de l\'utilisateur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'Plus de vidéos à montrer.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Connectez-vous avec QQ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Connectez-vous avec wechat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Connectez-vous avec la discorde');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Connectez-vous avec Mailru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Développeurs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'Create-App');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Créer une nouvelle application');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Domaine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Rediriger Uri');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'La description');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Votre nom de demande. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'Page d\'accueil accessible au public de votre application.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Où devrions-nous revenir après avoir authentifié avec succès?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Votre description de l\'application, qui sera affichée dans des écrans d\'autorisation face à l\'utilisateur. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Image');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Votre application Thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'Choisissez l\'image');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'applications');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Créer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Créer une application');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'oauth');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'Autorisations de l\'application');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'URL invalide');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Êtes-vous sûr de vouloir supprimer la vidéo?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Autoriser.net');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Êtes-vous certain de vouloir supprimer ce commentaire?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'SecurionPay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Discussion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Liens d\'invitation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Liens disponibles');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Liens générés');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Liens d\'occasion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Générer un lien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'Utilisateur invité');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'copie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Code généré avec succès');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'copié');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'Fonction non trouvée');
        } else if ($value == 'german') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'Meine Information');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Bitte wählen Sie, welche Informationen Sie herunterladen möchten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Datei generieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Fehlende Felder');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Abdeckung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Mitgliedstyp.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Sitzungen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'Medien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Ihre Datei ist bereit zum Herunterladen!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'Bank');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Methode abheben');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'Iban.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Vollständiger Name');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'SWIFT-Code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'Sie haben bereits eine anhängige Anfrage.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{us}}}} ist beendet.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'PayStack');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'Beendigung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Wohnen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'Ende live.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Geh Leben');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Mikrofonquelle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Nockenquelle');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Live-Videos');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Lebe Nutzer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'Live-Benutzer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'Video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'ist live.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'war live.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Schreibe einen Kommentar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'User-Live.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'Keine Videos mehr zu zeigen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Login mit QQ.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Login mit WECHAT');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Login mit der Zwietracht');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Login mit der Mailru.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Entwickler');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'Erstellen-App.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Neue App erstellen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Domain');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'URI umleiten.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Beschreibung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'App.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Ihr Anwendungsname ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'Ihre öffentlich zugängliche Homepage Ihrer Anwendung.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Wo sollen wir nach erfolgreicher Authentifizierung zurückkehren?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Ihre Anwendungsbeschreibung, die in benutzerfreundlichen Berechtigungs-Screens angezeigt wird. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Bild');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Ihre Anwendung Thumbnail.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'Wählen Sie das Bild');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Schaffen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'App erstellen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'Oauth');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'App-Berechtigungen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'Ungültige URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Möchten Sie das Video sicher, dass Sie das Video entfernen möchten?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Autorisieren.net.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Möchten Sie diesen Kommentar sicher entfernen?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'SecurionPay.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Diskussion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Einladungslinks');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Verfügbare Links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Erzeugte Links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Gebrauchte Links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Link generieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'eingeladener Benutzer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'Kopieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Code erfolgreich generiert');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'kopiert');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'Funktion nicht gefunden');
        } else if ($value == 'italian') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'Le mie informazioni');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Si prega di scegliere quali informazioni vorresti scaricare');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Genera file');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Campi mancanti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Coperchio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Tipo di membro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Sessioni');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'Media');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Il tuo file è pronto per il download!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'Banca');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Ritirare il metodo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'iban.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Nome e cognome');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'codice SWIFT');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'Hai già una richiesta in sospeso.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{utente}} stream è terminato.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'Paystack.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'Fine chiamata');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Vivere');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'Fine dal vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Andare in diretta');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Fonte MIC');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Fonte della camma');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Video dal vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Utenti dal vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'Utenti dal vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'è live.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'era vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Scrivi un commento');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'utente-live.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'Non ci sono altri video da mostrare.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Accedi con QQ.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Accedi con WeChat.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Accedi con Discord.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Accedi con MailRu.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Sviluppatori');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'Crea-app.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Crea una nuova app.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Dominio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Reindirizzare gli uri');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Descrizione');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'app.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Il tuo nome dell\'applicazione. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'La home page dell\'accessibile pubblicità dell\'applicazione.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Dove dovremmo tornare dopo l\'autenticazione con successo?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'La descrizione dell\'applicazione, che verrà mostrata nelle schermate di autorizzazione rivolte all\'utente. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Immagine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'La tua applicazione Thumbnail.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'Scegli immagine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'apps.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Creare');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Crea app.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'oauth.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'Autorizzazioni delle app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'URL non valido');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Sei sicuro di voler rimuovere il video?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Autorize.net.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Sei sicuro di voler rimuovere questo commento?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'SecurionPay.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Discussione');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Collegamenti dell\'invito');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Collegamenti disponibili.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Collegamenti generati');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Collegamenti usati');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Genera collegamento');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'copia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Codice generato con successo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'Funzione non trovata');
        } else if ($value == 'portuguese') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'Minha informação');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Por favor, escolha quais informações que você gostaria de baixar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Gerar arquivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Campos ausentes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Cobrir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Tipo de membro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Sessões.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'meios de comunicação');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Seu arquivo está pronto para baixar!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'Banco');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Retirar método');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'iban.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Nome completo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'Código Swift');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'Você já tem um pedido pendente.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{user}} O fluxo terminou.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'Paystack.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'Chamada final');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Viver');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'Final ao vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Vá ao vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Fonte de microfone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Fonte da CAM.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Vídeos vivos');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Usuários ao vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'Usuários ao vivo.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'vídeo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'é ao vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'estava ao vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Escreva um comentário');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'User-Live.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'Não há mais vídeos para mostrar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Faça o login com QQ.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Login com Wechat.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Faça o login com discórdia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Login com mailru.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Desenvolvedores');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'criar-app.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Crie novo aplicativo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Domínio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Redirecionar URI.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Descrição');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'aplicativo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Seu nome de aplicativo. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'A página inicial publicamente acessível do seu aplicativo.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Onde devemos retornar depois de autenticar com sucesso?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Sua descrição do aplicativo, que será mostrada em telas de autorização voltadas para o usuário. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Imagem');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Sua miniatura do aplicativo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'Escolha a imagem.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'aplicativos');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Crio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Criar aplicativo.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'oauth');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'Permissões de aplicativos');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'URL inválida');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Tem certeza de que deseja remover o vídeo?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Autorize.net.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Tem certeza de que deseja remover este comentário?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'Securionpay.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Discussão');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Links de convite');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Links disponíveis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Links gerados');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Links usados');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Gerar link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'URL.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'Usuário convidado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Código gerado com sucesso');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'copiado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', '');
        } else if ($value == 'russian') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'Моя информация');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Пожалуйста, выберите, какую информацию вы хотите скачать');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Генерировать файл');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Недостающие поля');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Обложка');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Тип участника');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Сеансы');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'СМИ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Ваш файл готов скачать!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'банк');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Снять метод');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'Ибана');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Полное имя');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'Свифтный код');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'У вас уже ожидает запрос.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{user}} поток закончился.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'Платный плата');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'Конечный звонок');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Жить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'Конец жизни');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Пойти жить');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Источник микрофона');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'CAM Source');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Живые видео');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Живые пользователи');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'живые пользователи');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'видео');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'живой');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'был живым');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Написать комментарий');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'user-live.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'Больше нет видео, чтобы показать.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Войти с помощью QQ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Войти с wechat.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Войти с раздортом');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Войти с Mailru.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Разработчики');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'создавать приложение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Создать новое приложение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Домен');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Перенаправить Ури');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Описание');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'приложение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Название вашего приложения. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'Публично доступная домашняя страница вашего приложения.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Где мы должны вернуться после успешного аутентификации?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Описание вашего приложения, которое будет показано на экранах авторизации с пользователем. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Изображение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Ваше миниатюру приложения');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'Выберите изображение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Программы');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Создавать');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Создать приложение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'ОАУТ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'Разрешения приложений');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'Неправильный адрес');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Вы уверены, что хотите удалить видео?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Auralize.net.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Вы уверены, что хотите удалить этот комментарий?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'Securionpay.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Обсуждение');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Пригласительные ссылки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Доступные ссылки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Сгенерированные ссылки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Подержанные ссылки');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Генерировать ссылку');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'урл');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'приглашенный пользователь');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'скопировать');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Код успешно сгенерирован');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'скопировано');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'Функция не найдена');
        } else if ($value == 'spanish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'Mi informacion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Por favor, elija la información que desea descargar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Generar archivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Campos faltantes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Cubrir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Tipo de miembro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Sesiones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'Medios de comunicación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Su archivo está listo para descargar!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'Banco');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Método de retiro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'Iban');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Nombre completo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'código SWIFT');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'Ya tienes una solicitud pendiente.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{{USER}} Stream ha finalizado.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'Paystack');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'Finalizar llamada');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Vivir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'Enérgico');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Ir a vivir');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Fuente de micrófono');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Fuente de cámara');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Videos en vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Usuarios en vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'Usuarios en vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'es en vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'estaba vivo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Escribir un comentario');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'de usuario');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'No más videos para mostrar.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Inicia sesión con QQ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Inicia sesión con Wechat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Iniciar sesión con la discordia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Inicia sesión con mailru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Desarrolladores');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'CREATE-APP');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Crear nueva aplicación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Dominio');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Redirigir a uri');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Descripción');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Su nombre de solicitud. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'La página de inicio accesible públicamente de su aplicación.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', '¿Dónde debemos regresar después de autenticar con éxito?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Su descripción de la aplicación, que se mostrará en las pantallas de autorización orientadas al usuario. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Imagen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Su aplicación Thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'Elegir imagen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Crear');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Crear aplicacion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'oauth');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'Permisos de aplicaciones');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'URL invalida');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', '¿Estás seguro de que quieres quitar el video?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Autorize.net');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', '¿Estas seguro de que quieres eliminar este comentario?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'PAYO DE SECURION');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Discusión');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Enlaces de invitación');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Enlaces disponibles');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Enlaces generados');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Enlaces usados');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Generar enlace');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'usuario invitado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'Copiar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Código generado con éxito');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'copiado');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'Función no encontrada');
        } else if ($value == 'turkish') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'Benim bilgim');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Lütfen hangi bilgileri indirmek istediğinizi seçin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Dosya Oluştur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Eksik Alanlar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Örtmek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Üye türü');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Oturumlar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'Medya');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Dosyanız indirmeye hazır!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'Banka');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Çekme yöntemi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'İban');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Ad Soyad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'Swift kodu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'Zaten bekleyen bir talebiniz var.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{user}} Stream sona erdi.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'Paystack');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'Son Arama');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Canlı olarak');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'Sonu sonu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Devam etmek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Mikrofon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Kamera kaynağı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Canlı videolar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Canlı kullanıcılar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'canlı kullanıcılar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'yaşamak');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'yaşadıydı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Bir yorum Yaz');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'Kullanıcı-canlı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'Daha fazla video gösterilemez.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'QQ ile giriş yapın');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Wechat ile giriş yapın');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Uyumlulukla giriş yapın');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Mailru ile giriş yapın');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Geliştiriciler');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'create-app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Yeni uygulama oluştur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Alan adı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Uri yönlendirmek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Tanım');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'uygulama');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Başvuru adınız. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'Uygulamanızın halka açık giriş sayfası.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Başarıyla doğrulamadan sonra nereden dönmeliyiz?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Uygulama açıklamanız, kullanıcı tarafından karşı karşıya kalan yetkilendirme ekranlarında gösterilecektir. ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Görüntü');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Başvurunuz thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'Görüntüyü seç');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Yaratmak');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Uygulama oluştur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'oauth');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'Uygulama İzinleri');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'Geçersiz URL');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Videoyu kaldırmak istediğinize emin misiniz?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Authorize.net');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Bu yorumu kaldırmak istediğinize emin misiniz?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'Securionpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Tartışma');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Davetiye bağlantıları');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Mevcut bağlantılar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Oluşturulan bağlantılar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Kullanılan linkler');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Bağlantı Oluştur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'davetli kullanıcı');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'kopya');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Başarıyla oluşturulan kod');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', '');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'İşlev bulunamadı');
        } else if ($value == 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'My Information');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Please choose which information you would like to download');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Generate file');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Missing fields');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Cover');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Member Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Sessions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'Media');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Your file is ready to download!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'Bank');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Withdraw Method');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'iban');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Full Name');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'Swift Code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'You have already a pending request.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{user}} stream has ended.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'PayStack');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'End Call');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'End Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Go Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Mic Source');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Cam Source');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Live Videos');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Live Users');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'live-users');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'is Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'was Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Write a comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'user-live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'No more videos to show.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Login with QQ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Login with WeChat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Login with Discord');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Login with Mailru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Developers');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'create-app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Create new App');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Domain');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Redirect URI');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Description');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Your application name. This is used to attribute the source user-facing authorization screens. 32 characters max.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'Your application&#039;s publicly accessible home page.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Where should we return after successfully authenticating?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Your application description, which will be shown in user-facing authorization screens. Between 10 and 200 characters max.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Image');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Your application thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'choose image');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Create');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Create App');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'oauth');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'App Permissions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'Invalid Url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Are you sure you want to remove the video?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Authorize.net');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Are you sure you want to remove this comment?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'Securionpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Discussion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Invitation Links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Available links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Generated links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Used links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Generate link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'invited user');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'copy');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Code successfully generated');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'copied');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'Function not found');
        } else if ($value != 'english') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'my_information', 'My Information');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_choose_which_information_you_would_like_to_download', 'Please choose which information you would like to download');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_file', 'Generate file');
            $lang_update_queries[] = PT_UpdateLangs($value, 'missing_fields', 'Missing fields');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cover', 'Cover');
            $lang_update_queries[] = PT_UpdateLangs($value, 'member_type', 'Member Type');
            $lang_update_queries[] = PT_UpdateLangs($value, 'sessions', 'Sessions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'media', 'Media');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_file_is_ready_to_download_', 'Your file is ready to download!');
            $lang_update_queries[] = PT_UpdateLangs($value, 'bank', 'Bank');
            $lang_update_queries[] = PT_UpdateLangs($value, 'withdraw_method', 'Withdraw Method');
            $lang_update_queries[] = PT_UpdateLangs($value, 'iban', 'iban');
            $lang_update_queries[] = PT_UpdateLangs($value, 'full_name', 'Full Name');
            $lang_update_queries[] = PT_UpdateLangs($value, 'swift_code', 'Swift Code');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_have_already_a_pending_request.', 'You have already a pending request.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'stream_has_ended', '{{user}} stream has ended.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'paystack', 'PayStack');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_call', 'End Call');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live', 'Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'end_live', 'End Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'go_live', 'Go Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'mic_source', 'Mic Source');
            $lang_update_queries[] = PT_UpdateLangs($value, 'cam_source', 'Cam Source');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_videos', 'Live Videos');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live_users', 'Live Users');
            $lang_update_queries[] = PT_UpdateLangs($value, 'live-users', 'live-users');
            $lang_update_queries[] = PT_UpdateLangs($value, 'video', 'video');
            $lang_update_queries[] = PT_UpdateLangs($value, 'is_live', 'is Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'was_live', 'was Live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'write_a_comment', 'Write a comment');
            $lang_update_queries[] = PT_UpdateLangs($value, 'user-live', 'user-live');
            $lang_update_queries[] = PT_UpdateLangs($value, 'no_more_videos_to_show.', 'No more videos to show.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_qq', 'Login with QQ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_wechat', 'Login with WeChat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_discord', 'Login with Discord');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_mailru', 'Login with Mailru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'developers', 'Developers');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create-app', 'create-app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_new_app', 'Create new App');
            $lang_update_queries[] = PT_UpdateLangs($value, 'domain', 'Domain');
            $lang_update_queries[] = PT_UpdateLangs($value, 'redirect_uri', 'Redirect URI');
            $lang_update_queries[] = PT_UpdateLangs($value, 'description', 'Description');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app', 'app');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.', 'Your application name. This is used to attribute the source user-facing authorization screens. 32 characters max.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_s_publicly_accessible_home_page.', 'Your application&#039;s publicly accessible home page.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'where_should_we_return_after_successfully_authenticating_', 'Where should we return after successfully authenticating?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.', 'Your application description, which will be shown in user-facing authorization screens. Between 10 and 200 characters max.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'image', 'Image');
            $lang_update_queries[] = PT_UpdateLangs($value, 'your_application_thumbnail', 'Your application thumbnail');
            $lang_update_queries[] = PT_UpdateLangs($value, 'choose_image', 'choose image');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create', 'Create');
            $lang_update_queries[] = PT_UpdateLangs($value, 'create_app', 'Create App');
            $lang_update_queries[] = PT_UpdateLangs($value, 'oauth', 'oauth');
            $lang_update_queries[] = PT_UpdateLangs($value, 'app_permissions', 'App Permissions');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invalid_url', 'Invalid Url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_the_video', 'Are you sure you want to remove the video?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'authorize.net', 'Authorize.net');
            $lang_update_queries[] = PT_UpdateLangs($value, 'are_you_sure_you_want_to_remove_this_comment', 'Are you sure you want to remove this comment?');
            $lang_update_queries[] = PT_UpdateLangs($value, 'securionpay', 'Securionpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'discussion', 'Discussion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invitation_links', 'Invitation Links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'available_links', 'Available links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generated_links', 'Generated links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'used_links', 'Used links');
            $lang_update_queries[] = PT_UpdateLangs($value, 'generate_link', 'Generate link');
            $lang_update_queries[] = PT_UpdateLangs($value, 'url', 'url');
            $lang_update_queries[] = PT_UpdateLangs($value, 'invited_user', 'invited user');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copy', 'copy');
            $lang_update_queries[] = PT_UpdateLangs($value, 'code_successfully_generated', 'Code successfully generated');
            $lang_update_queries[] = PT_UpdateLangs($value, 'copied', 'copied');
            $lang_update_queries[] = PT_UpdateLangs($value, 'function_not_found', 'Function not found');
        }
    }
    if (!empty($lang_update_queries)) {
        foreach ($lang_update_queries as $key => $query) {
            $sql = mysqli_query($conn, $query);
        }
    }
    $name = md5(microtime()) . '_updated.php';
    rename('update.php', $name);
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
                     <h2 class="light">Update to v1.5 </span></h2>
                     <div class="setting-well">
                        <h4>Changelog</h4>
                        <ul class="wo_update_changelog">
                            <li>[Added] prevent login system.</li>
                            <li>[Added] download user data from settings page.</li>
                            <li>[Added] ability to request withdrawal using bank. </li>
                            <li>[Added] 3 new payment methods, PayStack, Authorize.Net, Securionpay. </li>
                            <li>[Added] agora video & audio chat.</li>
                            <li>[Added] live streaming system. </li>
                            <li>[Added] QQ, WeChat, Discord and Mailru social login.</li>
                            <li>[Added] developer system, users can now create application and use login with system. </li>
                            <li>[Added] MessageBird, BulkSMS, Infobip, Msg91 SMS providers. </li>
                            <li>[Added] Invitation system for users and admin. </li>
                            <li>[Added] auto like system, admin can choose an account which get liked by every new user. </li>
                            <li>[Added] new APIs. </li>
                            <li>[Improved] a dmin panel english and desgin.</li>
                            <li>[Fixed] 30+ reported bugs.</li>
                            <li>[Improved] stability & speed. </li>
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
    "UPDATE `options` SET `option_value`= '1.5' WHERE option_name = 'version';",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'google_map_api_key', '', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'payu_payment', 'no', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'payu_mode', '1', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'payu_merchant_id', '', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'payu_secret_key', '', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'payu_buyer_name', '', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'payu_buyer_surname', '', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'payu_buyer_gsm_number', '', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'payu_buyer_email', '', '2021-03-21 15:15:38');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'prevent_system', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'bad_login_limit', '4');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'lock_time', '10');",
    "CREATE TABLE `bad_login` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `ip` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `time` INT(11) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;",
    "ALTER TABLE `bad_login` ADD INDEX(`ip`);",
    "ALTER TABLE `users` ADD `info_file` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `conversation_id`;",
    "ALTER TABLE `affiliates_requests` ADD `iban` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `full_amount`, ADD `country` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `iban`, ADD `full_name` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `country`, ADD `swift_code` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `full_name`, ADD `address` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `swift_code`;",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'paystack_payment', 'no');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'paystack_secret_key', '');",
    "ALTER TABLE `users` ADD `paystack_ref` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `info_file`;",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'twilio_chat_call', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_chat_call', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_chat_app_id', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_chat_app_certificate', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_chat_customer_id', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_chat_customer_secret', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'live_video', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'live_video_save', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_live_video', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_app_id', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_app_certificate', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_customer_id', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'agora_customer_certificate', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'amazone_s3_2', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'bucket_name_2', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'amazone_s3_key_2', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'amazone_s3_s_key_2', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'region_2', 'us-east-1');",
    "CREATE TABLE `posts` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL DEFAULT '0' , `text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `stream_name` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `agora_token` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `live_time` INT(15) NOT NULL DEFAULT '0' , `live_ended` INT(11) NOT NULL DEFAULT '0' , `agora_resource_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `agora_sid` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `time` INT(11) NOT NULL DEFAULT '0' , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;",
    "ALTER TABLE `posts` ADD INDEX(`user_id`);",
    "ALTER TABLE `posts` ADD INDEX(`live_time`);",
    "ALTER TABLE `posts` ADD INDEX(`live_ended`);",
    "ALTER TABLE `posts` ADD INDEX(`time`);",
    "ALTER TABLE `posts` ADD INDEX(`created_at`);",
    "ALTER TABLE `posts` ADD `postType` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `text`;",
    "ALTER TABLE `posts` ADD `image` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `postType`;",
    "CREATE TABLE `live_sub_users` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL DEFAULT '0' , `post_id` INT(11) NOT NULL DEFAULT '0' , `is_watching` INT(11) NOT NULL DEFAULT '0' , `time` INT(11) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), INDEX (`user_id`), INDEX (`post_id`), INDEX (`is_watching`), INDEX (`time`)) ENGINE = InnoDB;",
    "CREATE TABLE `comments` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL DEFAULT '0' , `post_id` INT(11) NOT NULL DEFAULT '0' , `text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `time` INT(11) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), INDEX (`user_id`), INDEX (`post_id`)) ENGINE = InnoDB;",
    "ALTER TABLE `posts` ADD `postFile` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `postType`;",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'qqAppId', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'qqAppkey', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'WeChatAppId', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'WeChatAppkey', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'DiscordAppId', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'DiscordAppkey', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'MailruAppId', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'MailruAppkey', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'qqLogin', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'WeChatLogin', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'DiscordLogin', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'MailruLogin', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'twilio_provider', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'bulksms_provider', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'bulksms_username', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'bulksms_password', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'messagebird_provider', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'messagebird_key', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'messagebird_phone', '');",
    "CREATE TABLE `apps` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `app_user_id` INT(11) NOT NULL DEFAULT '0' , `app_name` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `app_website_url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `app_description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `app_avatar` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `app_callback_url` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `app_id` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `app_secret` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `active` INT(11) NOT NULL DEFAULT '1' , PRIMARY KEY (`id`), INDEX (`app_user_id`), INDEX (`active`)) ENGINE = InnoDB;",
    "CREATE TABLE `codes` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `code` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `app_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `user_id` INT(11) NOT NULL DEFAULT '0' , `time` INT(11) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), INDEX (`code`), INDEX (`app_id`), INDEX (`user_id`)) ENGINE = InnoDB;",
    "CREATE TABLE `apps_permission` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL DEFAULT '0' , `app_id` INT(11) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), INDEX (`user_id`), INDEX (`app_id`)) ENGINE = InnoDB;",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'authorize_payment', 'no');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'authorize_login_id', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'authorize_transaction_key', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'authorize_test_mode', 'SANDBOX');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'securionpay_payment', 'no');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'securionpay_public_key', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'securionpay_secret_key', '');",
    "ALTER TABLE `users` ADD `securionpay_key` INT(30) NOT NULL DEFAULT '0' AFTER `paystack_ref`, ADD INDEX (`securionpay_key`);",
    "CREATE TABLE `invitation_links` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL DEFAULT '0' , `invited_id` INT(11) NOT NULL DEFAULT '0' , `code` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `time` INT(20) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), INDEX (`user_id`), INDEX (`invited_id`), INDEX (`code`), INDEX (`time`)) ENGINE = InnoDB;",
    "CREATE TABLE `admininvitations` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `code` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `posted` INT(20) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`), INDEX (`code`)) ENGINE = InnoDB;",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'invite_links_system', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'user_links_limit', '10');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'expire_user_links', 'month');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'infobip_provider', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'infobip_username', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'infobip_password', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'msg91_provider', '0');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'msg91_authKey', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'auto_user_like', '');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`) VALUES (NULL, 'developers_page', '1');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'my_information');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_choose_which_information_you_would_like_to_download');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'generate_file');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'missing_fields');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'cover');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'member_type');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'sessions');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'media');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_file_is_ready_to_download_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'bank');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'withdraw_method');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'iban');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'full_name');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'swift_code');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_have_already_a_pending_request.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'stream_has_ended');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'paystack');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'end_call');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'live');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'end_live');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'go_live');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'mic_source');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'cam_source');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'live_videos');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'live_users');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'live-users');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'video');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'is_live');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'was_live');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'write_a_comment');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'user-live');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'no_more_videos_to_show.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'login_with_qq');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'login_with_wechat');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'login_with_discord');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'login_with_mailru');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'developers');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create-app');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_new_app');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'domain');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'redirect_uri');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'description');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'app');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_application_name._this_is_used_to_attribute_the_source_user-facing_authorization_screens._32_characters_max.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_application_s_publicly_accessible_home_page.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'where_should_we_return_after_successfully_authenticating_');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_application_description__which_will_be_shown_in_user-facing_authorization_screens._between_10_and_200_characters_max.');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'image');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'your_application_thumbnail');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'choose_image');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'apps');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'create_app');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'oauth');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'app_permissions');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'invalid_url');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'are_you_sure_you_want_to_remove_the_video');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'authorize.net');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'are_you_sure_you_want_to_remove_this_comment');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'securionpay');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'discussion');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'invitation_links');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'available_links');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'generated_links');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'used_links');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'generate_link');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'url');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'invited_user');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'copy');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'code_successfully_generated');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'copied');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'function_not_found');",
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
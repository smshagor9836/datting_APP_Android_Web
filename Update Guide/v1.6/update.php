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
            $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'Ngenius');
            $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'عن طريق إنشاء حسابك ، فأنت توافق على {terms} & {privacy}');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire و Sint Eustatius و Saba');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'إقليم المحيط البريطاني الهندي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'بروناي دار السلام');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'بلغاريا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'بوركينا فاسو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'بوروندي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'كمبوديا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'الكاميرون');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'كندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'كيب فيردي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'جزر كايمان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'جمهورية افريقيا الوسطى');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'تشاد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'تشيلي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'الصين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'جزيرة عيد الميلاد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'جزر كوكوس (كيلينغ)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'كولومبيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'القادمين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'الكونغو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'الكونغو ، جمهورية الكونغو الديمقراطية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'جزر كوك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'كوستا ريكا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'كوت d`ivoire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'كرواتيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'كوبا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'كوراكاو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'قبرص');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'الجمهورية التشيكية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'الدنمارك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'جيبوتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'دومينيكا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'جمهورية الدومينيكان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'الإكوادور');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'مصر');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'السلفادور');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'غينيا الإستوائية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'إريتريا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'إستونيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'أثيوبيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'جزر فوكلاند (مالفيناس)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'جزر فاروس');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'فيجي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'فنلندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'فرنسا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'غيانا الفرنسية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'بولينيزيا الفرنسية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'المناطق الجنوبية لفرنسا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'غابون');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'غامبيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'جورجيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'ألمانيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'غانا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'جبل طارق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'اليونان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'الأرض الخضراء');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'غرينادا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'غواديلوب');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'غوام');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'غواتيمالا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'غيرنسي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'غينيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'غينيا بيساو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'غيانا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'هايتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'قلب الجزيرة وجزر ماكدونالز');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'الكرسي الرسولي (ولاية مدينة الفاتيكان)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'هندوراس');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'هونغ كونغ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'هنغاريا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'أيسلندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'الهند');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'إندونيسيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'إيران ، جمهورية الإسلامية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'العراق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'أيرلندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'جزيرة آيل أوف مان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'إسرائيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'إيطاليا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'جامايكا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'اليابان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'جيرسي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'الأردن');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'كازاخستان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'كينيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'كيريباتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'كوريا ، جمهورية الشعب الديمقراطي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'جمهورية كوريا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'كوسوفو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'الكويت');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'قيرغيزستان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'جمهورية لاو الديمقراطية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'لاتفيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'لبنان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'ليسوتو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'ليبيريا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'الجماهيرية العربية الليبية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'ليختنشتاين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'ليتوانيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'لوكسمبورغ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'ماكاو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'مقدونيا ، جمهورية يوغسلاف السابقة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'مدغشقر');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'ملاوي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'ماليزيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'جزر المالديف');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'مالي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'مالطا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'جزر مارشال');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'مارتينيك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'موريتانيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'موريشيوس');
            $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'مايوت');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'المكسيك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'ميكرونيزيا ، ولايات اتحادية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'جمهورية مولدوفا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'موناكو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'منغوليا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'الجبل الأسود');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'مونتسيرات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'المغرب');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'موزمبيق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'ميانمار');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'ناميبيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'ناورو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'نيبال');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'هولندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'جزر الأنتيل الهولندية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'كاليدونيا الجديدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'نيوزيلاندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'نيكاراغوا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'النيجر');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'نيجيريا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'نيو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'جزيرة نورفولك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'جزر مريانا الشمالية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'النرويج');
            $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'سلطنة عمان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'باكستان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'بالاو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'فلسطيني');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'بنما');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'بابوا غينيا الجديدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'باراجواي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'بيرو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'فيلبيني');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'بيتكيرن');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'بولندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'البرتغال');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'بورتوريكو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'دولة قطر');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'جمع شمل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'رومانيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'الاتحاد الروسي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'رواندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'سانت بارتيليمي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'القديس هيلينا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'سانت كيتس ونيفيس');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'القديسة لوسيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'القديس مارتن');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'سانت بيير وميكلون');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'سانت فنسنت وجزر غرينادين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'ساموا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'سان مارينو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'ساو تومي وبينسبيب');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'المملكة العربية السعودية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'السنغال');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'صربيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'صربيا والجبل الأسود');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'سيشيل');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'سيرا ليون');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'سنغافورة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'سينت مارتن');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'سلوفاكيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'سلوفينيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'جزر سليمان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'الصومال');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'جنوب أفريقيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'جورجيا الجنوبية وجزر ساندويتش الجنوبية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'جنوب السودان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'إسبانيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'سيريلانكا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'السودان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'سورينام');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'سفالبارد وجان ماين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'سوازيلاند');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'السويد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'سويسرا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'الجمهورية العربية السورية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'تايوان ، مقاطعة الصين');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'طاجيكستان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'تنزانيا ، جمهورية موحدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'تايلاند');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'تيمور-ليشتي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'توجو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'توكيلاو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'تونغا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'ترينداد وتوباغو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'تونس');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'ديك رومى');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'تركمانستان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'جزر تركس وكايكوس');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'توفالو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'أوغندا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'أوكرانيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'الإمارات العربية المتحدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'المملكة المتحدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'الولايات المتحدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'جزر الولايات المتحدة البعيدة الصغرى');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'أوروغواي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'أوزبكستان');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'فانواتو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'فنزويلا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'فييت نام');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'جزر العذراء البريطانية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'جزر فيرجن ، الولايات المتحدة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'واليس وفوتونا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'الصحراء الغربية');
            $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'اليمن');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'زامبيا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'زيمبابوي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'تم التحقق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'لم يتم التحقق منه');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'yoomoney');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'الدفع بالمحفظة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'أنت على وشك الترقية إلى عضو محترف.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'ليس لديك رصيد كاف للشراء ، يرجى شراء الاعتمادات.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'دفع بالائتمانات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'أنت على وشك فتح ميزة الصور الخاصة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'أنت على وشك فتح ميزة الفيديو الخاصة.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'رازورباي');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'تسجيل الدخول مع LinkedIn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'تسجيل الدخول مع Okru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'الأسئلة الشائعة');
            $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'استرداد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'احصل على تطبيقات الهاتف المحمول');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'تطبيقات');
            $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'ابدأ في الاستيراد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'أنت مستعد لبدء الاستيراد من Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'ربط حساب Instagram الخاص بك');
            $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'مستورد Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'يستورد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'انتهت صلاحية الرمز المميز');
            $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'مستورد');
            $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'بعد لم يتم العثور عليها');
            $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'الألبوم');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'قد تستغرق هذه العملية بعض الوقت ، يرجى التحقق بعد بضع دقائق');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'فورتومو');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'المدفوعات Coinpays');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'تم إلغاء الدفع الخاص بك باستخدام المدفوعات coinpays');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'تمت الموافقة على الدفع الخاص بك باستخدام المدفوعات coinpays');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'لديك بالفعل طلب معلق ، يرجى المحاولة مرة أخرى لاحقًا');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'الاستيراد من Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<h4> 1- اكتب شروط الاستخدام هنا. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4> 1- اكتب عنا عنا هنا. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<h4> 1- اكتب سياسة الخصوصية الخاصة بك هنا. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<h4> 1- اكتب استرداد الخصوصية الخاص بك هنا. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'رابط Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'يمكنك الآن ربط حساب Instagram الخاص بك بالاستيراد السلس لوسائط Instagram الخاصة بك.');
        } else if ($value == 'dutch') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'NGENIUS');
            $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'Door uw account aan te maken, gaat u akkoord met onze {termen} & {privacy}');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius en Saba');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'Brits-Indisch oceaan gebied');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgarije');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Cambodja');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Kameroen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Canada');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'Kaapverdië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Kaaiman Eilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'Centraal Afrikaanse Republiek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Tsjaad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Chili');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'China');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Kersteiland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Cocos (keeling) eilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Colombia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Comoros');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Congo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Congo, Democratische Republiek van Congo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Kook eilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Costa Rica');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote d`ivoire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Kroatië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Cuba');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curacao');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Cyprus');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'Tsjechische Republiek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Denemarken');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Djibouti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominica');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'Dominicaanse Republiek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Ecuador');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Egypte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'El Salvador');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Equatoriaal-Guinea');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Eritrea');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Ethiopië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Falkland Islands (Malvinas)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Faarseilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Fiji');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'Frankrijk');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'Frans Guyana');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'Frans-Polynesië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'Franse zuidelijke gebieden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gambia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Georgië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Duitsland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Ghana');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Gibraltar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Griekenland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Groenland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Grenada');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadeloupe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernsey');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Guinea');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Guinee-Bissau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guyana');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haïti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Gehoord eiland- en McDonald -eilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Heilige Stoel (Vaticaan Stad Staat)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hong Kong');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Hongarije');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'IJsland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'India');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Indonesië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Iran, Islamitische Republiek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Irak');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Ierland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Isle of Man');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Israël');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Italië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Jamaica');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Japan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Jersey');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Jordanië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Kazachstan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Kenia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Korea, Democratische Volksrepubliek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Korea, republiek van');
            $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosovo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Koeweit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Kirgizisch');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'Lao People\'s Democratic Republic');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Letland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Libanon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesotho');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Liberia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Libië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Litouwen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Luxemburg');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macao');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Macedonië, de voormalige Joegoslavische Republiek van');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagascar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Maleisië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Maldiven');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Mali');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malta');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Marshall eilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Mauritanië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Mauritius');
            $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'Mexico');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Micronesië, federated staten van');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldavië, Republiek van');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Monaco');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Mongolië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Montenegro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Marokko');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Mozambique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Myanmar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namibië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Nepal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Nederland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Nederlandse Antillen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'Nieuw-Caledonië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'Nieuw-Zeeland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nicaragua');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Niger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nigeria');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Norfolk Island');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'noordelijke Mariana eilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Noorwegen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Oman');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Pakistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'Palestijns');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panama');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papoea-Nieuw-Guinea');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Peru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Filippijnen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Pitcairn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Polen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Portugal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Puerto Rico');
            $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Qatar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Bijeenkomst');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Roemenië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Russische Federatie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Rwanda');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Sint-Bartholomeus');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Sint -Helena');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Saint Kitts en Nevis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Saint Lucia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'Sint-Maarten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'Saint Pierre en Miquelon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'Saint Vincent en de Grenadines');
            $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'San Marino');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Sao Tome en Principe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Saoedi-Arabië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Senegal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Servië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Servië en Montenegro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Seychellen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Sierra Leone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Singapore');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Sint Maarten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Slowakije');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Slovenië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Solomon eilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somalië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'Zuid-Afrika');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'Zuid -Georgia en de South Sandwich Islands');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'Zuid Soedan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'Spanje');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Soedan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Surinaam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard en Jan Mayen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Swaziland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Zweden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Zwitserland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'Syrische Arabische Republiek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Taiwan, provincie China');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tadzjikistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tanzania, Verenigde Republiek');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Thailand');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor-Leste');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Gaan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Tokelau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinidad en Tobago');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Tunesië');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Kalkoen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Turkmenistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Turken en Caicos -eilanden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Oeganda');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Oekraïne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'Verenigde Arabische Emiraten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'Verenigd Koninkrijk');
            $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'Verenigde Staten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'Kleine afgelegen eilanden van de Verenigde Staten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Oezbekistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanuatu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Vietnam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Maagdeneilanden, Britten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Maagdeneilanden, VS.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis en Futuna');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Westelijke Sahara');
            $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Jemen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Zambia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbabwe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Geverifieerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Niet geverifieerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Betaal per portemonnee');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'U staat op het punt te upgraden naar een PRO -lid.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'U hebt niet genoeg saldo om te kopen, koop credits.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Betaal door credits');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'U staat op het punt de privéfoto -functie te ontgrendelen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'U staat op het punt de privé -videofunctie te ontgrendelen.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razorpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Log in met LinkedIn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Log in met Okru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'FAQ\'s');
            $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Terugbetaling');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Krijg mobiele apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Begin met importeren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'U bent klaar om te beginnen met import vanuit Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Link uw Instagram -account');
            $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Instagram -importeur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importeren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'Token verlopen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Geïmporteerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Post niet gevonden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'Dit proces kan enige tijd duren, controleer na enkele minuten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'Munten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Uw betaling met behulp van CoinPayments is geannuleerd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Uw betaling met behulp van CoinPayments is goedgekeurd');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'Je hebt al een hangende verzoek, probeer het later opnieuw');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Importeren vanuit Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<H4> 1- Schrijf hier uw gebruiksvoorwaarden. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<H4> 1- Schrijf hier over ons. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<H4> 1- Schrijf hier uw privacybeleid. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<H4> 1- Schrijf hier uw privacy-terugbetaling. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Link Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Nu kunt u uw Instagram -account koppelen aan de naadloze import van uw Instagram -media.');
        } else if ($value == 'french') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'NGENIUS');
            $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'En créant votre compte, vous acceptez nos {termes} & {confidentialité}');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius et Saba');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'Territoire britannique de l\'océan Indien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgarie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Cambodge');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Cameroun');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Canada');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'Cap-Vert');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Îles Caïmans');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'République centrafricaine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Tchad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Chili');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'Chine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'L\'île de noël');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Îles de cocos (keelling)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Colombie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Comores');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Congo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Congo, République démocratique du Congo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'les Îles Cook');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Costa Rica');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote d`ivoire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Croatie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Cuba');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curacao');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Chypre');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'République Tchèque');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Danemark');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Djibouti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'République dominicaine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Equateur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Egypte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'Le Salvador');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Guinée Équatoriale');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Érythrée');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estonie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Ethiopie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Îles Falkland (Malvinas)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Îles Féroé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Fidji');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finlande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'France');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'Guyane Française');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'Polynésie française');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'Territoires du Sud français');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gambie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Géorgie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Allemagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Ghana');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Gibraltar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Grèce');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Groenland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Grenade');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadeloup');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernesey');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Guinée');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Guinée-Bissau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guyane');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haïti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Îles entendus et îles McDonald');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Saint-Siège (État de la ville du Vatican)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hong Kong');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Hongrie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'Islande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'Inde');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Indonésie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Iran (République islamique d');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Irak');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Irlande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'île de Man');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Israël');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Italie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Jamaïque');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Japon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Jersey');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Jordan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Kazakhstan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Kenya');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Corée, République du peuple démocrate de');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Corée, République de');
            $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosovo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Koweit');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Kirghizistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'République démocratique du peuple lao');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Lettonie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Liban');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesotho');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Libéria');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Jamahiriya arabe libyen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Lituanie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Luxembourg');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macao');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Macédoine, ancienne République yougoslave');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagascar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Malaisie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Maldives');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Mali');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Iles Marshall');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Mauritanie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Maurice');
            $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'Mexique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Micronésie, États fédérés de');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldavie, République de');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Monaco');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Mongolie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Monténégro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Maroc');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Mozambique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Myanmar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namibie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Népal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Pays-Bas');
            $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Antilles néerlandaises');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'Nouvelle Calédonie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'Nouvelle-Zélande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nicaragua');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Niger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nigeria');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'l\'ile de Norfolk');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Îles Mariannes du Nord');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Norvège');
            $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Oman');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Pakistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palaos');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'palestinien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panama');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papouasie Nouvelle Guinée');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Pérou');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Philippines');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Pitcairn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Pologne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'le Portugal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Porto Rico');
            $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Qatar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Réunion');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Roumanie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Fédération Russe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Rwanda');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Saint-Barthelemy');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Saint Helena');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Saint-Christophe-et-Niévès');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Sainte-Lucie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'Saint Martin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'Saint-Pierre-et-Miquelon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'Saint-Vincent-et-les-Grenadines');
            $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'Saint Marin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Sao tome et principe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Arabie Saoudite');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Sénégal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Serbie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Serbie et Monténégro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'les Seychelles');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Sierra Leone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Singapour');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'SINT MARATIN');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Slovaquie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Slovènie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'îles Salomon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somalie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'Afrique du Sud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'Géorgie du Sud et îles Sandwich du Sud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'Soudan du sud');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'Espagne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Soudan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Suriname');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard et Jan Mayen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Swaziland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Suède');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Suisse');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'République arabe syrienne');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Taiwan, Province de Chine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tadjikistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tanzanie, République unie de');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Thaïlande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor-Leste');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Aller');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Tokelau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinité-et-Tobago');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Tunisie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Turquie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Turkménistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'îles Turques-et-Caïques');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Ouganda');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Ukraine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'Emirats Arabes Unis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'Royaume-Uni');
            $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'États-Unis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'Îles mineures éloignées des États-Unis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Ouzbékistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanuatu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Viet Nam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Îles vierges, britanniques');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Îles Vierges, États-Unis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis et Futuna');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Sahara occidental');
            $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Yémen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Zambie');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbabwe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Vérifié');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Non vérifié');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coincement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Joom');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Payer par portefeuille');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'Vous êtes sur le point de passer à un membre PRO.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'Vous n\'avez pas assez de solde pour acheter, veuillez acheter des crédits.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Payer par génération de crédits');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'Vous êtes sur le point de débloquer la fonction de photo privée.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'Vous êtes sur le point de débloquer la fonction vidéo privée.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razorpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Se connecter avec LinkedIn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Connectez-vous avec Okru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'FAQ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Rembourser');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Obtenez des applications mobiles');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'applications');
            $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Commencer à importer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'Vous êtes prêt à commencer l\'importation depuis Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Liez votre compte Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Importateur Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importer');
            $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'Jeton expiré');
            $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Importé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Post introuvable');
            $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'Ce processus peut prendre un certain temps, veuillez vérifier après quelques minutes');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'Paiement');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Votre paiement à l\'aide de CoinPayments a été annulé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Votre paiement à l\'aide de CoinPayments a été approuvé');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'Vous avez déjà une demande en attente, veuillez réessayer plus tard');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Importer depuis Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<h4> 1- Écrivez vos conditions d\'utilisation ici. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4> 1- Écrivez votre sur nous ici. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<h4> 1- Écrivez votre politique de confidentialité ici. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<h4> 1- Écrivez votre remboursement de confidentialité ici. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Lier Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Vous pouvez maintenant lier votre compte Instagram à l\'importation transparente de vos médias Instagram.');
        } else if ($value == 'german') {
            $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'Ngenius');
            $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'Durch das Erstellen Ihres Kontos stimmen Sie unseren {Begriffen} & {Privacy} zu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius und Saba');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'Britisches Territorium des Indischen Ozeans');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgarien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Kambodscha');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Kamerun');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Kanada');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'Kap Verde');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Cayman Inseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'Zentralafrikanische Republik');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Tschad');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Chile');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'China');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Weihnachtsinsel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Cocos (Keeling) Inseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Kolumbien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Komoros');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Kongo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Kongo, Demokratische Republik des Kongo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Cookinseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Costa Rica');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote d\'Ivoire');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Kroatien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Kuba');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curacao');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Zypern');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'Tschechische Republik');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Dänemark');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Dschibuti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominica');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'Dominikanische Republik');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Ecuador');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Ägypten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'El Salvador');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Äquatorialguinea');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Eritrea');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Äthiopien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Falklandinseln (Malvinas)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Färöer Inseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Fidschi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finnland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'Frankreich');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'Französisch-Guayana');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'Französisch Polynesien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'Südfranzösische Territorien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gambia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Georgia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Deutschland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Ghana');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Gibraltar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Griechenland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Grönland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Grenada');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadeloupe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernsey');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Guinea');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Guinea-Bissau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guyana');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haiti');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Hörte Island und McDonald Islands');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Heiliger Stadium (Vatikanischen Stadtstaat)');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hongkong');
            $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Ungarn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'Island');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'Indien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Indonesien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Iran, Islamische Republik von');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Irak');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Irland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Isle of Man');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Israel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Italien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Jamaika');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Japan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Jersey');
            $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Jordanien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Kasachstan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Kenia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Korea, demokratische Volksrepublik von');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Korea, Republik von');
            $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosovo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Kuwait');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Kirgisistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'Lao Volks demokratische Republik');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Lettland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Libanon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesotho');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Liberia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Libyan arabischer Jamahiriya');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Litauen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Luxemburg');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macao');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Mazedonien, die ehemalige jugoslawische Republik von');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagaskar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Malaysia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Malediven');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Mali');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malta');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Marshallinseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinique');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Mauretanien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Mauritius');
            $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'Mexiko');
            $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Mikronesien, Föderierte Zustände von');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldawien, Republik von');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Monaco');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Mongolei');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Montenegro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Marokko');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Mosambik');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Myanmar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namibia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Nepal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Niederlande');
            $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Niederlande Antillen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'Neu-Kaledonien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'Neuseeland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nicaragua');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Niger');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nigeria');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Norfolkinsel');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Nördliche Marianneninseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Norwegen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Oman');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Pakistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'palästinensisch');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panama');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papua Neu-Guinea');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Peru');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Philippinen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Pitcairn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Polen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Portugal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Puerto Rico');
            $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Katar');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Wiedervereinigung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Rumänien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Russische Föderation');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Ruanda');
            $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Heiliger Barthelemy');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Saint Helena');
            $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'St. Kitts und Nevis');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Heiliger Lucia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'Sankt Martin');
            $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'Saint Pierre und Miquelon');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'St. Vincent und die Grenadinen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'San Marino');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Sao Tome und Principe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Saudi Arabien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Senegal');
            $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Serbien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Serbien und Montenegro');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Seychellen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Sierra Leone');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Singapur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Sint Maarten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Slowakei');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Slowenien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Salomon-Inseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somalia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'Südafrika');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'Süd-Georgien und die südlichen Sandwich-Inseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'Südsudan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'Spanien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Sudan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Suriname');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard und Jan Mayen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Swasiland');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Schweden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Schweiz');
            $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'Syrische Arabische Republik');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Taiwan, Provinz Chinas');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tadschikistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tansania, Vereinigte Republik von');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Thailand');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor-Leste');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Gehen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'ToKelau');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinidad und Tobago');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Tunesien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Truthahn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Turkmenistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Türken und Caicos -Inseln');
            $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Uganda');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Ukraine');
            $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'Vereinigte Arabische Emirate');
            $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'Großbritannien');
            $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'Vereinigte Staaten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'United States Minor Outlying Islands');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Usbekistan');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanuatu');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Vietnam');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Virgin Inseln, Britisch');
            $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Jungferninseln, USA');
            $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis und Futuna');
            $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Westsahara');
            $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Jemen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Sambia');
            $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbabwe');
            $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verifiziert');
            $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Unbestätigt');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
            $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Zahlen Sie nach Brieftasche');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'Sie stehen kurz vor dem Upgrade auf ein Pro -Mitglied.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'Sie haben nicht genügend Guthaben zum Kauf, bitte kaufen Sie Credits.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Zahlen Sie durch Gutschriften');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'Sie sind dabei, private Fotofunktionen freizuschalten.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'Sie sind dabei, private Videofunktionen freizuschalten.');
            $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razorpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Login mit LinkedIn');
            $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Melden Sie sich mit OKRU an');
            $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'FAQs');
            $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Erstattung');
            $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Holen Sie sich mobile Apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Apps');
            $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Importieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'Sie sind bereit, von Instagram aus zu importieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Verknüpfen Sie Ihr Instagram -Konto');
            $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Instagram -Importeur');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importieren');
            $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'Token lief ab');
            $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Importiert');
            $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Post nicht gefunden');
            $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Album');
            $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'Dieser Vorgang kann einige Zeit dauern. Bitte überprüfen Sie nach ein paar Minuten');
            $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'Münzen');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Ihre Zahlung mit Coinpayments wurde storniert');
            $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Ihre Zahlung mit Coinpayments wurde genehmigt');
            $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'Sie haben bereits eine anhängige Anfrage. Bitte versuchen Sie es später erneut');
            $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Importieren von Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<h4> 1- Schreiben Sie hier Ihre Nutzungsbedingungen. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4> 1- Schreiben Sie hier über uns. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<h4> 1- Schreiben Sie hier Ihre Datenschutzrichtlinie. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<h4> 1- Schreiben Sie hier Ihre Datenschutz-Rückerstattung. </h4>
        ');
            $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Link Instagram');
            $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Jetzt können Sie Ihr Instagram -Konto mit dem nahtlosen Import Ihrer Instagram -Medien verknüpfen.');
        } else if ($value == 'italian') {
          $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'Ngenius');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'Creando il tuo account, accetti i nostri {Termini} & {Privacy}');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius e Saba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'Territorio britannico dell\'Oceano Indiano');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgaria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Cambogia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Camerun');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Canada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'capo Verde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Isole Cayman');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'Repubblica centrale africana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Chad');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Chile');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'Cina');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Isola di Natale');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Isole Cocos (Keeling)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Colombia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'COMOROS');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Congo, Repubblica democratica del Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Isole Cook');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Costa Rica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote D`ivoire');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Croazia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Cuba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curacao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Cipro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'Repubblica Ceca');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Danimarca');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Djibouti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'Repubblica Dominicana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Ecuador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Egitto');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'El Salvador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Guinea Equatoriale');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Eritrea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Etiopia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Isole Falkland (Malvinas)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Isole Faroe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Figi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finlandia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'Francia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'Guiana francese');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'Polinesia francese');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'Territori della Francia del sud');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gambia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Georgia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Germania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Ghana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Gibilterra');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Grecia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Groenlandia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Grenada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadeloupe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernsey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Guinea-Bissau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guyana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haiti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Ho sentito le isole dell\'isola e McDonald');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Santa Sede (Stato della città del Vaticano)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hong Kong');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Ungheria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'Islanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'India');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Indonesia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Iran (Repubblica Islamica del');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Iraq');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Irlanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Isola di Man');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Israele');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Italia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Giamaica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Giappone');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Maglia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Giordania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Kazakistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Kenya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Corea, Repubblica popolare democratica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Corea, Repubblica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosovo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Kuwait');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Kirghizistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'Repubblica democratica del popolo di Lao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Lettonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Libano');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesotho');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Liberia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Jamahiriya arabo libico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Lituania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Lussemburgo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Macedonia, ex repubblica jugoslava di');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagascar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Malaysia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Maldive');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Mali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malta');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Isole Marshall');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Mauritania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Mauritius');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'Messico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Micronesia, stati federati di');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldavia, Repubblica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Monaco');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Mongolia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Marocco');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Mozambico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Myanmar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namibia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Nepal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Olanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Antille Olandesi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'Nuova Caledonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'Nuova Zelanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nicaragua');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Niger');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nigeria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Norfolk Island');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Isole Marianne settentrionali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Norvegia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Oman');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Pakistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'palestinese');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panama');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papua Nuova Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Perù');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Filippine');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Pitcairn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Polonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Portogallo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Puerto Rico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Qatar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Riunione');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Romania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Federazione Russa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Ruanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Saint Barthelemy');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Saint Helena');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Saint Kitts e Nevis');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Santa Lucia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'San Martin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'San Pierre e Miquelon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'Saint Vincent e Grenadines');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'San Marino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Sao Tome e Principe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Arabia Saudita');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Senegal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Serbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Serbia e Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Seychelles');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Sierra Leone');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Singapore');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Sint Maarten');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Slovacchia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Slovenia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Isole Salomone');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somalia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'Sud Africa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'South Georgia e South Sandwich Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'Sudan del Sud');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'Spagna');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Sudan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Suriname');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard e Jan Mayen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Swaziland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Svezia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Svizzera');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'Repubblica Araba Siriana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Taiwan, provincia cinese');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tajikistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tanzania, Repubblica unita');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Tailandia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor Est');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Andare');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Tokelau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinidad e Tobago');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Tunisia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Tacchino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Turkmenistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Isole Turks e Caicos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Uganda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Ucraina');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'Emirati Arabi Uniti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'Regno Unito');
          $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'stati Uniti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'Isole periferiche minori degli Stati Uniti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Uzbekistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanuatu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Viet Nam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Isole Vergini, britanniche');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Isole Vergini, Stati Uniti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis e Futuna');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Sahara occidentale');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Yemen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Zambia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbabwe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verificato');
          $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Non verificato');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
          $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Pagare con il portafoglio');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'Stai per passare a un membro professionista.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'Non hai abbastanza equilibrio per l\'acquisto, per favore acquista crediti.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Paga per crediti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'Stai per sbloccare la funzione fotografica privata.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'Stai per sbloccare la funzione video privata.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razorpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Accedi con LinkedIn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Accedi con Okru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'FAQ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Rimborso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Ottieni app mobili');
          $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'App');
          $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Inizia a importare');
          $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'Sei pronto per iniziare l\'importazione da Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Collega il tuo account Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Importatore di Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importare');
          $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'Token è scaduto');
          $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Importato');
          $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Post non trovato');
          $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Album');
          $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'Questo processo potrebbe richiedere un po \'di tempo, controlla dopo pochi minuti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'Cenpature');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Il pagamento utilizzando i monitorali è stato annullato');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Il pagamento utilizzando i monitorali è stato approvato');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'Hai già una richiesta in sospeso, riprova più tardi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Importa da Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<h4> 1- Scrivi i tuoi termini di utilizzo qui. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4> 1- Scrivi il tuo su di noi qui. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<h4> 1- Scrivi la tua politica sulla privacy qui. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<h4> 1- Scrivi qui il rimborso della privacy. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Link Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Ora puoi collegare il tuo account Instagram all\'importazione senza soluzione di continuità del tuo media Instagram.');
        } else if ($value == 'portuguese') {
          $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'NGENIUS');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'Ao criar sua conta, você concorda com nossos {termos} & {privacidade}');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius e Saba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'Território do Oceano Índico Britânico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgária');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Camboja');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Camarões');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Canadá');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'cabo Verde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Ilhas Cayman');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'República da África Central');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Chade');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Chile');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'China');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Ilha do Natal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Ilhas Cocos (Keeling)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Colômbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Comores');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Congo, República Democrática do Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Ilhas Cook');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Costa Rica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote d\'ivoire');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Croácia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Cuba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curaçao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Chipre');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'República Checa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Dinamarca');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Djibuti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'República Dominicana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Equador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Egito');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'El Salvador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Guiné Equatorial');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Eritreia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estônia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Etiópia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Ilhas Falkland (Malvinas)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'ilhas Faroe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Fiji');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finlândia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'França');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'Guiana Francesa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'Polinésia Francesa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'Territórios do Sul da França');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gâmbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Geórgia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Alemanha');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Gana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Gibraltar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Grécia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Groenlândia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Granada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadalupe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernsey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Guiné');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Guiné-bissau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guiana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haiti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Ouviu a ilha e as ilhas McDonald');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Santa See (Estado da cidade do Vaticano)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hong Kong');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Hungria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'Islândia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'Índia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Indonésia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Irã (Republic Islâmica do Irã');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Iraque');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Irlanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Ilha de Homem');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Israel');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Itália');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Jamaica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Japão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Jersey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Jordânia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Cazaquistão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Quênia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Coréia, República do Povo Democrático de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Republica da Coréia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosovo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Kuwait');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Quirguistão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'República Democrática do Povo do Lao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Letônia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Líbano');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesoto');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Libéria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Jamahiriya árabe da Líbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Lituânia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Luxemburgo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Macedônia, a antiga República Iugoslava de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagáscar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Malásia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Maldivas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Mali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malta');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Ilhas Marshall');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Mauritânia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Maurício');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'México');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Micronésia, estados federados de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldávia, República de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Mônaco');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Mongólia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Marrocos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Moçambique');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Mianmar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namíbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Nepal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Holanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Antilhas Holandesas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'Nova Caledônia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'Nova Zelândia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nicarágua');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Níger');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nigéria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Ilha de Norfolk');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Ilhas do norte da Mariana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Noruega');
          $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Omã');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Paquistão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'palestino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panamá');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papua Nova Guiné');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguai');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Peru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Filipinas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Pitcairn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Polônia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Portugal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Porto Rico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Catar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Reunião');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Romênia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Federação Russa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Ruanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Saint Barthelemy');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Saint Helena');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Saint Kitts e Nevis');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Santa Lúcia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'são Martinho');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'São Pierre e Miquelon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'São Vincent e Granadinas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'San Marino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'São Tomé e Príncipe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Arábia Saudita');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Senegal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Sérvia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Sérvia e Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Seychelles');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Serra Leoa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Cingapura');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Sint Maarten');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Eslováquia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Eslovênia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Ilhas Salomão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somália');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'África do Sul');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'Geórgia do Sul e as Ilhas Sandwich South');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'Sudão do Sul');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'Espanha');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Sudão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Suriname');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard e Jan Mayen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Suazilândia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Suécia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Suíça');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'República Árabe da Síria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Taiwan, província da China');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tajiquistão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tanzânia, República Unida de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Tailândia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor-Leste');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Ir');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Tokelau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinidad e Tobago');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Tunísia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Peru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Turquemenistão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Ilhas Turcas e Caicos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Uganda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Ucrânia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'Emirados Árabes Unidos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'Reino Unido');
          $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'Estados Unidos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'Ilhas Menoras Estados Unidos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguai');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Uzbequistão');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanuatu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Vietnã');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Ilhas Virgens, britânico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Ilhas Virgens, EUA');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis e Futuna');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Saara Ocidental');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Iémen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Zâmbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbábue');
          $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verificado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Não verificado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
          $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Pague por carteira');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'Você está prestes a atualizar para um membro profissional.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'Você não tem saldo suficiente para comprar, compre créditos.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Pagar por créditos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'Você está prestes a desbloquear o recurso de foto privada.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'Você está prestes a desbloquear o recurso de vídeo privado.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razorpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Faça login no LinkedIn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Faça login com Okru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'Perguntas frequentes');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Reembolso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Obtenha aplicativos móveis');
          $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Aplicativos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Comece a importar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'Você está pronto para começar a importar do Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Vincule sua conta do Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Importador do Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'Token expirou');
          $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Importado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Post não encontrado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Álbum');
          $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'Este processo pode levar algum tempo, verifique depois de alguns minutos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'Coinpayments');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Seu pagamento usando moedas foi cancelado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Seu pagamento usando moedas foi aprovado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'Você já tem um pedido pendente, tente novamente mais tarde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Importação do Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<H4> 1- Escreva seus termos de uso aqui. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<H4> 1- Escreva seu sobre nós aqui. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<H4> 1- Escreva sua Política de Privacidade aqui. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<H4> 1- Escreva seu reembolso de privacidade aqui. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Link Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Agora você pode vincular sua conta do Instagram à importação perfeita da sua mídia do Instagram.');
        } else if ($value == 'russian') {
          $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'Нгений');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'Создавая свою учетную запись, вы соглашаетесь с нашими {терминами} & ​​{Privacy}');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius и Saba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'Британская территория Индийского океана');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Бруней-Даруссалам');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Болгария');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Буркина-Фасо');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Бурунди');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Камбоджа');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Камерун');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Канада');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'Кабо-Верде');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Каймановы острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'Центрально-Африканская Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Чад');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Чили');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'Китай');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Остров Рождества');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Кокос (Килинг) Острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Колумбия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Коморос');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Конго');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Конго, Демократическая Республика Конго');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Острова Кука');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Коста -Рика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote D`ivoire');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Хорватия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Куба');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Кюрасао');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Кипр');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'Чешская Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Дания');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Джибути');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Доминика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'Доминиканская Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Эквадор');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Египет');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'Сальвадор');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Экваториальная Гвинея');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Эритрея');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Эстония');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Эфиопия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Фолклендские острова (Мальвинс)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Фарерские острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Фиджи');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Финляндия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'Франция');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'Французская Гвиана');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'Французская Полинезия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'Южные Французские Территории');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Габон');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Гамбия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Грузия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Германия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Гана');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Гибралтар');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Греция');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Гренландия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Гренада');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Гваделупа');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Гуам');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Гватемала');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Гернси');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Гвинея');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Гвинея-Бисау');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Гайана');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Гаити');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Херд острова и острова Макдональдс');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Святой Пресз (штат Ватикан)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Гондурас');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Гонконг');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Венгрия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'Исландия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'Индия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Индонезия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Иран, Исламская Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Ирак');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Ирландия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Остров Мэн');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Израиль');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Италия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Ямайка');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Япония');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Джерси');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Иордания');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Казахстан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Кения');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Кирибати');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Корея, Демократическая Народная Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Корея, Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Косово');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Кувейт');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Кыргизстан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'Лаосная Демократическая Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Латвия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Ливан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Лесото');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Либерия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Ливийская арабская джамахирия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Лихтенштейн');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Литва');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Люксембург');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Макао');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Македония, бывшая Югославская Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Мадагаскар');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Малави');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Малайзия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Мальдивы');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Мали');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Мальта');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Маршалловы острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Мартиника');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Мавритания');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Маврикий');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Майотт');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'Мексика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Микронезия, федеративные состояния');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Молдова, Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Монако');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Монголия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Черногория');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Монтсеррат');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Марокко');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Мозамбик');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Мьянма');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Намибия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Науру');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Непал');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Нидерланды');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Нидерландские Антильские острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'Новая Каледония');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'Новая Зеландия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Никарагуа');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Нигер');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Нигерия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Ниуэ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Остров Норфолк');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Северные Марианские острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Норвегия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Оман');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Пакистан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Палау');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'Палестинский');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Панама');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Папуа - Новая Гвинея');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Парагвай');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Перу');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Филиппины');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Питкэрн');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Польша');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Португалия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Пуэрто-Рико');
          $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Катар');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Воссоединение');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Румыния');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Российская Федерация');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Руанда');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Святой Бартелми');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Святая Елена');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Сент-Китс и Невис');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Сент-Люсия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'Святой Мартин');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'Сент -Пьер и Микелон');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'Святой Винсент и Гренадины');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Самоа');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'Сан -Марино');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Sao Tome и Principe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Саудовская Аравия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Сенегал');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Сербия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Сербия и Черногория');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Сейшельские острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Сьерра-Леоне');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Сингапур');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Синт Мартен');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Словакия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Словения');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Соломоновы острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Сомали');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'Южная Африка');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'Южная Грузия и Южные Сэндвич Острова');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'южный Судан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'Испания');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Шри -Ланка');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Судан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Суринам');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Ширбард и Ян Мейэн');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Свазиленд');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Швеция');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Швейцария');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'Сирийская Арабская Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Тайвань, провинция Китая');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Таджикистан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Танзания, Объединенная Республика');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Таиланд');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Тимор-Лешт');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Идти');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Токелау');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Тонга');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Тринидад и Тобаго');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Тунис');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Турция');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Туркменистан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Турки и острова Кайкос');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Тувалу');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Уганда');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Украина');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'Объединенные Арабские Эмираты');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'объединенное Королевство');
          $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'Соединенные Штаты');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'Малые отдаленные острова США');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Уругвай');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Узбекистан');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Вануату');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Венесуэла');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Вьетнам');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Виргинские острова, британские');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Виргинские острова, США');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Уоллис и Футуна');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Западная Сахара');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Йемен');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Замбия');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Зимбабве');
          $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Проверенный');
          $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Неверный');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
          $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Оплата по кошельку');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'Вы собираетесь перейти к Pro -члену.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'У вас недостаточно баланса для покупки, пожалуйста, купите кредиты.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Оплатить кредитами');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'Вы собираетесь разблокировать частную фотографию.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'Вы собираетесь разблокировать частное видео.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razorpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Войдите с LinkedIn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Войдите с Okru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'Часто задаваемые вопросы');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Возвращать деньги');
          $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Получите мобильные приложения');
          $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Программы');
          $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Начните импортировать');
          $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'Вы готовы начать импорт из Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Свяжите свою учетную запись в Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Импортер Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'импорт');
          $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'Токен истек');
          $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Импортирован');
          $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Пост не найден');
          $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Альбом');
          $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'Этот процесс может занять некоторое время, пожалуйста, проверьте через несколько минут');
          $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Формумо');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'Coinpayments');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Ваш платеж с использованием CoinPayments был отменен');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Ваш платеж с использованием CoinPayments был утвержден');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'У вас уже есть ожидающий запрос, попробуйте еще раз позже');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Импорт из Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<h4> 1- Напишите свои условия использования здесь. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4> 1- Напишите свое о нас здесь. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<h4> 1- Напишите свою политику конфиденциальности здесь. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<h4> 1- Напишите свой возврат конфиденциальности здесь. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Аамарпай');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Ссылка Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Теперь вы можете связать свою учетную запись в Instagram с бесшовным импортом вашего Instagram Media.');
        } else if ($value == 'spanish') {
          $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'Nenio');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'Al crear su cuenta, usted acepta nuestros {Términos} & {privacidad}');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius y Saba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'Territorio Británico del Océano Índico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgaria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Camboya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Camerún');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Canadá');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'Cabo Verde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Islas Caimán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'República Centroafricana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Chad');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Chile');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'Porcelana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Isla de Navidad');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Islas Cocos (Keeling)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Colombia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Comoras');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Congo, República Democrática del Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Islas Cook');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Costa Rica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote d`ivoire');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Croacia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Cuba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curacao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Chipre');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'Republica checa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Dinamarca');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Djibouti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'República Dominicana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Ecuador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Egipto');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'El Salvador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Guinea Ecuatorial');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Eritrea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Etiopía');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Islas Malvinas (Malvinas)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Islas Faroe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Fiji');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finlandia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'Francia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'Guayana Francesa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'Polinesia francés');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'Territorios Franceses del Sur');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabón');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gambia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Georgia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Alemania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Ghana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Gibraltar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Grecia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Groenlandia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Granada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadeloupo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernsey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Guinea-Bissau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guayana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haití');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Escuché Island y Islas McDonald');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Santa Sede (Estado de la Ciudad del Vaticano)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hong Kong');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Hungría');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'Islandia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'India');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Indonesia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Irán (República Islámica de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Irak');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Irlanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Isla del hombre');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Israel');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Italia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Jamaica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Japón');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Jersey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Jordán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Kazajstán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Kenia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Corea, la república del pueblo democrático de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Corea, república de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosovo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Kuwait');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Kirguistán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'República democrática del People de Lao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Letonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Líbano');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesoto');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Liberia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Árabe libio jamahiriya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Lituania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Luxemburgo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Macedonia, la antigua república yugoslava de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagascar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Malasia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Maldivas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Malí');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malta');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Islas Marshall');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Mauritania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Mauricio');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'México');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Micronesia, estados federados de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldavia, República de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Mónaco');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Mongolia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Marruecos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Mozambique');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Myanmar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namibia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Nepal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Países Bajos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Antillas Holandesas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'Nueva Caledonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'Nueva Zelanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nicaragua');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Níger');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nigeria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Isla Norfolk');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Islas Marianas del Norte');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Noruega');
          $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Omán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Pakistán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'palestino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panamá');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papúa Nueva Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Perú');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Filipinas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Pitcairn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Polonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Portugal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Puerto Rico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Katar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Reunión');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Rumania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Federación Rusa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Ruanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'San Barthelemy');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Santa Helena');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Saint Kitts y Nevis');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Santa Lucía');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'San Martín');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'Saint Pierre y Miquelon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'San Vicente y las Granadinas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'San Marino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Santo Tomé y Príncipe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Arabia Saudita');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Senegal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Serbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Serbia y Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Seychelles');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Sierra Leona');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Singapur');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Sint Maarten');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Eslovaquia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Eslovenia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Islas Salomón');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somalia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'Sudáfrica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'Georgia del sur y las islas Sandwich del sur');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'Sudán del Sur');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'España');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Sudán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Surinam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard y Jan Mayen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Swaziland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Suecia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Suiza');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'República Árabe Siria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Taiwan, provincia de China');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tayikistán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tanzania, República Unida de');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Tailandia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor-Leste');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Ir');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Tokelau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinidad y Tobago');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Túnez');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Pavo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Turkmenistán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Islas Turcas y Caicos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Uganda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Ucrania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'Emiratos Árabes Unidos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'Reino Unido');
          $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'Estados Unidos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'Islas menores de los Estados Unidos.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Uzbekistán');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanuatu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Vietnam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Islas Vírgenes, Británica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Islas Vírgenes, EE. UU.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis y Futuna');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Sahara Occidental');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Yemen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Zambia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbabue');
          $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verificado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Inconfirmado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
          $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Pagar por billetera');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'Estás a punto de actualizar a un miembro profesional.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'No tiene suficiente saldo para comprar, por favor compre créditos.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Pagar por créditos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'Estás a punto de desbloquear funciones de fotos privadas.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'Estás a punto de desbloquear la función de video privado.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razonpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Ingresar con LinkedIn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Iniciar sesión con Okru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'Preguntas frecuentes');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Reembolso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Obtener aplicaciones móviles');
          $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Aplicaciones');
          $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Empezar a importar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'Estás listo para comenzar a importar desde Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Enlace su cuenta de Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Importador de Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Importar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'token expirado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Importado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Publicación no encontrada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Álbum');
          $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'Este proceso puede llevar algún tiempo verificar después de unos minutos');
          $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'Municipios');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Su pago utilizando CoinPayments ha sido cancelado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Su pago utilizando CoinPayments ha sido aprobado');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'Ya tiene una solicitud pendiente, intente nuevamente más tarde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Importar desde Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<H4> 1- Escriba sus términos de uso aquí. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4> 1- Escribe tu sobre nosotros aquí. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<H4> 1- Escriba su política de privacidad aquí. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<H4> 1- Escriba su reembolso de privacidad aquí. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Enlace Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Ahora puede vincular su cuenta de Instagram con la importancia perfecta de sus medios de Instagram.');
        } else if ($value == 'turkish') {
          $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'Ngenius');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'Hesabınızı oluşturarak, {terimler} & {Privacy} \'i kabul edersiniz.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius ve Saba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'İngiliz Hint Okyanusu Bölgesi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgaristan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Kamboçya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Kamerun');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Kanada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'Cape Verde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Cayman Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'Orta Afrika Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Çad');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Şili');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'Çin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Noel Adası');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Cocos (Keeling) Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Kolombiya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Komoros');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Kongo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Kongo, Kongo Demokratik Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Cook Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Kosta Rika');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote D`ivoire');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Hırvatistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Küba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curacao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Kıbrıs');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'Çek Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Danimarka');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Djibouti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominika');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'Dominik Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Ekvador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Mısır');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'El Salvador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Ekvator Ginesi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Eritre');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estonya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Etiyopya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Falkland Adaları (Malvinas)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Faroe Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Fiji');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finlandiya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'Fransa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'Fransız Guyanası');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'Fransız Polinezyası');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'Fransız Güney Bölgeleri');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gambiya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Gürcistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Almanya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Gana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Cebelitarık');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Yunanistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Grönland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Grenada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadeloupe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernsey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Gine');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Gine-Bissau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guyana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haiti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Heard Island ve McDonald Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Holy See (Vatikan Şehir Devleti)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hong Kong');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Macaristan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'İzlanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'Hindistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Endonezya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'İran, İslam Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Irak');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'İrlanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Adam Adası');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'İsrail');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'İtalya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Jamaika');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Japonya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Jersey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Ürdün');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Kazakistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Kenya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Kore, Demokratik Halkın Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Kore Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosova');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Kuveyt');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Kırgızistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'Lao Halkının Demokratik Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Letonya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Lübnan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesoto');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Liberya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Libya Arap Jamahiriya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Litvanya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Lüksemburg');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Makedonya, eski Yugoslav Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagaskar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Malezya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Maldivler');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Mali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malta');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Marşal Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinik');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Moritanya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Mauritius');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'Meksika');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Mikronezya, federasyonlu durumlar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldova, Cumhuriyet');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Monako');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Moğolistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Karadağ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Fas');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Mozambik');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Myanmar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namibya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Nepal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Hollanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Hollanda Antilleri');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'Yeni Kaledonya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'Yeni Zelanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nikaragua');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Nijer');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nijerya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Norfolk Adası');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Kuzey Mariana Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Norveç');
          $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Umman');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Pakistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'Filistin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panama');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papua Yeni Gine');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Peru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Filipinler');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Çukur');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Polonya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Portekiz');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Porto Riko');
          $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Katar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Yeniden birleşme');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Romanya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Rusya Federasyonu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Ruanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Saint Barthelemy');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Saint Helena');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Saint Kitts ve Nevis');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Saint Lucia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'Aziz Martin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'Saint Pierre ve Miquelon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'Saint Vincent ve Grenadinler');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'San Marino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Sao tome ve prensip');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Suudi Arabistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Senegal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Sırbistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Sırbistan ve Karadağ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Seyşeller');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Sierra Leone');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Singapur');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Sint Maarten');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Slovakya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Slovenya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Solomon Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'Güney Afrika');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'Güney Georgia ve Güney Sandviç Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'Güney Sudan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'ispanya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Sudan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Surinam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard ve Jan Mayen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Svaziland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'İsveç');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'İsviçre');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'Suriye Arap Cumhuriyeti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Tayvan, Çin\'in bölgesi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tacikistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tanzanya, Birleşik Cumhuriyet');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Tayland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor-Leste');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Gitmek');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Tokelau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinidad ve Tobago');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Tunus');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Türkiye');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Türkmenistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Turks ve Caicos Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Uganda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Ukrayna');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'Birleşik Arap Emirlikleri');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'Birleşik Krallık');
          $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'Amerika Birleşik Devletleri');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'Amerika Birleşik Devletleri Küçük Dış Adaları');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Özbekistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanatu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Viet Nam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Virgin Adaları, İngiliz');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Virgin Adaları, ABD');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis ve Futuna');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Batı Sahra');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Yemen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Zambiya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbabve');
          $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Doğrulanmış');
          $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Doğrulanmamış');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Paraya bakan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Cüzdanla Öde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'Bir profesyonel üyeye yükseltmek üzeresiniz.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'Satın almak için yeterli bakiyeniz yok, lütfen kredi satın alın.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Kredilere göre ödeme');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'Özel fotoğraf özelliğinin kilidini açmak üzeresiniz.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'Özel video özelliğinin kilidini açmak üzeresiniz.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Jilet');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Linkedln ile giriş yap');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Okru ile giriş yapın');
          $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'SSS');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Geri ödeme');
          $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Mobil Uygulamalar Alın');
          $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Uygulamalar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'İçe Aktarmaya Başlayın');
          $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'Instagram\'dan ithalat başlatmaya hazırsınız');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Instagram hesabınızı bağlayın');
          $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Instagram İthalatçısı');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'İçe aktarmak');
          $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'Token süresi doldu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'İthal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Gönderi bulunamadı');
          $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Albüm');
          $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'Bu işlem biraz zaman alabilir lütfen birkaç dakika sonra kontrol edin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'Madeni para');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Coinpayments kullanarak ödemeniz iptal edildi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Coinpayments kullanarak ödemeniz onaylandı');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'Zaten bekleyen bir isteğiniz var, lütfen daha sonra tekrar deneyin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Instagram\'dan İthalat');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<h4> 1- Kullanım Koşullarınızı buraya yazın. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4> 1- Bizim hakkımızda buraya yazın. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<h4> 1- Gizlilik politikanızı buraya yazın. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<h4> 1- Gizlilik geri ödemenizi buraya yazın. </h4>
      ');
          $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Bağlantı Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Artık Instagram hesabınızı Instagram Medya\'nızın kesintisiz ithalatına bağlayabilirsiniz.');
        } else if ($value == 'english') {
          $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'Ngenius');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'By creating your account, you agree to our {terms} & {privacy}');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius and Saba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'British Indian Ocean Territory');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgaria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Cambodia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Cameroon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Canada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'Cape Verde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Cayman Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'Central African Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Chad');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Chile');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'China');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Christmas Island');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Cocos (Keeling) Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Colombia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Comoros');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Congo, Democratic Republic of the Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Cook Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Costa Rica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote D`Ivoire');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Croatia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Cuba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curacao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Cyprus');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'Czech Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Denmark');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Djibouti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'Dominican Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Ecuador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Egypt');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'El Salvador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Equatorial Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Eritrea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Ethiopia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Falkland Islands (Malvinas)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Faroe Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Fiji');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'France');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'French Guiana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'French Polynesia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'French Southern Territories');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gambia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Georgia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Germany');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Ghana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Gibraltar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Greece');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Greenland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Grenada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadeloupe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernsey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Guinea-Bissau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guyana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haiti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Heard Island and Mcdonald Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Holy See (Vatican City State)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hong Kong');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Hungary');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'Iceland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'India');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Indonesia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Iran, Islamic Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Iraq');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Ireland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Isle of Man');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Israel');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Italy');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Jamaica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Japan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Jersey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Jordan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Kazakhstan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Kenya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Korea, Democratic People`s Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Korea, Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosovo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Kuwait');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Kyrgyzstan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'Lao People`s Democratic Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Latvia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Lebanon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesotho');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Liberia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Libyan Arab Jamahiriya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Lithuania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Luxembourg');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Macedonia, the Former Yugoslav Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagascar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Malaysia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Maldives');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Mali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malta');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Marshall Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinique');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Mauritania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Mauritius');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'Mexico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Micronesia, Federated States of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldova, Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Monaco');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Mongolia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Morocco');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Mozambique');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Myanmar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namibia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Nepal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Netherlands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Netherlands Antilles');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'New Caledonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'New Zealand');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nicaragua');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Niger');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nigeria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Norfolk Island');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Northern Mariana Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Norway');
          $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Oman');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Pakistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'Palestinian');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panama');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papua New Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Peru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Philippines');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Pitcairn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Poland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Portugal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Puerto Rico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Qatar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Reunion');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Romania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Russian Federation');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Rwanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Saint Barthelemy');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Saint Helena');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Saint Kitts and Nevis');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Saint Lucia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'Saint Martin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'Saint Pierre and Miquelon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'Saint Vincent and the Grenadines');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'San Marino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Sao Tome and Principe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Saudi Arabia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Senegal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Serbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Serbia and Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Seychelles');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Sierra Leone');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Singapore');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Sint Maarten');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Slovakia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Slovenia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Solomon Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somalia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'South Africa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'South Georgia and the South Sandwich Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'South Sudan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'Spain');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Sudan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Suriname');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard and Jan Mayen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Swaziland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Sweden');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Switzerland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'Syrian Arab Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Taiwan, Province of China');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tajikistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tanzania, United Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Thailand');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor-Leste');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Togo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Tokelau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinidad and Tobago');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Tunisia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Turkey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Turkmenistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Turks and Caicos Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Uganda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Ukraine');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'United Arab Emirates');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'United Kingdom');
          $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'United States');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'United States Minor Outlying Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Uzbekistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanuatu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Viet Nam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Virgin Islands, British');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Virgin Islands, U.s.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis and Futuna');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Western Sahara');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Yemen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Zambia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbabwe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verified');
          $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Unverified');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
          $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Pay By Wallet');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'You are about to upgrade to a PRO memeber.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'You don&#039;t have enough balance to purchase, please buy credits.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Pay By Credits');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'You are about to unlock private photo feature.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'You are about to unlock private video feature.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razorpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Login with linkedin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Login with OkRu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'FAQs');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Refund');
          $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Get Mobile Apps');
          $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Apps');
          $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Start Importing');
          $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'You are ready to start import from instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Link your instagram account');
          $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Instagram Importer');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Import');
          $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'token expired');
          $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Imported');
          $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Post not found');
          $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Album');
          $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'This process may take some time please check after few minutes');
          $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'CoinPayments');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Your payment using CoinPayments has been canceled');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Your payment using CoinPayments has been approved');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'You already have a pending request , Please try again later');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Import From Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<h4>1- Write your Terms Of Use here.</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliqu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4>1- Write your About us here.</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliquip e');
          $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<h4>1- Write your Privacy Policy here.</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut ali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<h4>1- Write your Privacy Refund here.</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut ali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Link Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Now you can link your Instagram account to the seamless import of your Instagram media.');
        } else if ($value != 'english') {
          $lang_update_queries[] = PT_UpdateLangs($value, 'ngenius', 'Ngenius');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_register_text', 'By creating your account, you agree to our {terms} & {privacy}');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BQ', 'Bonaire, Sint Eustatius and Saba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IO', 'British Indian Ocean Territory');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BN', 'Brunei Darussalam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BG', 'Bulgaria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BF', 'Burkina Faso');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BI', 'Burundi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KH', 'Cambodia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CM', 'Cameroon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CA', 'Canada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CV', 'Cape Verde');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KY', 'Cayman Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CF', 'Central African Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TD', 'Chad');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CL', 'Chile');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CN', 'China');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CX', 'Christmas Island');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CC', 'Cocos (Keeling) Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CO', 'Colombia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KM', 'Comoros');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CG', 'Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CD', 'Congo, Democratic Republic of the Congo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CK', 'Cook Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CR', 'Costa Rica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CI', 'Cote D`Ivoire');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HR', 'Croatia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CU', 'Cuba');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CW', 'Curacao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CY', 'Cyprus');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CZ', 'Czech Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DK', 'Denmark');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DJ', 'Djibouti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DM', 'Dominica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DO', 'Dominican Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EC', 'Ecuador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EG', 'Egypt');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SV', 'El Salvador');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GQ', 'Equatorial Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ER', 'Eritrea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EE', 'Estonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ET', 'Ethiopia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FK', 'Falkland Islands (Malvinas)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FO', 'Faroe Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FJ', 'Fiji');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FI', 'Finland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FR', 'France');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GF', 'French Guiana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PF', 'French Polynesia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TF', 'French Southern Territories');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GA', 'Gabon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GM', 'Gambia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GE', 'Georgia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'DE', 'Germany');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GH', 'Ghana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GI', 'Gibraltar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GR', 'Greece');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GL', 'Greenland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GD', 'Grenada');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GP', 'Guadeloupe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GU', 'Guam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GT', 'Guatemala');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GG', 'Guernsey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GN', 'Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GW', 'Guinea-Bissau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GY', 'Guyana');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HT', 'Haiti');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HM', 'Heard Island and Mcdonald Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VA', 'Holy See (Vatican City State)');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HN', 'Honduras');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HK', 'Hong Kong');
          $lang_update_queries[] = PT_UpdateLangs($value, 'HU', 'Hungary');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IS', 'Iceland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IN', 'India');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ID', 'Indonesia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IR', 'Iran, Islamic Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IQ', 'Iraq');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IE', 'Ireland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IM', 'Isle of Man');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IL', 'Israel');
          $lang_update_queries[] = PT_UpdateLangs($value, 'IT', 'Italy');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JM', 'Jamaica');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JP', 'Japan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JE', 'Jersey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'JO', 'Jordan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KZ', 'Kazakhstan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KE', 'Kenya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KI', 'Kiribati');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KP', 'Korea, Democratic People`s Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KR', 'Korea, Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'XK', 'Kosovo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KW', 'Kuwait');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KG', 'Kyrgyzstan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LA', 'Lao People`s Democratic Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LV', 'Latvia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LB', 'Lebanon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LS', 'Lesotho');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LR', 'Liberia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LY', 'Libyan Arab Jamahiriya');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LI', 'Liechtenstein');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LT', 'Lithuania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LU', 'Luxembourg');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MO', 'Macao');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MK', 'Macedonia, the Former Yugoslav Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MG', 'Madagascar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MW', 'Malawi');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MY', 'Malaysia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MV', 'Maldives');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ML', 'Mali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MT', 'Malta');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MH', 'Marshall Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MQ', 'Martinique');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MR', 'Mauritania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MU', 'Mauritius');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YT', 'Mayotte');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MX', 'Mexico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'FM', 'Micronesia, Federated States of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MD', 'Moldova, Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MC', 'Monaco');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MN', 'Mongolia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ME', 'Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MS', 'Montserrat');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MA', 'Morocco');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MZ', 'Mozambique');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MM', 'Myanmar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NA', 'Namibia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NR', 'Nauru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NP', 'Nepal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NL', 'Netherlands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AN', 'Netherlands Antilles');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NC', 'New Caledonia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NZ', 'New Zealand');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NI', 'Nicaragua');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NE', 'Niger');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NG', 'Nigeria');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NU', 'Niue');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NF', 'Norfolk Island');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MP', 'Northern Mariana Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'NO', 'Norway');
          $lang_update_queries[] = PT_UpdateLangs($value, 'OM', 'Oman');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PK', 'Pakistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PW', 'Palau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PS', 'Palestinian');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PA', 'Panama');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PG', 'Papua New Guinea');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PY', 'Paraguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PE', 'Peru');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PH', 'Philippines');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PN', 'Pitcairn');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PL', 'Poland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PT', 'Portugal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PR', 'Puerto Rico');
          $lang_update_queries[] = PT_UpdateLangs($value, 'QA', 'Qatar');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RE', 'Reunion');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RO', 'Romania');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RU', 'Russian Federation');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RW', 'Rwanda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'BL', 'Saint Barthelemy');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SH', 'Saint Helena');
          $lang_update_queries[] = PT_UpdateLangs($value, 'KN', 'Saint Kitts and Nevis');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LC', 'Saint Lucia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'MF', 'Saint Martin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'PM', 'Saint Pierre and Miquelon');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VC', 'Saint Vincent and the Grenadines');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WS', 'Samoa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SM', 'San Marino');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ST', 'Sao Tome and Principe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SA', 'Saudi Arabia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SN', 'Senegal');
          $lang_update_queries[] = PT_UpdateLangs($value, 'RS', 'Serbia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CS', 'Serbia and Montenegro');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SC', 'Seychelles');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SL', 'Sierra Leone');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SG', 'Singapore');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SX', 'Sint Maarten');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SK', 'Slovakia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SI', 'Slovenia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SB', 'Solomon Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SO', 'Somalia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZA', 'South Africa');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GS', 'South Georgia and the South Sandwich Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SS', 'South Sudan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ES', 'Spain');
          $lang_update_queries[] = PT_UpdateLangs($value, 'LK', 'Sri Lanka');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SD', 'Sudan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SR', 'Suriname');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SJ', 'Svalbard and Jan Mayen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SZ', 'Swaziland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SE', 'Sweden');
          $lang_update_queries[] = PT_UpdateLangs($value, 'CH', 'Switzerland');
          $lang_update_queries[] = PT_UpdateLangs($value, 'SY', 'Syrian Arab Republic');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TW', 'Taiwan, Province of China');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TJ', 'Tajikistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TZ', 'Tanzania, United Republic of');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TH', 'Thailand');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TL', 'Timor-Leste');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TG', 'Togo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TK', 'Tokelau');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TO', 'Tonga');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TT', 'Trinidad and Tobago');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TN', 'Tunisia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TR', 'Turkey');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TM', 'Turkmenistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TC', 'Turks and Caicos Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'TV', 'Tuvalu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UG', 'Uganda');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UA', 'Ukraine');
          $lang_update_queries[] = PT_UpdateLangs($value, 'AE', 'United Arab Emirates');
          $lang_update_queries[] = PT_UpdateLangs($value, 'GB', 'United Kingdom');
          $lang_update_queries[] = PT_UpdateLangs($value, 'US', 'United States');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UM', 'United States Minor Outlying Islands');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UY', 'Uruguay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'UZ', 'Uzbekistan');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VU', 'Vanuatu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VE', 'Venezuela');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VN', 'Viet Nam');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VG', 'Virgin Islands, British');
          $lang_update_queries[] = PT_UpdateLangs($value, 'VI', 'Virgin Islands, U.s.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'WF', 'Wallis and Futuna');
          $lang_update_queries[] = PT_UpdateLangs($value, 'EH', 'Western Sahara');
          $lang_update_queries[] = PT_UpdateLangs($value, 'YE', 'Yemen');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZM', 'Zambia');
          $lang_update_queries[] = PT_UpdateLangs($value, 'ZW', 'Zimbabwe');
          $lang_update_queries[] = PT_UpdateLangs($value, 'verified', 'Verified');
          $lang_update_queries[] = PT_UpdateLangs($value, 'unverified', 'Unverified');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinbase', 'Coinbase');
          $lang_update_queries[] = PT_UpdateLangs($value, 'yoomoney', 'Yoomoney');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_wallet', 'Pay By Wallet');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_upgrade', 'You are about to upgrade to a PRO memeber.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'please_top_up_credits', 'You don&#039;t have enough balance to purchase, please buy credits.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_from_credits', 'Pay By Credits');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_photo', 'You are about to unlock private photo feature.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pay_to_unlock_private_video', 'You are about to unlock private video feature.');
          $lang_update_queries[] = PT_UpdateLangs($value, 'razorpay', 'Razorpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_linkedin', 'Login with linkedin');
          $lang_update_queries[] = PT_UpdateLangs($value, 'login_with_okru', 'Login with OkRu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'faqs', 'FAQs');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund', 'Refund');
          $lang_update_queries[] = PT_UpdateLangs($value, 'get_mobile_apps', 'Get Mobile Apps');
          $lang_update_queries[] = PT_UpdateLangs($value, 'apps', 'Apps');
          $lang_update_queries[] = PT_UpdateLangs($value, 'start_import', 'Start Importing');
          $lang_update_queries[] = PT_UpdateLangs($value, 'you_are_ready_to_import_from', 'You are ready to start import from instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_instagram_account', 'Link your instagram account');
          $lang_update_queries[] = PT_UpdateLangs($value, 'instagram_importer', 'Instagram Importer');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import', 'Import');
          $lang_update_queries[] = PT_UpdateLangs($value, 'token_expired', 'token expired');
          $lang_update_queries[] = PT_UpdateLangs($value, 'imported', 'Imported');
          $lang_update_queries[] = PT_UpdateLangs($value, 'post_not_found', 'Post not found');
          $lang_update_queries[] = PT_UpdateLangs($value, 'album', 'Album');
          $lang_update_queries[] = PT_UpdateLangs($value, 'check_after_some', 'This process may take some time please check after few minutes');
          $lang_update_queries[] = PT_UpdateLangs($value, 'fortumo', 'Fortumo');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments', 'CoinPayments');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_canceled', 'Your payment using CoinPayments has been canceled');
          $lang_update_queries[] = PT_UpdateLangs($value, 'coinpayments_approved', 'Your payment using CoinPayments has been approved');
          $lang_update_queries[] = PT_UpdateLangs($value, 'pending_request_please_try', 'You already have a pending request , Please try again later');
          $lang_update_queries[] = PT_UpdateLangs($value, 'import_from_instagram', 'Import From Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'terms_of_use_page', '<h4>1- Write your Terms Of Use here.</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliqu');
          $lang_update_queries[] = PT_UpdateLangs($value, 'about_page', '<h4>1- Write your About us here.</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliquip e');
          $lang_update_queries[] = PT_UpdateLangs($value, 'privacy_policy_page', '<h4>1- Write your Privacy Policy here.</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut ali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'refund_terms_page', '<h4>1- Write your Privacy Refund here.</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut ali');
          $lang_update_queries[] = PT_UpdateLangs($value, 'aamarpay', 'Aamarpay');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta', 'Link Instagram');
          $lang_update_queries[] = PT_UpdateLangs($value, 'link_insta_desc', 'Now you can link your Instagram account to the seamless import of your Instagram media.');
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
                     <h2 class="light">Update to v1.6 </span></h2>
                     <div class="setting-well">
                        <h4>Changelog</h4>
                        <ul class="wo_update_changelog">
                          <li>[Added] fortumo payment method.</li>
                          <li>[Added] CoinPayments payment method.</li>
                          <li>[Added] Coinbase payment method. </li>
                          <li>[Added] Aamarpay payment method. </li>
                          <li>[Added] Ngenius payment method. </li>
                          <li>[Added] currency system. </li>
                          <li>[Added] FAQs page. </li>
                          <li>[Added] HTML editor to Admin Panel -> Pages -> Manage Pages.</li>
                          <li>[Added] refund policy page. </li>
                          <li>[Added] moderators system.</li>
                          <li>[Added] linkedin social login. </li>
                          <li>[Added] ok.ru social login. </li>
                          <li>[Added] watermark on posts. </li>
                          <li>[Added] the ability to translate terms pages. </li>
                          <li>[Added] import photos from Instagram. </li>
                          <li>[Added] new APIs. </li>
                          <li>[Added] the ability to filter by country for PRO or free memebers</li>
                          <li>[Updated] docs: https://docs.quickdatescript.com/ </li>
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
    "UPDATE `options` SET `option_value`= '1.6' WHERE option_name = 'version';",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'filter_by_country', 'PRO', '2021-08-08 15:15:36');",

    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'spaces', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'space_name', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'spaces_key', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'spaces_secret', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'space_region', 'nyc3', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'wasabi_storage', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'wasabi_bucket_name', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'wasabi_access_key', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'wasabi_secret_key', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'wasabi_bucket_region', 'us-east-1', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ftp_upload', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ftp_host', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ftp_username', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ftp_password', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ftp_port', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ftp_path', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ftp_endpoint', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'cloud_upload', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'cloud_bucket_name', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'cloud_file', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'cloud_file_path', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'geo_username', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'filter_by_cities', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'coinbase_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'coinbase_key', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'credit_price', '100', '2021-08-08 15:15:36');",
    "ALTER TABLE `users` ADD `coinbase_hash` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `securionpay_key`, ADD `coinbase_code` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `coinbase_hash`, ADD INDEX (`coinbase_hash`), ADD INDEX (`coinbase_code`);",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'yoomoney_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'yoomoney_wallet_id', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'yoomoney_notifications_secret', '', '2021-08-08 15:15:36');",
    "ALTER TABLE `users` ADD `yoomoney_hash` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `coinbase_code`, ADD INDEX (`yoomoney_hash`);",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'paypal_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'stripe_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'bank_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'paysera_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'razorpay_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'razorpay_key_id', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'razorpay_key_secret', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'OkLogin', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'OkAppId', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'OkAppPublickey', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'OkAppSecretkey', '', '2021-08-08 15:15:36');",
    "ALTER TABLE `users` ADD `qq` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `linkedin`;",
    "ALTER TABLE `users` ADD `wechat` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `linkedin`;",
    "ALTER TABLE `users` ADD `discord` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `linkedin`;",
    "ALTER TABLE `users` ADD `mailru` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `linkedin`;",
    "ALTER TABLE `users` ADD `okru` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `linkedin`;",
    "CREATE TABLE `faqs` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `question` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' , `answer` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , `time` INT(11) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'refund', '                <h4>1- Write your Privacy Policy here.</h4>\n                <p>Lorem ipsum dolor sit amet, consectetur adisdpisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis sdnostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n                <br>\n                <h4>2- Random title</h4>\n                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'native_android_url', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'native_ios_url', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'watermark_system', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'instagram_importer', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'instagram_importer_app_id', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'instagram_importer_app_secret', '', '2021-08-08 15:15:36');",
    "ALTER TABLE `mediafiles` ADD `instagram_post_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' AFTER `is_approved`, ADD INDEX (`instagram_post_id`);",
    "ALTER TABLE `users` ADD `fortumo_hash` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `yoomoney_hash`, ADD INDEX (`fortumo_hash`);",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'fortumo_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'fortumo_service_id', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'coinpayments', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'coinpayments_secret', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'coinpayments_id', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'coinpayments_public_key', '', '2021-08-08 15:15:36');",
    "ALTER TABLE `users` ADD `coinpayments_txn_id` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL DEFAULT '' AFTER `yoomoney_hash`, ADD INDEX (`coinpayments_txn_id`);",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'coinpayments_coins', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'coinpayments_coin', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'currency_array', '[\"USD\",\"EUR\",\"JPY\",\"TRY\",\"GBP\",\"RUB\",\"PLN\",\"ILS\",\"BRL\",\"INR\"]', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'currency_symbol_array', '{\"USD\":\"&#36;\",\"EUR\":\"&#8364;\",\"JPY\":\"&#165;\",\"TRY\":\"&#8378;\",\"GBP\":\"&#163;\",\"RUB\":\"&#8381;\",\"PLN\":\"&#122;&#322;\",\"ILS\":\"&#8362;\",\"BRL\":\"&#82;&#36;\",\"INR\":\"&#8377;\"}', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'exchange', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'exchange_update', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'paypal_currency', 'USD', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'stripe_currency', 'USD', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'paystack_currency', 'NGN', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'cashfree_currency', 'INR', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'iyzipay_currency', 'TL', '2021-08-08 15:15:36');",
    "ALTER TABLE `langs` CHANGE COLUMN `english` `english` VARCHAR(999) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci';",
    "ALTER TABLE `langs` CHANGE `arabic` `arabic` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `langs` CHANGE `dutch` `dutch` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `langs` CHANGE `french` `french` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `langs` CHANGE `german` `german` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `langs` CHANGE `italian` `italian` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `langs` CHANGE `portuguese` `portuguese` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `langs` CHANGE `russian` `russian` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `langs` CHANGE `spanish` `spanish` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "ALTER TABLE `langs` CHANGE `turkish` `turkish` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ngenius_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ngenius_api_key', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ngenius_outlet_id', '', '2021-08-08 15:15:36');",
    "ALTER TABLE `users` ADD `ngenius_ref` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `fortumo_hash`, ADD INDEX (`ngenius_ref`);",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'ngenius_mode', 'sandbox', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'aamarpay_payment', '0', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'aamarpay_mode', 'sandbox', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'aamarpay_store_id', '', '2021-08-08 15:15:36');",
    "INSERT INTO `options` (`id`, `option_name`, `option_value`, `created_at`) VALUES (NULL, 'aamarpay_signature_key', '', '2021-08-08 15:15:36');",
    "ALTER TABLE `users` ADD `aamarpay_tran_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `ngenius_ref`, ADD INDEX (`aamarpay_tran_id`);",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ngenius', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'terms_register_text');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'BQ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'BN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'BG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'BF', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'BI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KH', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CV', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KY', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CF', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TD', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CL', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CX', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CC', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CD', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'HR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CU', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CW', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CY', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CZ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'DK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'DJ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'DM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'DO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'EC', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'EG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SV', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GQ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ER', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'EE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ET', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'FK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'FO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'FJ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'FI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'FR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GF', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PF', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TF', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'DE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GH', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GL', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GD', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GP', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GU', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GT', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GW', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GY', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'HT', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'HM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'VA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'HN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'HK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'HU', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ID', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IQ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IL', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'IT', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'JM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'JP', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'JE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'JO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KZ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KP', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'XK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KW', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LV', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LB', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LY', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LT', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LU', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MW', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MY', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MV', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ML', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MT', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MH', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MQ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MU', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'YT', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MX', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'FM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MD', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MC', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ME', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MZ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NP', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NL', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'AN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NC', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NZ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NU', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NF', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MP', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'NO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'OM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PW', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PY', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PH', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PL', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PT', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'QA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'RE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'RO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'RU', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'RW', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'BL', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SH', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'KN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LC', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'MF', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'PM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'VC', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'WS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ST', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'RS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SC', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SL', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SX', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SB', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ZA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SS', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ES', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'LK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SD', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SJ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SZ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'CH', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'SY', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TW', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TJ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TZ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TH', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TL', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TK', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TO', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TT', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TR', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TC', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'TV', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'UG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'UA', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'AE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'GB', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'US', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'UM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'UY', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'UZ', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'VU', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'VE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'VN', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'VG', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'VI', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'WF', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'EH', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'YE', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ZM', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`, `ref`) VALUES (NULL, 'ZW', 'country');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'verified');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'unverified');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'coinbase');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'yoomoney');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay_from_wallet');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay_to_upgrade');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'please_top_up_credits');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay_from_credits');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay_to_unlock_private_photo');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pay_to_unlock_private_video');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'razorpay');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'login_with_linkedin');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'login_with_okru');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'faqs');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'refund');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'get_mobile_apps');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'apps');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'start_import');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'you_are_ready_to_import_from');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'link_instagram_account');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'instagram_importer');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'import');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'token_expired');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'imported');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'post_not_found');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'album');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'check_after_some');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'fortumo');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'coinpayments');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'coinpayments_canceled');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'coinpayments_approved');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'pending_request_please_try');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'import_from_instagram');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'terms_of_use_page');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'about_page');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'privacy_policy_page');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'refund_terms_page');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'ngenius');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'aamarpay');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'link_insta');",
    "INSERT INTO `langs` (`id`, `lang_key`) VALUES (NULL, 'link_insta_desc');",
    "UPDATE `langs` SET `options` = '+93' , `lang_key` = 'AF' WHERE `lang_key` = 'AF%' ;",
    "UPDATE `langs` SET `options` = '+358' , `lang_key` = 'AX' WHERE `lang_key` = 'AX' ;",
    "UPDATE `langs` SET `options` = '+355' , `lang_key` = 'AL' WHERE `lang_key` = 'AL' ;",
    "UPDATE `langs` SET `options` = '+213' , `lang_key` = 'DZ' WHERE `lang_key` = 'DZ' ;",
    "UPDATE `langs` SET `options` = '+1684' , `lang_key` = 'AS' WHERE `lang_key` = 'AS' ;",
    "UPDATE `langs` SET `options` = '+376' , `lang_key` = 'AD' WHERE `lang_key` = 'AD' ;",
    "UPDATE `langs` SET `options` = '+244' , `lang_key` = 'AO' WHERE `lang_key` = 'AO' ;",
    "UPDATE `langs` SET `options` = '+1264' , `lang_key` = 'AI' WHERE `lang_key` = 'AI' ;",
    "UPDATE `langs` SET `options` = '+672' , `lang_key` = 'AQ' WHERE `lang_key` = 'AQ' ;",
    "UPDATE `langs` SET `options` = '+1268' , `lang_key` = 'AG' WHERE `lang_key` = 'AG' ;",
    "UPDATE `langs` SET `options` = '+54' , `lang_key` = 'AR' WHERE `lang_key` = 'AR' ;",
    "UPDATE `langs` SET `options` = '+374' , `lang_key` = 'AM' WHERE `lang_key` = 'AM' ;",
    "UPDATE `langs` SET `options` = '+297' , `lang_key` = 'AW' WHERE `lang_key` = 'AW' ;",
    "UPDATE `langs` SET `options` = '+61' , `lang_key` = 'AU' WHERE `lang_key` = 'AU' ;",
    "UPDATE `langs` SET `options` = '+43' , `lang_key` = 'AT' WHERE `lang_key` = 'AT' ;",
    "UPDATE `langs` SET `options` = '+994' , `lang_key` = 'AZ' WHERE `lang_key` = 'AZ' ;",
    "UPDATE `langs` SET `options` = '+1242' , `lang_key` = 'BS' WHERE `lang_key` = 'BS' ;",
    "UPDATE `langs` SET `options` = '+973' , `lang_key` = 'BH' WHERE `lang_key` = 'BH' ;",
    "UPDATE `langs` SET `options` = '+880' , `lang_key` = 'BD' WHERE `lang_key` = 'BD' ;",
    "UPDATE `langs` SET `options` = '+1246' , `lang_key` = 'BB' WHERE `lang_key` = 'BB' ;",
    "UPDATE `langs` SET `options` = '+375' , `lang_key` = 'BY' WHERE `lang_key` = 'BY' ;",
    "UPDATE `langs` SET `options` = '+32' , `lang_key` = 'BE' WHERE `lang_key` = 'BE' ;",
    "UPDATE `langs` SET `options` = '+501' , `lang_key` = 'BZ' WHERE `lang_key` = 'BZ' ;",
    "UPDATE `langs` SET `options` = '+229' , `lang_key` = 'BJ' WHERE `lang_key` = 'BJ' ;",
    "UPDATE `langs` SET `options` = '+1441' , `lang_key` = 'BM' WHERE `lang_key` = 'BM' ;",
    "UPDATE `langs` SET `options` = '+975' , `lang_key` = 'BT' WHERE `lang_key` = 'BT' ;",
    "UPDATE `langs` SET `options` = '+591' , `lang_key` = 'BO' WHERE `lang_key` = 'BO' ;",
    "UPDATE `langs` SET `options` = '+387' , `lang_key` = 'BA' WHERE `lang_key` = 'BA' ;",
    "UPDATE `langs` SET `options` = '+267' , `lang_key` = 'BW' WHERE `lang_key` = 'BW' ;",
    "UPDATE `langs` SET `options` = '+55' , `lang_key` = 'BV' WHERE `lang_key` = 'BV' ;",
    "UPDATE `langs` SET `options` = '+55' , `lang_key` = 'BR' WHERE `lang_key` = 'BR' ;",

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

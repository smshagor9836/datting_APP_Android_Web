//###############################################################
// Author >> Elin Doughouz 
// Copyright (c) PixelPhoto 15/07/2018 All Right Reserved
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
// Follow me on facebook >> https://www.facebook.com/Elindoughous
//=========================================================
//For the accuracy of the icon and logo, please use this website " http://nsimage.brosteins.com " and add images according to size in folders " mipmap " 

using Android.Graphics;
using QuickDate.Helpers.Model;

namespace QuickDate
{
    internal static class AppSettings
    {
        /// <summary>
        /// Deep Links To App Content
        /// you should add your website without http in the analytic.xml file >> ../values/analytic.xml .. line 5
        /// <string name="ApplicationUrlWeb">quickdatescript.com</string>
        /// </summary> 
        public static readonly string TripleDesAppServiceProvider = "e0faa1883c5959f1579fcf4332c5ea42";

        //Main Settings >>>>>
        //********************************************************* 
        public static string Version = "2.7";
        public static readonly string ApplicationName = "QuickDate";
        public static readonly string DatabaseName = "QuickDate"; 

        //Main Colors >>
        //*********************************************************
        public static readonly string MainColor = "#FF007F"; 
        public static Color TitleTextColor = Color.Black;
        public static Color TitleTextColorDark = Color.White;

        //Language Settings >> http://www.lingoes.net/en/translator/langcode.htm
        //*********************************************************
        public static bool FlowDirectionRightToLeft = true;
        public static string Lang = ""; //Default language ar

        //Notification Settings >>
        //*********************************************************
        public static bool ShowNotification = true;
        public static string OneSignalAppId = "c6d8ecf6-e3b8-4c49-b208-07a23364a6ed";
         
        //Error Report Mode
        //*********************************************************
        public static readonly bool SetApisReportMode = true;
         
        //Add Animation Image User
        //*********************************************************
        public static readonly bool EnableAddAnimationImageUser = false;
         
        //Set Theme Full Screen App
        //*********************************************************
        public static readonly bool EnableFullScreenApp = false;

        //Social Logins >>
        //If you want login with facebook or google you should change id key in the analytic.xml file or AndroidManifest.xml
        //Facebook >> ../values/analytic.xml  
        //Google >> ../Properties/AndroidManifest.xml .. line 42
        //*********************************************************
        public static readonly bool EnableSmartLockForPasswords = false; 

        public static readonly bool ShowFacebookLogin = true;
        public static readonly bool ShowGoogleLogin = true; 
        public static readonly bool ShowWoWonderLogin = true;  
        public static readonly bool ShowSocialLoginAtRegisterScreen = true;
         
        public static readonly string ClientId = "716215768781-1riglii0rihhc9gmp53qad69tt8o2e03.apps.googleusercontent.com";

        public static readonly string AppNameWoWonder = "WoWonder";
        public static readonly string WoWonderDomainUri = "https://demo.wowonder.com";
        public static readonly string WoWonderAppKey = "131c471c8b4edf662dd0ebf7adf3c3d7365838b9";

        //AdMob >> Please add the code ads in the Here and analytic.xml 
        //*********************************************************
        public static readonly ShowAds ShowAds = ShowAds.AllUsers;

        //Three times after entering the ad is displayed
        public static readonly int ShowAdInterstitialCount = 5;
        public static readonly int ShowAdRewardedVideoCount = 5;
        public static int ShowAdNativeCount = 40;
        public static readonly int ShowAdAppOpenCount = 3;

        public static readonly bool ShowAdMobBanner = true;
        public static readonly bool ShowAdMobInterstitial = true;
        public static readonly bool ShowAdMobRewardVideo = true;
        public static readonly bool ShowAdMobNative = true;
        public static readonly bool ShowAdMobAppOpen = true;  
        public static readonly bool ShowAdMobRewardedInterstitial = true; 

        public static readonly string AdInterstitialKey = "ca-app-pub-5135691635931982/6657648824";
        public static readonly string AdRewardVideoKey = "ca-app-pub-5135691635931982/7559666953";
        public static readonly string AdAdMobNativeKey = "ca-app-pub-5135691635931982/2342769069";
        public static readonly string AdAdMobAppOpenKey = "ca-app-pub-5135691635931982/7036343147";  
        public static readonly string AdRewardedInterstitialKey = "ca-app-pub-5135691635931982/9662506481";  
         
        //FaceBook Ads >> Please add the code ad in the Here and analytic.xml 
        //*********************************************************
        public static readonly bool ShowFbBannerAds = false; 
        public static readonly bool ShowFbInterstitialAds = false; 
        public static readonly bool ShowFbRewardVideoAds = false;  
        public static readonly bool ShowFbNativeAds = false; 

        //YOUR_PLACEMENT_ID
        public static readonly string AdsFbBannerKey = "250485588986218_554026418632132"; 
        public static readonly string AdsFbInterstitialKey = "250485588986218_554026125298828";  
        public static readonly string AdsFbRewardVideoKey = "250485588986218_554072818627492";  
        public static readonly string AdsFbNativeKey = "250485588986218_554706301897477";

        //Colony Ads >> Please add the code ad in the Here 
        //*********************************************************  
        public static readonly bool ShowColonyBannerAds = true; 
        public static readonly bool ShowColonyInterstitialAds = false; 
        public static readonly bool ShowColonyRewardAds = false; 

        public static readonly string AdsColonyAppId = "app72922799d6714ded84"; 
        public static readonly string AdsColonyBannerId = "vz294826d94e094cdf98"; 
        public static readonly string AdsColonyInterstitialId = "vz3240d5ada18e4f78b3"; 
        public static readonly string AdsColonyRewardedId = "vza09dafc6975146f3a7"; 

        //########################### 

        //Last_Messages Page >>
        ///********************************************************* 
        public static readonly bool RunSoundControl = true;
        public static readonly int RefreshAppAPiSeconds = 6000; // 6 Seconds

        public static readonly int MessageRequestSpeed = 3000; // 3 Seconds
                  
        //Set Theme Tab
        //********************************************************* 
        public static TabTheme SetTabDarkTheme = TabTheme.Light; 
        public static BackgroundTheme SetBackgroundTheme = BackgroundTheme.Image; 

        //Bypass Web Errors  
        //*********************************************************
        public static readonly bool TurnTrustFailureOnWebException = true;
        public static readonly bool TurnSecurityProtocolType3072On = true;

        //Show custom error reporting page
        public static readonly bool RenderPriorityFastPostLoad = true;

        //Trending 
        //*********************************************************
        public static readonly bool ShowTrending = true; 
         
        public static readonly bool ShowFilterBasic = true;
        public static readonly bool ShowFilterLooks = true;
        public static readonly bool ShowFilterBackground = true;
        public static readonly bool ShowFilterLifestyle = true;
        public static readonly bool ShowFilterMore = true;

        //*********************************************************
        public static readonly bool RegisterEnabled = true; 
        public static readonly bool BlogsEnabled = true; 
        public static readonly bool PeopleILikedEnabled = true; 
        public static readonly bool PeopleIDislikedEnabled = true; 
        public static readonly bool FavoriteEnabled = true; 
       
        //Premium system
        public static bool PremiumSystemEnabled = true;

        //Phone Validation system
        public static readonly bool ValidationEnabled = true;
         
        public static readonly bool CompressImage = false;
        public static readonly int AvatarSize = 60;  
        public static readonly int ImageSize = 200;

        public static readonly bool ShowTextWithSpace = true;

        /// <summary>
        /// JustWhenRegister : You can't change type gender after registering an account
        /// </summary>
        public static readonly UpdateGenderSystem UpdateGenderSystem = UpdateGenderSystem.JustWhenRegister; //#New

        /// <summary>
        /// if notv Enable Friend System ..
        /// you should comment this lines https://prnt.sc/1d2n56g on file notifcation_bar_tabs.xml
        /// you can find this file from  Resources/xml/notifcation_bar_tabs.xml
        /// </summary>
        public static readonly bool EnableFriendSystem = true; 
         
        public static bool ShowWalkTroutPage = true;

        public static readonly bool EnableAppFree = false;

        //Payment System (ShowPaymentCardPage >> Paypal & Stripe ) (ShowLocalBankPage >> Local Bank ) 
        //*********************************************************

        public static readonly PaymentsSystem PaymentsSystem = PaymentsSystem.All;
         
        /// <summary>
        /// Paypal and google pay using Braintree Gateway https://www.braintreepayments.com/
        /// 
        /// Add info keys in Payment Methods : https://prnt.sc/1z5bffc & https://prnt.sc/1z5b0yj
        /// To find your merchant ID :  https://prnt.sc/1z59dy8
        ///
        /// Tokenization Keys : https://prnt.sc/1z59smv
        /// </summary>
        public static readonly bool ShowPaypal = true;
        public static readonly string MerchantAccountId = "test"; 

        public static readonly string SandboxTokenizationKey = "sandbox_kt2f6mdh_hf4ccmn4dfy45******";
        public static readonly string ProductionTokenizationKey = "production_t2wns2y2_dfy45******"; 

        public static readonly bool ShowCreditCard = true;
        public static readonly bool ShowBankTransfer = true;
         
        /// <summary>
        /// if you want this feature enabled go to Properties -> AndroidManefist.xml and remove comments from below code
        /// <uses-permission android:name="com.android.vending.BILLING" />
        /// </summary>
        public static readonly bool ShowInAppBilling = true;


        public static readonly bool ShowCashFree = false;//#New >> will be working on next version 
        /// <summary>
        /// Currencies : http://prntscr.com/u600ok
        /// </summary>
        public static readonly string CashFreeCurrency = "INR";//#New

        /// <summary>
        /// If you want RazorPay you should change id key in the analytic.xml file
        /// razorpay_api_Key >> .. line 28 
        /// </summary>
        public static readonly bool ShowRazorPay = true;//#New 
        /// <summary>
        /// Currencies : https://razorpay.com/accept-international-payments
        /// </summary>
        public static readonly string RazorPayCurrency = "INR";//#New

        public static readonly bool ShowAuthorizeNet = true;//#New
        public static readonly bool ShowSecurionPay = true;//#New
        public static readonly bool ShowIyziPay = true;//#New


        //*********************************************************

        //Settings Page >>  
        //********************************************************* 
        public static readonly bool ShowSettingsAccount = true;  
        public static readonly bool ShowSettingsSocialLinks = true; 
        public static readonly bool ShowSettingsPassword = true; 
        public static readonly bool ShowSettingsBlockedUsers = true; 
        public static readonly bool ShowSettingsDeleteAccount = true; 
        public static readonly bool ShowSettingsTwoFactor = true; 
        public static readonly bool ShowSettingsManageSessions = true;  
        public static readonly bool ShowSettingsWithdrawals = true;  
        public static readonly bool ShowSettingsMyAffiliates = true;  
        public static readonly bool ShowSettingsTransactions = true;  
         
        /// <summary>
        /// if you want this feature enabled go to Properties -> AndroidManefist.xml and remove comments from below code
        /// <uses-permission android:name="android.permission.READ_CONTACTS" />
        /// <uses-permission android:name="android.permission.READ_PHONE_NUMBERS" />
        /// </summary>
        public static readonly bool InvitationSystem = true;

        /// <summary>
        /// On main full filter view screen, reset filter option will available only on the first page by default
        /// If you want to show the reset filter option for all the pages then set "ShowResetFilterForAllPages" as true
        /// </summary>
        public static bool ShowResetFilterForAllPages = false;

        /// <summary>
        /// If want to have limit on messages then set this variable as 'true'
        /// If you set the limit on messages then non pro user will able to send only 5 messages
        /// </summary>
        public static readonly bool ShouldHaveLimitOnMessages = true; 
        public static int MaxMessageLimitForNonProUser = 5;
        //********************************************************* 

        public static readonly bool ShowSettingsRateApp = true; 
        public static readonly int ShowRateAppCount = 5; 

        public static readonly bool ShowSettingsUpdateManagerApp = false; 
         
        public static readonly bool OpenVideoFromApp = true; 
        public static readonly bool OpenImageFromApp = true;

        /// <summary>
        /// true => Only over 18 years old
        /// false => all 
        /// </summary>
        public static readonly bool IsUserYearsOld = true;
         
        //********************************************************* 
        public static readonly bool ShowLive = true;  
        public static readonly string AppIdAgoraLive = "619ee4ec26334d2dae20e52d1abbb32e";  


        //*********************************************************
    }
} 
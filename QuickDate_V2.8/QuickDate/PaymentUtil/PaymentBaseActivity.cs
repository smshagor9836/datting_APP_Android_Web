using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Android.App;
using Android.BillingClient.Api;
using Android.Graphics;
using Android.Widget;
using Com.Razorpay;
using InAppBilling.Lib;
using IyziPay;
using IyziPay.Lib.Model;
using MaterialDialogsCore;
using Newtonsoft.Json;
using QuickDate.Activities.Base;
using QuickDate.Activities.Tabbes;
using QuickDate.Helpers.Controller;
using QuickDate.Helpers.Fonts;
using QuickDate.Helpers.Model;
using QuickDate.Helpers.Utils;
using QuickDate.PaymentGoogle;
using QuickDate.SQLite;
using QuickDateClient;
using QuickDateClient.Classes.Authorization;
using QuickDateClient.Classes.Payments;
using QuickDateClient.Requests;
using SecurionPay;

namespace QuickDate.PaymentUtil
{
    [Activity]
    public class PaymentBaseActivity : BaseActivity, IBillingPaymentListener, IPaymentResultWithDataListener, ISecurionPayPaymentListener, IIyziPayPaymentListener
    {
        public BillingSupport BillingSupport;
        public InitPayPalPayment InitPayPalPayment;
        public InitCashFreePayment CashFreePayment;
        public InitRazorPayPayment InitRazorPay;
        public InitSecurionPayPayment SecurionPayPayment;
        public InitIyziPayPayment IyziPayPayment;

        public string Price, Credits, PayType, Id;
         
        public void InitBuy()
        {
            try
            {
                if (AppSettings.ShowInAppBilling && InitializeQuickDate.IsExtended)
                    BillingSupport = new BillingSupport(this, InAppBillingGoogle.ProductId, AppSettings.TripleDesAppServiceProvider, InAppBillingGoogle.ListProductSku, this);

                if (AppSettings.ShowPaypal)
                    InitPayPalPayment ??= new InitPayPalPayment(this);

                if (AppSettings.ShowRazorPay)
                    InitRazorPay ??= new InitRazorPayPayment(this);

                if (AppSettings.ShowCashFree)
                    CashFreePayment ??= new InitCashFreePayment(this);

                if (AppSettings.ShowSecurionPay)
                    SecurionPayPayment ??= new InitSecurionPayPayment(this, this, ListUtils.SettingsSiteList?.SecurionpayPublicKey);

                if (AppSettings.ShowIyziPay)
                {
                    //GlobalContext.IyziPayPayment ??= new InitIyziPayPayment(Activity, GlobalContext,);
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }


        #region Billing

        public void OnPaymentSuccess(IList<Purchase> result)
        {
            try
            {
                if (!Methods.CheckConnectivity())
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Long)?.Show();
                    return;
                }

                if (PayType == "membership")
                { 
                    PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SetPro("Google InApp") }); 
                }
                else
                {
                    PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SetCredit("Google InApp") });
                }
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        #endregion

        #region Razorpay
         
        public void OnPaymentError(int code, string razorpayPaymentId, PaymentData paymentData)
        {
            try
            {
                Console.WriteLine("razorpay : Payment failed: " + code + " " + paymentData.Data);
                Toast.MakeText(this, "Payment failed: " + paymentData.Data, ToastLength.Long)?.Show();
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public void OnPaymentSuccess(string razorpayPaymentId, PaymentData paymentData)
        {
            try
            {
                Console.WriteLine("razorpay : Payment Successful:" + razorpayPaymentId);
                if (!string.IsNullOrEmpty(razorpayPaymentId) && Methods.CheckConnectivity())
                {
                    //var priceInt = Convert.ToInt32(Price) * 100;
                    if (PayType == "membership")
                    {
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SetPro("razorpay") });
                    }
                    else if (PayType == "credits")
                    {
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SetCredit("razorpay") });

                        //wael add after update  
                        //var (apiStatus, respond) = await RequestsAsync.Payments.TopWalletRazorpayAsync(razorpayPaymentId, paymentData.OrderId, Price);
                        //if (apiStatus == 200)
                        //{
                        //    Toast.MakeText(this, GetText(Resource.String.Lbl_PaymentSuccessfully), ToastLength.Long)?.Show();
                        //}
                        //else
                        //    Methods.DisplayReportResult(this, respond);
                    }
                }
                else if (!string.IsNullOrEmpty(razorpayPaymentId))
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Long)?.Show();
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        #endregion
         
        #region CashFree

        private EditText TxtName, TxtEmail, TxtPhone;
        public void OpenCashFreeDialog()
        {
            try
            {
                var dialog = new MaterialDialog.Builder(this).Theme(QuickDateTools.IsTabDark() ? MaterialDialogsTheme.Dark : MaterialDialogsTheme.Light)
                    .Title(GetText(Resource.String.Lbl_CashFree)).TitleColorRes(Resource.Color.primary)
                    .CustomView(Resource.Layout.CashFreePaymentLayout, true)
                    .PositiveText(GetText(Resource.String.Lbl_PayNow)).OnPositive(async (materialDialog, action) =>
                    {
                        try
                        {
                            if (string.IsNullOrEmpty(TxtName.Text) || string.IsNullOrWhiteSpace(TxtName.Text))
                            {
                                Toast.MakeText(this, GetText(Resource.String.Lbl_PleaseEnterName), ToastLength.Short)?.Show();
                                return;
                            }

                            var check = Methods.FunString.IsEmailValid(TxtEmail.Text.Replace(" ", ""));
                            switch (check)
                            {
                                case false:
                                    Methods.DialogPopup.InvokeAndShowDialog(this, GetText(Resource.String.Lbl_VerificationFailed), GetText(Resource.String.Lbl_IsEmailValid), GetText(Resource.String.Lbl_Ok));
                                    return;
                            }

                            if (string.IsNullOrEmpty(TxtPhone.Text) || string.IsNullOrWhiteSpace(TxtPhone.Text))
                            {
                                Toast.MakeText(this, GetText(Resource.String.Lbl_Please_enter_your_data), ToastLength.Short)?.Show();
                                return;
                            }

                            Toast.MakeText(this, GetText(Resource.String.Lbl_Please_wait), ToastLength.Short)?.Show();

                            await CashFree(TxtName.Text, TxtEmail.Text, TxtPhone.Text);
                        }
                        catch (Exception e)
                        {
                            Methods.DisplayReportResultTrack(e);
                        }
                    })
                    .NegativeText(GetText(Resource.String.Lbl_Close)).OnNegative(new MyMaterialDialog())
                    .Build();

                var iconName = dialog.CustomView.FindViewById<TextView>(Resource.Id.IconName);
                TxtName = dialog.CustomView.FindViewById<EditText>(Resource.Id.NameEditText);

                var iconEmail = dialog.CustomView.FindViewById<TextView>(Resource.Id.IconEmail);
                TxtEmail = dialog.CustomView.FindViewById<EditText>(Resource.Id.EmailEditText);

                var iconPhone = dialog.CustomView.FindViewById<TextView>(Resource.Id.IconPhone);
                TxtPhone = dialog.CustomView.FindViewById<EditText>(Resource.Id.PhoneEditText);

                FontUtils.SetTextViewIcon(FontsIconFrameWork.FontAwesomeLight, iconName, FontAwesomeIcon.User);
                FontUtils.SetTextViewIcon(FontsIconFrameWork.FontAwesomeLight, iconEmail, FontAwesomeIcon.PaperPlane);
                FontUtils.SetTextViewIcon(FontsIconFrameWork.FontAwesomeLight, iconPhone, FontAwesomeIcon.Mobile);

                Methods.SetColorEditText(TxtName, QuickDateTools.IsTabDark() ? Color.White : Color.Black);
                Methods.SetColorEditText(TxtEmail, QuickDateTools.IsTabDark() ? Color.White : Color.Black);
                Methods.SetColorEditText(TxtPhone, QuickDateTools.IsTabDark() ? Color.White : Color.Black);

                var local = ListUtils.MyUserInfo?.FirstOrDefault();
                if (local != null)
                {
                    TxtName.Text = QuickDateTools.GetNameFinal(local);
                    TxtEmail.Text = local.Email;
                    TxtPhone.Text = local.PhoneNumber;
                }

                dialog.Show();
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        private async Task CashFree(string name, string email, string phone)
        {
            try
            {
                if (Methods.CheckConnectivity())
                {
                    var keyValues = new Dictionary<string, string>
                    {
                        {"name", name},
                        {"phone", phone},
                        {"email", email},
                        {"price", Price},
                    };

                    var (apiStatus, respond) = await RequestsAsync.Payments.InitializeCashFreeAsync(AppSettings.CashFreeCurrency, ListUtils.SettingsSiteList?.CashfreeSecretKey ?? "", ListUtils.SettingsSiteList?.CashfreeMode, keyValues);
                    if (apiStatus == 200)
                    {
                        if (respond is CashFreeObject result)
                        {
                            CashFreePayment ??= new InitCashFreePayment(this);
                            CashFreePayment.DisplayCashFreePayment(result, Price);
                        }
                    }
                    else
                        Methods.DisplayReportResult(this, respond);
                }
                else
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Short)?.Show();
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        #endregion
         
        #region SecurionPay

        public async Task SecurionPay()
        {
            try
            {
                if (Methods.CheckConnectivity())
                {
                    var type = PayType == "membership" ? "go_pro" : "credit";
                    var (apiStatus, respond) = await RequestsAsync.Payments.InitializeSecurionPayAsync(type, Price);
                    switch (apiStatus)
                    {
                        case 200:
                            {
                                switch (respond)
                                {
                                    case InitializeSecurionPayObject result:
                                        SecurionPayPayment ??= new InitSecurionPayPayment(this, this, ListUtils.SettingsSiteList?.SecurionpayPublicKey);
                                        SecurionPayPayment.DisplaySecurionPayPayment(result.Token, Price, QuickDateTools.IsTabDark() ? Resource.Style.MyDialogThemeDark : Resource.Style.MyDialogTheme);
                                        break;
                                }

                                break;
                            }
                        default:
                            Methods.DisplayReportResult(this, respond);
                            break;
                    }
                }
                else
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Long)?.Show();
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        private async Task SecurionPay(string request, string charge)
        {
            try
            {
                if (Methods.CheckConnectivity())
                {
                    var (apiStatus, respond) = await RequestsAsync.Payments.SecurionPayAsync(charge);
                    switch (apiStatus)
                    {
                        case 200:
                            Toast.MakeText(this, GetText(Resource.String.Lbl_PaymentSuccessfully), ToastLength.Long)?.Show();

                            break;
                        default:
                            Methods.DisplayReportResult(this, respond);
                            break;
                    }
                }
                else
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Long)?.Show();
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public void OnPaymentError(string error)
        {
            try
            {
                 
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public void OnPaymentSuccess(SecurionPayResult result)
        {
            try
            {
                if (Methods.CheckConnectivity())
                {
                    if (PayType == "membership")
                    {
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SetPro("SecurionPay") });
                    }
                    else
                    {
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SetCredit("SecurionPay") });
                    }

                    //wael add after update  
                    //PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SecurionPay("pay", result.Charge.Id) });
                }
                else
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Short)?.Show();
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        #endregion
         
        #region IyziPay

        public void IyziPay()
        {
            try
            {
                IyziPayPaymentObject request = new IyziPayPaymentObject()
                {
                    Locale = Locale.TR,

                    Id = ListUtils.SettingsSiteList?.IyzipayBuyerId,
                    Name = ListUtils.SettingsSiteList?.IyzipayBuyerName,
                    Surname = ListUtils.SettingsSiteList?.IyzipayBuyerSurname,
                    GsmNumber = ListUtils.SettingsSiteList?.IyzipayBuyerGsmNumber,
                    Email = ListUtils.SettingsSiteList?.IyzipayBuyerEmail,
                    IdentityNumber = ListUtils.SettingsSiteList?.IyzipayIdentityNumber,
                    Address = ListUtils.SettingsSiteList?.IyzipayAddress,
                    City = ListUtils.SettingsSiteList?.IyzipayCity,
                    Country = ListUtils.SettingsSiteList?.IyzipayCountry,
                    Zip = ListUtils.SettingsSiteList?.IyzipayZip,

                    Price = Price,
                    Currency = Currency.TRY,
                    CallbackUrl = InitializeQuickDate.WebsiteUrl + "/aj/iyzipay/success?hash=" + Price,

                    ApiKey = ListUtils.SettingsSiteList?.IyzipayKey,
                    SecretKey = ListUtils.SettingsSiteList?.IyzipaySecretKey,
                    BaseUrl = ListUtils.SettingsSiteList?.IyzipayMode == "0" ? "https://merchant.iyzipay.com/" : "https://sandbox-api.iyzipay.com/"
                };

                IyziPayPayment = new InitIyziPayPayment(this, this, request);
                IyziPayPayment.DisplayIyziPayPayment(Price, QuickDateTools.IsTabDark() ? Resource.Style.MyDialogThemeDark : Resource.Style.MyDialogTheme);
                //string Token = IyziPayPayment.CheckoutFormInitialize?.Token; 
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public void OnIyziPayPaymentSuccess(CheckoutFormInitialize result)
        {
            try
            {
                if (!string.IsNullOrEmpty(result?.Token))
                {
                    if (PayType == "membership")
                    {
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SetPro("IyziPay") });
                    }
                    else
                    {
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => SetCredit("IyziPay") });
                    }

                    //wael add after update 
                    //PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => IyziPay(result.Token) });
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        private async Task IyziPay(string token)
        {
            try
            {
                if (Methods.CheckConnectivity())
                {
                    var priceInt = Convert.ToInt32(Price) * 100;

                    Dictionary<string, string> hashDic = new Dictionary<string, string>
                    {
                        {"userid", UserDetails.UserId.ToString()},
                        {"description", "Top Up Wallet"},
                        {"realprice", Price},
                        {"price", priceInt.ToString()},
                        {"amount", Credits},
                        {"membershipType", Id},
                        {"currency", ListUtils.SettingsSiteList?.IyzipayCurrency ?? "TL"}
                    };

                    var plainTextBytes = Encoding.UTF8.GetBytes(JsonConvert.SerializeObject(hashDic));
                    var hash = Convert.ToBase64String(plainTextBytes);
                     
                    var (apiStatus, respond) = await RequestsAsync.Payments.IyziPaySuccessAsync(hash, token);
                    switch (apiStatus)
                    {
                        case 200:
                            Toast.MakeText(this, GetText(Resource.String.Lbl_PaymentSuccessfully), ToastLength.Long)?.Show();

                            IyziPayPayment.StopIyziPay();
                            break;
                        default:
                            Methods.DisplayReportResult(this, respond);
                            break;
                    }
                }
                else
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Long)?.Show();
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        #endregion
         
        #region Api

        public async Task SetPro(string via)
        {
            if (Methods.CheckConnectivity())
            { 
                var (apiStatus, respond) = await RequestsAsync.Auth.SetProAsync(Id, Price, via);
                if (apiStatus == 200)
                {
                    var dataUser = ListUtils.MyUserInfo?.FirstOrDefault();
                    if (dataUser != null)
                    {
                        dataUser.VerifiedFinal = true;
                        dataUser.IsPro = "1";

                        var sqlEntity = new SqLiteDatabase();
                        sqlEntity.InsertOrUpdate_DataMyInfo(dataUser);
                    }

                    Toast.MakeText(this, GetText(Resource.String.Lbl_SuccessfullyUpgraded), ToastLength.Long)?.Show();
                }
                else Methods.DisplayReportResult(this, respond);
            }
            else
            {
                Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Long)?.Show();
            } 
        }

        public async Task SetCredit(string via)
        {
            if (Methods.CheckConnectivity())
            {
                var (apiStatus, respond) = await RequestsAsync.Auth.SetCreditAsync(Credits, Price, via);
                if (apiStatus == 200)
                {
                    if (respond is SetCreditObject creditObject)
                    {
                        var dataUser = ListUtils.MyUserInfo?.FirstOrDefault();
                        if (dataUser != null)
                        {
                            dataUser.Balance = creditObject.Balance;

                            var sqlEntity = new SqLiteDatabase();
                            sqlEntity.InsertOrUpdate_DataMyInfo(dataUser);
                        }

                        if (HomeActivity.GetInstance().ProfileFragment.WalletNumber != null)
                            HomeActivity.GetInstance().ProfileFragment.WalletNumber.Text = creditObject.Balance.Replace(".00", "");

                        Toast.MakeText(this, GetText(Resource.String.Lbl_PaymentSuccessfully), ToastLength.Long)?.Show();
                    }
                }
                else Methods.DisplayReportResult(this, respond);
            }
            else
            {
                Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Long)?.Show();
            }
        }


        #endregion
    }
}
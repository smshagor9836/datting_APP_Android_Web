using System;
using Android.Content;
using Android.OS;
using Android.Views;
using Android.Widget;
using Google.Android.Material.BottomSheet;
using QuickDate.Activities.Tabbes;
using QuickDate.Helpers.Utils;
using QuickDate.PaymentGoogle;
using QuickDateClient;

namespace QuickDate.PaymentUtil
{
    public class PaymentXBottomSheetDialog : BottomSheetDialogFragment
    {
        #region Variables Basic

        private HomeActivity GlobalContext;
        private ImageView IconClose;
        private LinearLayout GooglePayLayout, PaypalLayout, CreditCardLayout, BankTransferLayout, RazorPayLayout, CashFreeLayout, PayStackLayout, PaySeraLayout;
        private LinearLayout SecurionPayLayout, AuthorizeNetLayout, IyziPayLayout, AamarPayLayout;
          
        private string Price, Credits, PayType, IdPay;

        #endregion

        #region General

        public override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            // Create your fragment here
            GlobalContext = (HomeActivity)Activity;
        }

        public override View OnCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState)
        {
            try
            {
                var contextThemeWrapper = QuickDateTools.IsTabDark() ? new ContextThemeWrapper(Activity, Resource.Style.MyTheme_Dark) : new ContextThemeWrapper(Activity, Resource.Style.MyTheme);

                // clone the inflater using the ContextThemeWrapper

                LayoutInflater localInflater = inflater.CloneInContext(contextThemeWrapper);
                View view = localInflater?.Inflate(Resource.Layout.PaymentXBottomSheetLayout, container, false);

                IdPay = Arguments?.GetString("Id") ?? "";
                Credits = Arguments?.GetString("Credits") ?? "";
                Price = Arguments?.GetString("Price") ?? "";
                PayType = Arguments?.GetString("payType") ?? "";
              
                InitComponent(view);  

                return view;
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
                return null!;
            }
        }

        #endregion

        #region Functions

        private void InitComponent(View view)
        {
            try
            {
                IconClose = view.FindViewById<ImageView>(Resource.Id.iconClose); 
                IconClose.Click += IconCloseOnClick;
                 
                GooglePayLayout = view.FindViewById<LinearLayout>(Resource.Id.GooglePayLayout);
                GooglePayLayout.Click += GooglePayLayoutOnClick;

                PaypalLayout = view.FindViewById<LinearLayout>(Resource.Id.PaypalLayout);
                PaypalLayout.Click += PaypalLayoutOnClick;

                CreditCardLayout = view.FindViewById<LinearLayout>(Resource.Id.CreditCardLayout);
                CreditCardLayout.Click += CreditCardLayoutOnClick;

                BankTransferLayout = view.FindViewById<LinearLayout>(Resource.Id.BankTransferLayout);
                BankTransferLayout.Click += BankTransferLayoutOnClick;

                RazorPayLayout = view.FindViewById<LinearLayout>(Resource.Id.RazorPayLayout);
                RazorPayLayout.Click += RazorPayLayoutOnClick;

                CashFreeLayout = view.FindViewById<LinearLayout>(Resource.Id.CashFreeLayout);
                CashFreeLayout.Click += CashFreeLayoutOnClick;

                PayStackLayout = view.FindViewById<LinearLayout>(Resource.Id.PayStackLayout);
                PayStackLayout.Click += PayStackLayoutOnClick;

                PaySeraLayout = view.FindViewById<LinearLayout>(Resource.Id.PaySeraLayout);
                PaySeraLayout.Click += PaySeraLayoutOnClick;

                SecurionPayLayout = view.FindViewById<LinearLayout>(Resource.Id.SecurionPayLayout);
                SecurionPayLayout.Click += SecurionPayLayoutOnClick;

                AuthorizeNetLayout = view.FindViewById<LinearLayout>(Resource.Id.AuthorizeNetLayout);
                AuthorizeNetLayout.Click += AuthorizeNetLayoutOnClick;

                IyziPayLayout = view.FindViewById<LinearLayout>(Resource.Id.IyziPayLayout);
                IyziPayLayout.Click += IyziPayLayoutOnClick;

                AamarPayLayout = view.FindViewById<LinearLayout>(Resource.Id.AamarPayLayout);
                AamarPayLayout.Click += AamarPayLayoutOnClick;
                  
                if (AppSettings.ShowInAppBilling && InitializeQuickDate.IsExtended && PayType == "membership")
                {
                    GooglePayLayout.Visibility = ViewStates.Visible;
                }
                else
                    GooglePayLayout.Visibility = ViewStates.Gone;

                if (!AppSettings.ShowPaypal) 
                    PaypalLayout.Visibility = ViewStates.Gone;

                if (!AppSettings.ShowCreditCard) 
                    CreditCardLayout.Visibility = ViewStates.Gone;

                if (!AppSettings.ShowBankTransfer) 
                    BankTransferLayout.Visibility = ViewStates.Gone;

                if (!AppSettings.ShowRazorPay) 
                    RazorPayLayout.Visibility = ViewStates.Gone;

                if (!AppSettings.ShowCashFree) 
                    CashFreeLayout.Visibility = ViewStates.Gone;

                if (!AppSettings.ShowSecurionPay) 
                    SecurionPayLayout.Visibility = ViewStates.Gone;

                if (!AppSettings.ShowAuthorizeNet) 
                    AuthorizeNetLayout.Visibility = ViewStates.Gone;

                if (!AppSettings.ShowIyziPay) 
                    IyziPayLayout.Visibility = ViewStates.Gone;

                //wael add after update
                PayStackLayout.Visibility = ViewStates.Gone;
                PaySeraLayout.Visibility = ViewStates.Gone;
                AamarPayLayout.Visibility = ViewStates.Gone;

            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        #endregion

        #region Event

        private void GooglePayLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                string type = "";
                if (PayType == "membership")
                {
                    switch (IdPay)
                    {
                        case "1":
                            type = "membershipweekly";
                            break;
                        case "2":
                            type = "membershipmonthly";
                            break;
                        case "3":
                            type = "membershipyearly";
                            break;
                        case "4":
                            type = "membershiplifetime";
                            break;
                    }
                }
                else
                {
                    var option = ListUtils.SettingsSiteList;
                    if (Credits == option?.BagOfCreditsAmount)
                    {
                        type = "bagofcredits";
                    }
                    else if (Credits == option?.BoxOfCreditsAmount)
                    {
                        type = "boxofcredits";
                    }
                    else if (Credits == option?.ChestOfCreditsAmount)
                    {
                        type = "chestofcredits";
                    }
                }

                if (!string.IsNullOrEmpty(type))
                    GlobalContext.BillingSupport?.PurchaseNow(type);

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void PaypalLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                GlobalContext.InitPayPalPayment.BtnPaypalOnClick(Price, Credits, PayType, IdPay);
                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void CreditCardLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                Intent intent = new Intent(GlobalContext, typeof(PaymentCardDetailsActivity));
                intent.PutExtra("Id", IdPay);
                intent.PutExtra("credits", Credits);
                intent.PutExtra("Price", Price);
                intent.PutExtra("payType", PayType);
                GlobalContext.StartActivity(intent);

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void BankTransferLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                Intent intent = new Intent(GlobalContext, typeof(PaymentLocalActivity));
                intent.PutExtra("Id", IdPay);
                intent.PutExtra("credits", Credits);
                intent.PutExtra("Price", Price);
                intent.PutExtra("payType", PayType);
                GlobalContext.StartActivity(intent);

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void RazorPayLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                GlobalContext.InitRazorPay?.BtnRazorPayOnClick(Price);
                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void CashFreeLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                GlobalContext.OpenCashFreeDialog();
                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void PayStackLayoutOnClick(object sender, EventArgs e)
        {
            try
            {

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void PaySeraLayoutOnClick(object sender, EventArgs e)
        {
            try
            {

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private async void SecurionPayLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                Toast.MakeText(Activity, GetText(Resource.String.Lbl_Please_wait), ToastLength.Long)?.Show();

                await GlobalContext.SecurionPay();

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void AuthorizeNetLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                Intent intent = new Intent(GlobalContext, typeof(AuthorizeNetPaymentActivity));
                intent.PutExtra("Id", IdPay);
                intent.PutExtra("credits", Credits);
                intent.PutExtra("Price", Price);
                intent.PutExtra("payType", PayType);
                GlobalContext.StartActivity(intent);

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void IyziPayLayoutOnClick(object sender, EventArgs e)
        {
            try
            {
                GlobalContext.IyziPay();

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void AamarPayLayoutOnClick(object sender, EventArgs e)
        {
            try
            {

                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }
        
        private void IconCloseOnClick(object sender, EventArgs e)
        {
            try
            {
                Dismiss();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        #endregion
         
    }
}
﻿using System;
using Android.App;
using Android.Content;
using Android.Content.PM;
using Android.Graphics;
using Android.OS;

using Android.Views;
using Android.Widget;
using AndroidX.AppCompat.Content.Res;
using AndroidX.AppCompat.Widget;
using QuickDate.Activities.Base;
using QuickDate.Library.Anjo.Share;
using QuickDate.Library.Anjo.Share.Abstractions;
using QuickDate.Helpers.Ads;
using QuickDate.Helpers.Model;
using QuickDate.Helpers.Utils;
using QuickDateClient;
using Toolbar = AndroidX.AppCompat.Widget.Toolbar;

namespace QuickDate.Activities.SettingsUser.General
{
    [Activity(Icon = "@mipmap/icon", Theme = "@style/MyTheme", ConfigurationChanges = ConfigChanges.Locale | ConfigChanges.UiMode | ConfigChanges.ScreenSize | ConfigChanges.Orientation | ConfigChanges.ScreenLayout | ConfigChanges.SmallestScreenSize)]
    public class MyAffiliatesActivity : BaseActivity 
    {
        #region Variables Basic

        private ImageView ImageUser;
        private TextView TxtLink , TxtMyAffiliates;
        private AppCompatButton BtnShare; 

        #endregion
         
        #region General

        protected override void OnCreate(Bundle savedInstanceState)
        {
            try
            {
                base.OnCreate(savedInstanceState);
               
                Methods.App.FullScreenApp(this);
                SetTheme(QuickDateTools.IsTabDark() ? Resource.Style.MyTheme_Dark : Resource.Style.MyTheme);

                // Create your application here
                SetContentView(Resource.Layout.MyAffiliatesLayout);

                //Get Value And Set Toolbar
                InitComponent();
                InitBackground();
                InitToolbar();

                AdsGoogle.Ad_AdMobNative(this);
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        protected override void OnResume()
        {
            try
            {
                base.OnResume();
                AddOrRemoveEvent(true);
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        protected override void OnPause()
        {
            try
            {
                base.OnPause();
                AddOrRemoveEvent(false);
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public override void OnTrimMemory(TrimMemory level)
        {
            try
            {
                GC.Collect(GC.MaxGeneration, GCCollectionMode.Forced);
                base.OnTrimMemory(level);
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public override void OnLowMemory()
        {
            try
            {
                GC.Collect(GC.MaxGeneration);
                base.OnLowMemory();
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        #endregion
         
        #region Menu

        public override bool OnOptionsItemSelected(IMenuItem item)
        {
            switch (item.ItemId)
            {
                case Android.Resource.Id.Home:
                    Finish();
                    return true;
            }
            return base.OnOptionsItemSelected(item);
        }

        #endregion

        #region Functions

        private void InitComponent()
        {
            try
            {
                ImageUser = FindViewById<ImageView>(Resource.Id.ImageUser);
                TxtLink = FindViewById<TextView>(Resource.Id.linkText);
                TxtMyAffiliates = FindViewById<TextView>(Resource.Id.myAffiliatesText);
                BtnShare = FindViewById<AppCompatButton>(Resource.Id.cont);
                 
                TxtLink.Text = InitializeQuickDate.WebsiteUrl + "/register?ref=" + UserDetails.Username;

                var option = ListUtils.SettingsSiteList;
                if (option != null)
                {
                    if (!string.IsNullOrEmpty(option.AmountPercentRef) && option.AmountPercentRef != "0")
                    {
                        TxtMyAffiliates.Text = GetString(Resource.String.Lbl_EarnUpTo) + "%" + option.AmountPercentRef + " " + GetString(Resource.String.Lbl_forEachUserYourReferToUs) + " !";
                    }
                    else if (!string.IsNullOrEmpty(option.AmountRef) && option.AmountRef != "0")  
                    { 
                        TxtMyAffiliates.Text = GetString(Resource.String.Lbl_EarnUpTo) + " $" + option.AmountRef + " " + GetString(Resource.String.Lbl_forEachUserYourReferToUs) + " !";
                    }
                    else
                    {
                        TxtMyAffiliates.Text = GetString(Resource.String.Lbl_EarnUpTo) + " $" + " " + GetString(Resource.String.Lbl_forEachUserYourReferToUs) + " !";
                    }
                }
                else
                {
                    TxtMyAffiliates.Text = GetString(Resource.String.Lbl_EarnUpTo) + " $" + " " + GetString(Resource.String.Lbl_forEachUserYourReferToUs) + " !";
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        private void InitToolbar()
        {
            try
            {
                var toolbar = FindViewById<Toolbar>(Resource.Id.toolbar);
                if (toolbar != null)
                {
                    toolbar.Title = GetText(Resource.String.Lbl_MyAffiliates);
                    toolbar.SetTitleTextColor(QuickDateTools.IsTabDark() ? AppSettings.TitleTextColorDark : AppSettings.TitleTextColor);
                    SetSupportActionBar(toolbar);
                    SupportActionBar.SetDisplayShowCustomEnabled(true);
                    SupportActionBar.SetDisplayHomeAsUpEnabled(true);
                    SupportActionBar.SetHomeButtonEnabled(true);
                    SupportActionBar.SetDisplayShowHomeEnabled(true);

                    var icon = AppCompatResources.GetDrawable(this, AppSettings.FlowDirectionRightToLeft ? Resource.Drawable.icon_back_arrow_right : Resource.Drawable.icon_back_arrow_left);
                    icon?.SetTint(QuickDateTools.IsTabDark() ? Color.White : Color.Black);
                    SupportActionBar.SetHomeAsUpIndicator(icon);
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }
         
        private void AddOrRemoveEvent(bool addEvent)
        {
            try
            {
                // true +=  // false -=
                if (addEvent)
                {
                    BtnShare.Click += BtnShareOnClick;
                    TxtLink.LongClick += TxtLinkOnLongClick;
                }
                else
                {
                    BtnShare.Click -= BtnShareOnClick;
                    TxtLink.LongClick -= TxtLinkOnLongClick;
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        #endregion

        #region Events

        //Copy link
        private void TxtLinkOnLongClick(object sender, View.LongClickEventArgs e)
        {
            try
            {
                Methods.CopyToClipboard(this, TxtLink.Text);
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        //Share
        private async void BtnShareOnClick(object sender, EventArgs e)
        {
            try
            {
                //Share Plugin same as video
                if (!CrossShare.IsSupported) return;

                await CrossShare.Current.Share(new ShareMessage
                {
                    Title = UserDetails.Username,
                    Text = "",
                    Url = TxtLink.Text
                });
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        #endregion 
         
    }
}
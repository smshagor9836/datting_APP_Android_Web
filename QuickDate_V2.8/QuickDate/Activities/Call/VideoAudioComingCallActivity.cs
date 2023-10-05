using System;
using System.Collections.Generic;
using System.Threading.Tasks;
using MaterialDialogsCore;
using Android.App;
using Android.Content;
using Android.Content.PM;
using Android.Media;
using Android.OS; 
using Android.Text;
using Android.Views;
using Android.Widget;
using AndroidX.AppCompat.App;
using AT.Markushi.UI;
using Newtonsoft.Json;
using QuickDate.Activities.Call.Agora;
using QuickDate.Activities.Call.Twilio;
using QuickDate.Activities.Tabbes;
using QuickDate.Helpers.CacheLoaders;
using QuickDate.Helpers.Controller;
using QuickDate.Helpers.Utils;
using QuickDate.Library.Anjo.Call;
using QuickDateClient.Classes.Call;
using QuickDateClient.Classes.Chat;
using QuickDateClient.Requests;
using Exception = System.Exception;

namespace QuickDate.Activities.Call
{
    [Activity(Icon = "@mipmap/icon", Theme = "@style/MyTheme", ConfigurationChanges = ConfigChanges.Locale | ConfigChanges.UiMode | ConfigChanges.ScreenSize | ConfigChanges.Orientation | ConfigChanges.ScreenLayout | ConfigChanges.SmallestScreenSize | ConfigChanges.UiMode, ScreenOrientation = ScreenOrientation.Portrait)]
    public class VideoAudioComingCallActivity : AppCompatActivity, CallAnswerDeclineButton.IAnswerDeclineListener, MaterialDialog.ISingleButtonCallback, MaterialDialog.IListCallback, MaterialDialog.IInputCallback
    {
        private string CallType = "0";
        private DataCallObject CallUserObject;

        private ImageView UserImageView;
        private TextView UserNameTextView, TypeCallTextView;
        public static VideoAudioComingCallActivity CallActivity;

        private CircleButton MessageCallButton;

        public static bool IsActive = false;


        private Ringtone Ringtone;
        private Vibrator Vibrator;

        private CallAnswerDeclineButton AnswerDeclineButton;

        protected override void OnCreate(Bundle savedInstanceState)
        {
            try
            {
                base.OnCreate(savedInstanceState);

                SetContentView(Resource.Layout.TwilioCommingVideoCallLayout);
                Window.AddFlags(WindowManagerFlags.KeepScreenOn);

                CallActivity = this;

                CallType = Intent?.GetStringExtra("type") ?? "";

                if (!string.IsNullOrEmpty(Intent?.GetStringExtra("callUserObject")))
                    CallUserObject = JsonConvert.DeserializeObject<DataCallObject>(Intent?.GetStringExtra("callUserObject") ?? "");

                UserNameTextView = FindViewById<TextView>(Resource.Id.UsernameTextView);
                TypeCallTextView = FindViewById<TextView>(Resource.Id.TypecallTextView);
                UserImageView = FindViewById<ImageView>(Resource.Id.UserImageView);

                MessageCallButton = FindViewById<CircleButton>(Resource.Id.message_call_button);

                AnswerDeclineButton = FindViewById<CallAnswerDeclineButton>(Resource.Id.answer_decline_button);

                AnswerDeclineButton.SetAnswerDeclineListener(this);
                AnswerDeclineButton.Visibility = ViewStates.Visible;
                AnswerDeclineButton.StartRingingAnimation();

                MessageCallButton.Click += MessageCallButton_Click;

                if (!string.IsNullOrEmpty(CallUserObject.Fullname))
                    UserNameTextView.Text = CallUserObject.Fullname;

                if (!string.IsNullOrEmpty(CallUserObject.Avater))
                    GlideImageLoader.LoadImage(this, CallUserObject.Avater, UserImageView, ImageStyle.CircleCrop, ImagePlaceholders.Drawable);

                if (CallType == "Twilio_video_call" || CallType == "Agora_video_call_recieve")
                    TypeCallTextView.Text = GetText(Resource.String.Lbl_Video_call);
                else
                    TypeCallTextView.Text = GetText(Resource.String.Lbl_Voice_call);

                PlayAudioFromAsset("mystic_call.mp3");

                if (Build.VERSION.SdkInt >= BuildVersionCodes.S)
                {
                    VibratorManager vibratorManager = (VibratorManager)GetSystemService(VibratorManagerService);
                    Vibrator = vibratorManager?.DefaultVibrator;
                }
                else
                {
                    Vibrator = (Vibrator)GetSystemService("vibrator");
                }

                var vibrate = new long[]
                {
                    1000, 1000, 2000, 1000, 2000, 1000, 2000, 1000, 2000, 1000, 2000, 1000, 2000, 1000, 2000, 1000,
                    2000, 1000, 2000, 1000, 2000, 1000, 2000, 1000, 2000
                };

                // Vibrate for 500 milliseconds
                Vibrator?.Vibrate(VibrationEffect.CreateWaveform(vibrate, 3));
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        protected override void OnStart()
        {
            try
            {
                base.OnStart();
                IsActive = true;
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        protected override void OnStop()
        {
            try
            {
                base.OnStop();
                IsActive = false;
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

        protected override void OnDestroy()
        {
            try
            {
                HomeActivity.GetInstance()?.OffWakeLock();
                base.OnDestroy();
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        private void MessageCallButton_Click(object sender, EventArgs e)
        {
            try
            {

                if (Methods.CheckConnectivity())
                {
                    var arrayAdapter = new List<string>();
                    var dialogList = new MaterialDialog.Builder(this).Theme(QuickDateTools.IsTabDark() ? MaterialDialogsTheme.Dark : MaterialDialogsTheme.Light);

                    arrayAdapter.Add(GetString(Resource.String.Lbl_MessageCall1));
                    arrayAdapter.Add(GetString(Resource.String.Lbl_MessageCall2));
                    arrayAdapter.Add(GetString(Resource.String.Lbl_MessageCall3));
                    arrayAdapter.Add(GetString(Resource.String.Lbl_MessageCall4));
                    arrayAdapter.Add(GetString(Resource.String.Lbl_MessageCall5));

                    dialogList.Items(arrayAdapter);
                    dialogList.PositiveText(GetText(Resource.String.Lbl_Close)).OnNegative(this);
                    dialogList.AlwaysCallSingleChoiceCallback();
                    dialogList.ItemsCallback(this).Build().Show();
                }
                else
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Short)?.Show();
                }
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void RejectCallButton_Click(object sender, EventArgs e)
        {
            try
            {
                if (!Methods.CheckConnectivity())
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Short)?.Show();
                    return;
                }

                switch (CallType)
                {
                    case "Agora_video_call_recieve":
                    case "Twilio_video_call":
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { async () => await RequestsAsync.Call.DeclineCallAsync(CallUserObject.Id, TypeCall.Video) });
                        break;
                    case "Agora_audio_call_recieve":
                    case "Twilio_audio_call":
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { async () => await RequestsAsync.Call.DeclineCallAsync(CallUserObject.Id, TypeCall.Audio) });
                        break;
                } 

                ApiRequest.CallActionPopupOpened = false;
                FinishVideoAudio();
            }
            catch (Exception exception)
            {
                ApiRequest.CallActionPopupOpened = false;
                FinishVideoAudio();
                Methods.DisplayReportResultTrack(exception);
            }
        }

        private void AcceptCallButton_Click(object sender, EventArgs e)
        {
            try
            {
                switch (CallType)
                {
                    case "Twilio_video_call":
                        {
                            Intent intent = new Intent(this, typeof(TwilioVideoCallActivity));
                            intent.SetFlags(ActivityFlags.TaskOnHome | ActivityFlags.BroughtToFront);
                            intent.PutExtra("callUserObject", JsonConvert.SerializeObject(CallUserObject));
                            intent.PutExtra("type", CallType);
                            StartActivity(intent);
                            break;
                        }
                    case "Twilio_audio_call":
                        {
                            Intent intent = new Intent(this, typeof(TwilioAudioCallActivity));
                            intent.SetFlags(ActivityFlags.TaskOnHome | ActivityFlags.BroughtToFront | ActivityFlags.NewTask);
                            intent.PutExtra("callUserObject", JsonConvert.SerializeObject(CallUserObject));
                            intent.PutExtra("type", CallType);
                            StartActivity(intent);
                            break;
                        }
                    case "Agora_audio_call_recieve":
                        {
                            Intent intent = new Intent(this, typeof(AgoraAudioCallActivity));
                            intent.SetFlags(ActivityFlags.TaskOnHome | ActivityFlags.BroughtToFront | ActivityFlags.NewTask);
                            intent.PutExtra("callUserObject", JsonConvert.SerializeObject(CallUserObject));
                            intent.PutExtra("type", CallType);
                            StartActivity(intent);
                            break;
                        }
                    case "Agora_video_call_recieve":
                        {
                            Intent intent = new Intent(this, typeof(AgoraVideoCallActivity));

                            intent.SetFlags(ActivityFlags.TaskOnHome | ActivityFlags.BroughtToFront | ActivityFlags.NewTask);
                            intent.PutExtra("callUserObject", JsonConvert.SerializeObject(CallUserObject));
                            intent.PutExtra("type", CallType);
                            StartActivity(intent);
                            break;
                        }
                }

                FinishVideoAudio();
            }
            catch (Exception exception)
            {
                FinishVideoAudio();
                Methods.DisplayReportResultTrack(exception);
            }
        }

        #region MaterialDialog

        public void OnClick(MaterialDialog p0, DialogAction p1)
        {
            try
            {
                if (p1 == DialogAction.Positive)
                {
                }
                else if (p1 == DialogAction.Negative)
                {
                    p0.Dismiss();
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public void OnSelection(MaterialDialog dialog, View itemView, int position, string itemString)
        {
            try
            {
                string text = itemString;

                if (!Methods.CheckConnectivity())
                {
                    Toast.MakeText(this, GetString(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Short)?.Show();
                }
                else
                {
                    if (text == GetString(Resource.String.Lbl_MessageCall5))
                    {
                        var dialogBuilder = new MaterialDialog.Builder(this).Theme(QuickDateTools.IsTabDark() ? MaterialDialogsTheme.Dark : MaterialDialogsTheme.Light);
                        dialogBuilder.Input(Resource.String.Lbl_Write_your_message, 0, false, this);
                        dialogBuilder.InputType(InputTypes.TextFlagImeMultiLine);
                        dialogBuilder.PositiveText(GetText(Resource.String.Lbl_Send)).OnPositive(this);
                        dialogBuilder.NegativeText(GetText(Resource.String.Lbl_Cancel)).OnNegative(this);
                        dialogBuilder.Build().Show();
                        dialogBuilder.AlwaysCallSingleChoiceCallback();
                    }
                    else
                    {
                        SendMess(text);
                    }
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public void OnInput(MaterialDialog p0, string p1)
        {
            try
            {
                if (p1.Length > 0)
                {
                    var text = p1;
                    SendMess(text);
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        #endregion

        private async void SendMess(string text)
        {
            try
            {
                if (!Methods.CheckConnectivity())
                {
                    Toast.MakeText(this, GetString(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Short)?.Show();
                }
                else
                {
                    var unixTimestamp = DateTimeOffset.UtcNow.ToUnixTimeSeconds();
                    var hashId = unixTimestamp.ToString();

                    //Here on This function will send Selected audio file to the user 
                    var (apiStatus, respond) = await RequestsAsync.Chat.SendMessageAsync(CallUserObject.ToId, text, "", "", hashId);
                    if (apiStatus == 200)
                    {
                        if (respond is SendMessageObject result)
                        {
                            Console.WriteLine(result.Message);
                            if (!string.IsNullOrEmpty(CallUserObject.Id))
                            {
                                switch (CallType)
                                {
                                    case "Agora_video_call_recieve":
                                    case "Twilio_video_call":
                                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => RequestsAsync.Call.DeclineCallAsync(CallUserObject.Id, TypeCall.Video) });
                                        break;
                                    case "Agora_audio_call_recieve":
                                    case "Twilio_audio_call":
                                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { () => RequestsAsync.Call.DeclineCallAsync(CallUserObject.Id, TypeCall.Audio) });
                                        break;
                                } 
                            }

                            ApiRequest.CallActionPopupOpened = false;
                            FinishVideoAudio();
                        }
                    }
                    else Methods.DisplayReportResult(this, respond);
                }
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public void FinishVideoAudio()
        {
            try
            {
                StopAudioFromAsset();
                Vibrator?.Cancel();

                Finish();
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e);
            }
        }

        public void PlayAudioFromAsset(string fileName, string typeVolume = "right")
        {
            try
            {
                Ringtone = RingtoneManager.GetRingtone(this, RingtoneManager.GetDefaultUri(RingtoneType.Ringtone));
                Ringtone.Play();
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        public void StopAudioFromAsset()
        {
            try
            {
                if (Ringtone != null && Ringtone.IsPlaying)
                {
                    Ringtone.Stop();
                }
            }
            catch (Exception exception)
            {
                Methods.DisplayReportResultTrack(exception);
            }
        }

        public void OnAnswered()
        {
            try
            {
                switch (CallType)
                {
                    case "Twilio_video_call":
                        {
                            Intent intent = new Intent(this, typeof(TwilioVideoCallActivity));
                            intent.SetFlags(ActivityFlags.TaskOnHome | ActivityFlags.BroughtToFront);
                            intent.PutExtra("callUserObject", JsonConvert.SerializeObject(CallUserObject));
                            intent.PutExtra("type", CallType);
                            StartActivity(intent);
                            break;
                        }
                    case "Twilio_audio_call":
                        {
                            Intent intent = new Intent(this, typeof(TwilioAudioCallActivity));
                            intent.SetFlags(ActivityFlags.TaskOnHome | ActivityFlags.BroughtToFront | ActivityFlags.NewTask);
                            intent.PutExtra("callUserObject", JsonConvert.SerializeObject(CallUserObject));
                            intent.PutExtra("type", CallType);
                            StartActivity(intent);
                            break;
                        }
                    case "Agora_audio_call_recieve":
                        {
                            Intent intent = new Intent(this, typeof(AgoraAudioCallActivity));
                            intent.SetFlags(ActivityFlags.TaskOnHome | ActivityFlags.BroughtToFront | ActivityFlags.NewTask);
                            intent.PutExtra("callUserObject", JsonConvert.SerializeObject(CallUserObject));
                            intent.PutExtra("type", CallType);
                            StartActivity(intent);
                            break;
                        }
                    case "Agora_video_call_recieve":
                        {
                            Intent intent = new Intent(this, typeof(AgoraVideoCallActivity));

                            intent.SetFlags(ActivityFlags.TaskOnHome | ActivityFlags.BroughtToFront | ActivityFlags.NewTask);
                            intent.PutExtra("callUserObject", JsonConvert.SerializeObject(CallUserObject));
                            intent.PutExtra("type", CallType);
                            StartActivity(intent);
                            break;
                        }
                }

                FinishVideoAudio();
            }
            catch (Exception exception)
            {
                FinishVideoAudio();
                Methods.DisplayReportResultTrack(exception);
            }
        }

        public void OnDeclined()
        {
            try
            {
                if (!Methods.CheckConnectivity())
                {
                    Toast.MakeText(this, GetText(Resource.String.Lbl_CheckYourInternetConnection), ToastLength.Short)?.Show();
                    return;
                }

                switch (CallType)
                {
                    case "Agora_video_call_recieve":
                    case "Twilio_video_call":
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { async () => await RequestsAsync.Call.DeclineCallAsync(CallUserObject.Id, TypeCall.Video) });
                        break;
                    case "Agora_audio_call_recieve":
                    case "Twilio_audio_call":
                        PollyController.RunRetryPolicyFunction(new List<Func<Task>> { async () => await RequestsAsync.Call.DeclineCallAsync(CallUserObject.Id, TypeCall.Audio) });
                        break;
                }
                 
                ApiRequest.CallActionPopupOpened = false;
                FinishVideoAudio();
            }
            catch (Exception exception)
            {
                ApiRequest.CallActionPopupOpened = false;
                FinishVideoAudio();
                Methods.DisplayReportResultTrack(exception);
            }
        }
    }
}
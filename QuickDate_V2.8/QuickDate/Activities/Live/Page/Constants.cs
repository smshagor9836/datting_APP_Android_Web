﻿using DT.Xamarin.Agora.Video;

namespace QuickDate.Activities.Live.Page
{
    public class Constants
    {
        private static readonly int BeautyEffectDefaultContrast = BeautyOptions.LighteningContrastNormal;
        private static readonly float BeautyEffectDefaultLightness = 0.7f;
        private static readonly float BeautyEffectDefaultSmoothness = 0.5f;
        private static readonly float BeautyEffectDefaultRedness = 0.1f;
        private static readonly float BeautyEffectDefaultSharpness = 0.1f;

        public static readonly BeautyOptions DefaultBeautyOptions = new BeautyOptions(
            BeautyEffectDefaultContrast,
            BeautyEffectDefaultLightness,
            BeautyEffectDefaultSmoothness,
            BeautyEffectDefaultRedness,
            BeautyEffectDefaultSharpness);

        public static readonly VideoEncoderConfiguration.VideoDimensions[] VideoDimensions = new VideoEncoderConfiguration.VideoDimensions[]{
            VideoEncoderConfiguration.VD320x240,
            VideoEncoderConfiguration.VD480x360,
            VideoEncoderConfiguration.VD640x360,
            VideoEncoderConfiguration.VD640x480,
            new VideoEncoderConfiguration.VideoDimensions(960, 540),
            VideoEncoderConfiguration.VD1280x720
        };

        public static readonly int[] VideoMirrorModes = new int[]{
            DT.Xamarin.Agora.Constants.VideoMirrorModeAuto,
            DT.Xamarin.Agora.Constants.VideoMirrorModeEnabled,
            DT.Xamarin.Agora.Constants.VideoMirrorModeDisabled,
        };

        public static readonly string PrefName = "Demo_Live";
        public static readonly int DefaultProfileIdx = 2;
        public static readonly string PrefResolutionIdx = "pref_profile_index";
        public static readonly string PrefEnableStats = "pref_enable_stats";
        public static readonly string PrefMirrorLocal = "pref_mirror_local";
        public static readonly string PrefMirrorRemote = "pref_mirror_remote";
        public static readonly string PrefMirrorEncode = "pref_mirror_encode";
        public static readonly string KeyClientRole = "key_client_role";
    }

}
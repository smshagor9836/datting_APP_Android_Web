﻿using System;
using QuickDate.Helpers.Model;
using QuickDate.Helpers.Utils;
using QuickDateClient;

namespace QuickDate.CustomApi
{
    /// <summary>
    /// you just need these three params.
    /// WebsiteUrl, ServerKey, UserId, AccessToken. and then write your own definition of apis.
    /// If you are a developer, you will know how to use these params.
    /// And if you are not, please hire a dev for customization.
    /// </summary>
    public class CustomApiModel
    {
        public string WebsiteUrl { get; private set; }
        public string ServerKey { get; private set; }
        public string UserId { get; private set; }
        public string AccessToken { get; private set; }

        public CustomApiModel()
        {
            try
            {
                WebsiteUrl = InitializeQuickDate.WebsiteUrl;
                ServerKey = InitializeQuickDate.ServerKey;
                AccessToken = UserDetails.AccessToken;
                UserId = UserDetails.UserId.ToString();
            }
            catch (Exception e)
            {
                Methods.DisplayReportResultTrack(e); 
            }
        }
    }
}
<?php
    global $db;
    $views_count = 0;
    $views = $db->objectBuilder()
                ->where('v.view_userid', $profile->id)
                ->groupBy('v.user_id')
                ->orderBy('v.created_at', 'DESC')
                ->get('views v', null, array('COUNT(DISTINCT v.user_id) AS views'));
    if( $views !== null ){
        $views_count = COUNT($views);
    }
    $likes_count = $db->where('like_userid',$profile->id)->getOne('likes','count(id) as likes')['likes'];

?>
<?php require( $theme_path . 'main' . $_DS . 'mini-sidebar.php' );?>

<div class="container dt_user_profile_parent">
    <!-- display gps not enable message - see header js -->
    <div class="alert alert-warning hide" role="alert" id="gps_not_enabled">
        <p><?php echo __( 'Please Enable Location Services on your browser.' );?></p>
    </div>
    <script>
        var gps_not_enabled = document.querySelector('#gps_not_enabled');
        if( window.gps_is_not_enabled == true ){
            gps_not_enabled.classList.remove('hide');
        }
    </script>
	
	<div class="dt_user_profile dt_user_profile_m_top">
		<div class="row r_margin">
			<div class="col s12 m12 l3 custom_fixed_element">
				<div class="dt_user_info">
                    <div class="avatar">
                        <?php
                        $is_avatar_approved = is_avatar_approved($profile->id, str_replace(array(GetMedia('', false)),array(''),$profile->avater->full));
                        if($is_avatar_approved) { ?>
                            <a class="inline" href="<?php echo $profile->avater->full; ?>" id="avater_profile_img">
                                <img src="<?php echo $profile->avater->avater; ?>" alt="<?php echo $profile->full_name; ?>" class="responsive-img"/>
                                <?php if ((int)abs(((strtotime(date('Y-m-d H:i:s')) - $profile->lastseen))) < 60 && (int)$profile->online == 1) {
                                    echo '<div class="useronline" style="top: 10px;left: 10px;"></div>';
                                } ?>
                            </a>
                        <?php } else {?>
							<div class="dt_usr_undr_rvw">
								<img src="<?php echo $config->uri . '/upload/photos/d-blog.jpg'; ?>" alt="<?php echo $profile->full_name; ?>" class="responsive-img"/>
                                <span><?php echo __('Under Review');?></span>
							</div>
                        <?php } ?>
                        <div class="dt_chng_avtr">
							<span class="btn-upload-image" onclick="document.getElementById('profileavatar_img').click(); return false">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21,17H7V3H21M21,1H7A2,2 0 0,0 5,3V17A2,2 0 0,0 7,19H21A2,2 0 0,0 23,17V3A2,2 0 0,0 21,1M3,5H1V21A2,2 0 0,0 3,23H19V21H3M15.96,10.29L13.21,13.83L11.25,11.47L8.5,15H19.5L15.96,10.29Z" /></svg> <?php echo __( 'Change Photo' );?>
							</span>
                            <input type="file" id="profileavatar_img" class="hide" accept="image/x-png, image/gif, image/jpeg" name="avatar">
                        </div>
						<div class="dt_avatar_progress hide">
							<div class="avatar_imgprogress progress">
								<div class="avatar_imgdeterminate determinate" style="width: 0%"></div >
							</div>
						</div>
                    </div>
                </div>
			</div>
			<div class="col s12 m12 l9">
				<?php if( $config->image_verification == 0 ){ ?>
				<?php if( verifiedUser($profile) == false ){ ?>
                    <?php if($config->emailValidation == "1"){?>
                    <div class="dt_how_to_verfy_alrt">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196F3" d="M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1Z" /></svg> <?php echo __( 'To get your profile verified you have to verify these.');?>
                        </span>
						<ul class="browser-default dt_prof_vrfy">
                            <?php if($config->emailValidation == "1"){?>
                                <?php if( $config->sms_or_email === 'mail' ){?>
                                    <?php if( $profile->active === "0" ){?>
                                        <li><?php echo __( 'Please verify your email address' );?> <a href="<?php echo $site_url;?>/verifymail" data-ajax="/verifymail"><?php echo __( 'Verify Now' );?></a>.</li>
                                    <?php } ?>
                                <?php } ?>
                                <?php if( $config->sms_or_email == 'sms' ){?>
                                    <?php if( !empty( $profile->phone_number ) && $profile->phone_verified == "0" ){?>
                                        <li><?php echo __( 'Please verify your phone number' );?> <a href="<?php echo $site_url;?>/verifyphone" data-ajax="/verifyphone"><?php echo __( 'Verify Now' );?></a>.</li>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <?php if(count($profile->mediafiles) < 5){ ?>
							<li><?php echo __( 'Upload at least 5 image.');?></li>
                            <?php }?>
						</ul>
                    </div>
                    <?php }?>
                <?php } ?>
				<?php } ?>
				
                <div class="dt_user_prof_complt">
                    <h5 class="valign-wrapper"><?php echo __( 'Profile Completion' );?><span><?php echo $profile->profile_completion;?>%</span></h5>
					<div class="progress">
						<div class="determinate" style="width: <?php echo $profile->profile_completion;?>%"></div>
					</div>
				</div>

				<div class="dt_user_info">
					<div class="info">
						<div class="combo valign-wrapper">
							<h2>
								<?php echo $profile->full_name;?><?php echo ( $profile->age  > 0 ) ? ", ". $profile->age : "";?>
								<?php if( verifiedUser($profile) ){ ?>
									<span tooltip="<?php
									if( $config->image_verification == 1 && $profile->approved_at > 0 ){
										echo __( 'This profile is Verified by photos' );
									}else{
										echo __( 'This profile is Verified by phone' );
									}
									?>" flow="down">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196F3" d="M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1Z" /></svg>
									</span>
								<?php }else{ ?>
									<?php if($config->emailValidation == "0"){?>
										<span tooltip="<?php echo __( 'This profile is Verified' );?>" flow="down">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196F3" d="M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1Z" /></svg>
										</span>
									<?php }else{ ?>
										<span tooltip="<?php echo __( 'This profile is Not verified' );?>" flow="down">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#e18805" d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M17,15.59L15.59,17L12,13.41L8.41,17L7,15.59L10.59,12L7,8.41L8.41,7L12,10.59L15.59,7L17,8.41L13.41,12L17,15.59Z" /></svg>
										</span>
									<?php } ?>
								<?php } ?>
							</h2>
							<a class="user_btn" href="<?php echo $site_url;?>/settings/<?php echo $profile->username;?>" data-ajax="/settings/<?php echo $profile->username;?>"><?php echo __( 'Edit' );?></a>
						</div>
						<?php if( $profile->country !== '' ){?>
							<p class="valign-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="512" viewBox="0 0 32 32" width="512"><path d="m26 32h-20c-3.314 0-6-2.686-6-6v-20c0-3.314 2.686-6 6-6h20c3.314 0 6 2.686 6 6v20c0 3.314-2.686 6-6 6z" fill="#ffe6e2"/><path d="m16 8c-3.308 0-6 2.711-6 6.044 0 4.735 5.436 9.624 5.668 9.83.094.084.213.126.332.126s.238-.042.332-.126c.232-.206 5.668-5.095 5.668-9.83 0-3.333-2.692-6.044-6-6.044zm0 9.333c-1.838 0-3.333-1.495-3.333-3.333s1.495-3.333 3.333-3.333 3.333 1.495 3.333 3.333-1.495 3.333-3.333 3.333z" fill="#fc573b"/></svg> <?php echo $profile->country_txt;?></p>
						<?php } ?>
						<div class="dt_user_likes">
							<ul>
								<li><a href="<?php echo $site_url;?>/likes" data-ajax="/likes" id="mylikesx" class="waves-effect"><svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m26 32h-20c-3.314 0-6-2.686-6-6v-20c0-3.314 2.686-6 6-6h20c3.314 0 6 2.686 6 6v20c0 3.314-2.686 6-6 6z" fill="#f5e6fe"/><path d="m13.333 8c-2.022 0-3.667 1.645-3.667 3.667v1.833c0 .643.523 1.167 1.167 1.167h2.5c-1.291 0-2.333-1.042-2.333-2.333 1.556 0 2.333-1.167 2.333-2.333 0 1.167.778 2.333 2.333 2.333 0 1.291-1.042 2.333-2.333 2.333h2.5c.643 0 1.167-.523 1.167-1.167v-1.833c0-2.022-1.645-3.667-3.667-3.667z" fill="#be63f9"/><path d="m21.502 16c-.708 0-1.367.297-1.831.796-.464-.499-1.123-.796-1.831-.796-1.377 0-2.498 1.118-2.498 2.492 0 2.342 3.618 5.102 4.031 5.409.176.132.42.132.597 0 .412-.307 4.03-3.067 4.03-5.409 0-1.374-1.12-2.492-2.498-2.492z" fill="#d9a4fc"/><path d="m15.397 16h-4.897c-1.379 0-2.5 1.121-2.5 2.5v2.333c0 .276.224.5.5.5h6.9c-1.281-1.858-1.536-3.836-.003-5.333z" fill="#be63f9"/></svg> <span class="bold"><?php echo $likes_count;?></span> <?php echo __( 'Likes' );?></a></li>
								<li><a href="<?php echo $site_url;?>/visits" data-ajax="/visits" id="myViewsx" class="waves-effect"><svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m26 32h-20c-3.314 0-6-2.686-6-6v-20c0-3.314 2.686-6 6-6h20c3.314 0 6 2.686 6 6v20c0 3.314-2.686 6-6 6z" fill="#fff9dd"/><path d="m23.835 15.165c-1.301-3.138-4.376-5.165-7.835-5.165s-6.534 2.027-7.835 5.165c-.22.531-.22 1.14 0 1.671 1.301 3.137 4.376 5.164 7.835 5.164s6.534-2.027 7.835-5.165c.219-.531.219-1.139 0-1.67z" fill="#ffd200"/><circle cx="16" cy="16" fill="#fff9dd" r="2.667"/></svg> <span class="bold"><?php echo $views_count;?></span> <?php echo __( 'Views' );?></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="dt_user_pro_info">
                    <ul>
                        <li>
                            <a href="<?php echo $site_url;?>/popularity" data-ajax="/popularity">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ff5722" d="M12,16A3,3 0 0,1 9,13C9,11.88 9.61,10.9 10.5,10.39L20.21,4.77L14.68,14.35C14.18,15.33 13.17,16 12,16M12,3C13.81,3 15.5,3.5 16.97,4.32L14.87,5.53C14,5.19 13,5 12,5A8,8 0 0,0 4,13C4,15.21 4.89,17.21 6.34,18.65H6.35C6.74,19.04 6.74,19.67 6.35,20.06C5.96,20.45 5.32,20.45 4.93,20.07V20.07C3.12,18.26 2,15.76 2,13A10,10 0 0,1 12,3M22,13C22,15.76 20.88,18.26 19.07,20.07V20.07C18.68,20.45 18.05,20.45 17.66,20.06C17.27,19.67 17.27,19.04 17.66,18.65V18.65C19.11,17.2 20,15.21 20,13C20,12 19.81,11 19.46,10.1L20.67,8C21.5,9.5 22,11.18 22,13Z"></path></svg>
                                <span style="display: inline-block;"><?php echo __( 'Popularity' );?> </span><span class="bold" style="margin: 0px 5px;color: #a33596;display: inline-block;"><?php echo GetUserPopularity($profile->id);?></span>
                                <span class="bold"><?php echo __( 'Increase' );?></span>
                            </a>
                        </li>
                        <?php if( $profile->is_pro == 0 && $config->pro_system == 1 && isGenderFree($profile->gender) === false ){?>
                        <li>
                            <a href="<?php echo $site_url;?>/pro" data-ajax="/pro">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#2196f3" d="M16,9H19L14,16M10,9H14L12,17M5,9H8L10,16M15,4H17L19,7H16M11,4H13L14,7H10M7,4H9L8,7H5M6,2L2,8L12,22L22,8L18,2H6Z"></path></svg>
                                <span><?php echo __( 'Premium' );?></span>
                                <span class="bold"><?php echo __( 'Upgrade' );?></span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
			</div>
		</div>
		<figure class="dt_cover_photos">
			<div class="dt_cp_photos_list">
				<div class="dt_cp_bar_add_photos" onclick="document.getElementById('avatar_profileimg').click(); return false"> <!-- Add Photo -->
					<div class="inline">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M5,3A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H14.09C14.03,20.67 14,20.34 14,20C14,19.32 14.12,18.64 14.35,18H5L8.5,13.5L11,16.5L14.5,12L16.73,14.97C17.7,14.34 18.84,14 20,14C20.34,14 20.67,14.03 21,14.09V5C21,3.89 20.1,3 19,3H5M19,16V19H16V21H19V24H21V21H24V19H21V16H19Z" /></svg>
						<b><?php echo __( 'Add Photo' );?></b>
					</div>
				</div>
				<div class="dt_cp_bar_add_videos" onclick="$('#upload_video').modal('open');$('#btn_video_upload').removeClass('hide');$('#video_form').hide();"> <!-- Add Photo -->
					<div class="inline">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17,10.5V7A1,1 0 0,0 16,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16A1,1 0 0,0 17,17V13.5L21,17.5V6.5L17,10.5Z" /></svg>
						<b><?php echo __( 'Add Video' );?></b>
					</div>
				</div>
				<?php
				$i = 0;
				$media_count = count( (array)$profile->mediafiles );
				$gallery = array();
				$gallery['visable'][0] = null;
				$gallery['visable'][1] = null;
				$gallery['visable'][2] = null;
				$gallery['visable'][3] = null;
				$gallery['visable'][4] = null;

				for( $i == 0 ; $i < $media_count ; $i++ ){
					$gallery['visable'][$i] = $profile->mediafiles[$i];
				}

				foreach ($gallery['visable'] as $key => $value) {
					if( !empty( $value ) ){
						if( $value['is_video'] == "1" && $value['is_confirmed'] == "0" ){

						}else {
							$private = 'false';
							$img_path = $value['avater'];
							$video_file = $value['video_file'];
							if ($value['is_private'] == 1) {
								$private = 'true';
								$img_path = $value['private_file_avater'];
							}
							$is_avater = 'false';
							if ($value['avater'] == $profile->avater->avater) {
								$is_avater = 'true';
							}
							echo '<div class="dt_cp_l_photos">';
							if( $value['is_video'] == "1" ){
								echo '<a class="inline user_video" href="#myVideo_'.$value['id'].'" data-fancybox="gallery" data-id="' . $value['id'] . '" data-video="' . $value['is_video'] . '" data-private="' . $private . '" data-avater="' . $is_avater . '">';

//                                        echo '<div class="dt_chng_avtr">
//                                                    <span class="btn-upload-image" onclick="alert(\'lock\'); return false;" style="width: 30px;float: left;">
//                                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 25px;height: 25px;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
//                                                    </span>
//
//                                                    <span class="btn-upload-image" onclick="alert(\'UNlock\'); return false;" style="width: 30px;float: left;">
//                                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 25px;height: 25px;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
//                                                    </span>
//
//                                                    <span class="btn-upload-image" onclick="alert(\'delete\'); return false;" style="width: 30px;float: right;">
//                                                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 25px;height: 25px;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
//                                                    </span>
//
//                                                </div>';

								echo '<video width="800" height="550" controls id="myVideo_'.$value['id'].'" style="display:none;">';
								echo '    <source src="'.$video_file.'" type="video/mp4">';
//                                          echo '    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.webm" type="video/webm">';
//                                          echo '    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.ogv" type="video/ogg">';
								echo '    Your browser doesn\'t support HTML5 video tag.';
								echo '</video>';
								echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="dt_prof_ply_ico"><path fill="currentColor" d="M10,16.5V7.5L16,12M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" /></svg>';
							}else{
								echo '<a class="inline" href="' . $value['full'] . '" data-fancybox="gallery" data-id="' . $value['id'] . '" data-private="' . $private . '" data-avater="' . $is_avater . '">';
							}
							if($value['is_approved'] === 0 && $config->review_media_files == '1' ){
								echo '<div class="dt_usr_undr_rvw_mini"><img src="' . $config->uri . '/upload/photos/d-blog.jpg" alt="' . $profile->username . '"><span>'.__('Under Review').'</span></div>';
							}else{
								echo '<img src="' . $img_path . '" alt="' . $profile->username . '">';
							}

							echo '</a>';
							echo '</div>';
						}
					}else{
						echo '<div class="dt_cp_l_photos">';
						echo '<div class="inline"></div>';
						echo '</div>';
					}
				}
				?>
				<input type="file" id="avatar_profileimg" class="hide" accept="image/x-png, image/gif, image/jpeg" name="profile_images" multiple="multiple">
			</div>
		</figure>
	</div>
	
    <div class="row r_margin">
        <div class="col s12 m3 custom_fixed_element">
			<?php if( !empty( $profile->interest ) ) {?>
				<div class="dt_user_profile">
					<div class="dt_user_social">
						<div class="valign-wrapper">
							<h5><?php echo __( 'Interests' );?></h5>
						</div>
					</div>
					<?php
					$chips = explode( "," , $profile->interest );
					if( !empty( $chips ) ) {
						foreach ($chips as $key => $value) {
							$interest = trim(  $value  );
							if( $interest !== "" ){
								echo '<a href="'.$site_url.'/interest/'.strtolower($interest).'" data-ajax="/interest/'.strtolower($interest).'"><div class="chip dt_intrst_chip">'.$interest.'</div></a>';
							}
						}
					}
					?>
				</div>
			<?php } ?>
			<?php if( $config->social_media_links == 'on' ){?>
				<?php if( !empty( $profile->facebook ) || !empty( $profile->twitter ) || !empty( $profile->google ) || !empty( $profile->instagram ) || !empty( $profile->linkedin ) || !empty( $profile->website ) ) {?>
					<div class="dt_user_profile">
						<div class="dt_user_social">
							<div class="valign-wrapper">
								<h5><?php echo __( 'Social accounts' );?></h5>
							</div>
							<ul>
								<?php if( !empty( $profile->facebook ) ) {?>
									<li class="fb">
										<a href="https://www.facebook.com/<?php echo $profile->facebook;?>" target="_blank">
											<div class="soc_icon">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M13.397,20.997v-8.196h2.765l0.411-3.209h-3.176V7.548c0-0.926,0.258-1.56,1.587-1.56h1.684V3.127	C15.849,3.039,15.025,2.997,14.201,3c-2.444,0-4.122,1.492-4.122,4.231v2.355H7.332v3.209h2.753v8.202H13.397z"/></svg>
											</div>
											<div class="soc_info">
												<p><?php echo __( 'Facebook' );?></p>
												<span>@<?php echo $profile->facebook;?></span>
											</div>
										</a>
									</li>
								<?php } ?>
								<?php if( !empty( $profile->twitter ) ) {?>
									<li class="twit">
										<a href="https://twitter.com/<?php echo $profile->twitter;?>" target="_blank">
											<div class="soc_icon">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"/></svg>
											</div>
											<div class="soc_info">
												<p><?php echo __( 'Twitter' );?></p>
												<span>@<?php echo $profile->twitter;?></span>
											</div>
										</a>
									</li>
								<?php } ?>
								<?php if( !empty( $profile->google ) ) {?>
									<li class="gplus">
										<a href="https://vk.com/<?php echo $profile->google;?>" target="_blank">
											<div class="soc_icon">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15.07 2H8.93C3.33 2 2 3.33 2 8.93V15.07C2 20.67 3.33 22 8.93 22H15.07C20.67 22 22 20.67 22 15.07V8.93C22 3.33 20.67 2 15.07 2M18.15 16.27H16.69C16.14 16.27 15.97 15.82 15 14.83C14.12 14 13.74 13.88 13.53 13.88C13.24 13.88 13.15 13.96 13.15 14.38V15.69C13.15 16.04 13.04 16.26 12.11 16.26C10.57 16.26 8.86 15.32 7.66 13.59C5.85 11.05 5.36 9.13 5.36 8.75C5.36 8.54 5.43 8.34 5.85 8.34H7.32C7.69 8.34 7.83 8.5 7.97 8.9C8.69 11 9.89 12.8 10.38 12.8C10.57 12.8 10.65 12.71 10.65 12.25V10.1C10.6 9.12 10.07 9.03 10.07 8.68C10.07 8.5 10.21 8.34 10.44 8.34H12.73C13.04 8.34 13.15 8.5 13.15 8.88V11.77C13.15 12.08 13.28 12.19 13.38 12.19C13.56 12.19 13.72 12.08 14.05 11.74C15.1 10.57 15.85 8.76 15.85 8.76C15.95 8.55 16.11 8.35 16.5 8.35H17.93C18.37 8.35 18.47 8.58 18.37 8.89C18.19 9.74 16.41 12.25 16.43 12.25C16.27 12.5 16.21 12.61 16.43 12.9C16.58 13.11 17.09 13.55 17.43 13.94C18.05 14.65 18.53 15.24 18.66 15.65C18.77 16.06 18.57 16.27 18.15 16.27Z"/></svg>
											</div>
											<div class="soc_info">
												<p><?php echo __( 'VK' );?></p>
												<span>@<?php echo $profile->google;?></span>
											</div>
										</a>
									</li>
								<?php } ?>
								<?php if( !empty( $profile->instagram ) ) {?>
									<li class="insta">
										<a href="https://www.instagram.com/<?php echo $profile->instagram;?>" target="_blank">
											<div class="soc_icon">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z"/></svg>
											</div>
											<div class="soc_info">
												<p><?php echo __( 'instagram' );?></p>
												<span>@<?php echo $profile->instagram;?></span>
											</div>
										</a>
									</li>
								<?php } ?>
								<?php if( !empty( $profile->linkedin ) ) {?>
									<li class="lin">
										<a href="https://www.linkedin.com/in/<?php echo $profile->linkedin;?>" target="_blank">
											<div class="soc_icon">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21,21H17V14.25C17,13.19 15.81,12.31 14.75,12.31C13.69,12.31 13,13.19 13,14.25V21H9V9H13V11C13.66,9.93 15.36,9.24 16.5,9.24C19,9.24 21,11.28 21,13.75V21M7,21H3V9H7V21M5,3A2,2 0 0,1 7,5A2,2 0 0,1 5,7A2,2 0 0,1 3,5A2,2 0 0,1 5,3Z"/></svg>
											</div>
											<div class="soc_info">
												<p><?php echo __( 'LinkedIn' );?></p>
												<span>@<?php echo $profile->linkedin;?></span>
											</div>
										</a>
									</li>
								<?php } ?>
								<?php if( !empty( $profile->website ) ) {?>
									<li>
										<a href="<?php echo $profile->website;?>" target="_blank">
											<div class="soc_icon">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zM4.069 13h2.974c.136 2.379.665 4.478 1.556 6.23A8.01 8.01 0 0 1 4.069 13zm2.961-2H4.069a8.012 8.012 0 0 1 4.618-6.273C7.704 6.618 7.136 8.762 7.03 11zm5.522 8.972c-.183.012-.365.028-.552.028-.186 0-.367-.016-.55-.027-1.401-1.698-2.228-4.077-2.409-6.973h6.113c-.208 2.773-1.117 5.196-2.602 6.972zM9.03 11c.139-2.596.994-5.028 2.451-6.974.172-.01.344-.026.519-.026.179 0 .354.016.53.027 1.035 1.364 2.427 3.78 2.627 6.973H9.03zm6.431 8.201c.955-1.794 1.538-3.901 1.691-6.201h2.778a8.005 8.005 0 0 1-4.469 6.201zM17.167 11a14.67 14.67 0 0 0-1.792-6.243A8.014 8.014 0 0 1 19.931 11h-2.764z"/></svg>
											</div>
											<div class="soc_info">
												<p><?php echo __( 'Website' );?></p>
												<span><?php echo $profile->website;?></span>
											</div>
										</a>
									</li>
								<?php } ?>
								<?php
								$social_fields = GetProfileFields('social');
								$social_custom_data = UserFieldsData($profile->id);
								if (count($social_fields) > 0) {
									foreach ($social_fields as $key => $field) {
										if($field['profile_page'] == 1) {
											if( isset($social_custom_data[$field['fid']]) && $social_custom_data[$field['fid']] !== null ) {
												echo '<li>';
												echo '    <a href="' . $social_custom_data[$field['fid']] . '" target="_blank">';
												echo '    <div class="soc_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zM4.069 13h2.974c.136 2.379.665 4.478 1.556 6.23A8.01 8.01 0 0 1 4.069 13zm2.961-2H4.069a8.012 8.012 0 0 1 4.618-6.273C7.704 6.618 7.136 8.762 7.03 11zm5.522 8.972c-.183.012-.365.028-.552.028-.186 0-.367-.016-.55-.027-1.401-1.698-2.228-4.077-2.409-6.973h6.113c-.208 2.773-1.117 5.196-2.602 6.972zM9.03 11c.139-2.596.994-5.028 2.451-6.974.172-.01.344-.026.519-.026.179 0 .354.016.53.027 1.035 1.364 2.427 3.78 2.627 6.973H9.03zm6.431 8.201c.955-1.794 1.538-3.901 1.691-6.201h2.778a8.005 8.005 0 0 1-4.469 6.201zM17.167 11a14.67 14.67 0 0 0-1.792-6.243A8.014 8.014 0 0 1 19.931 11h-2.764z"/></svg></div>';
												echo '    <div class="soc_info"><p>' . $field['name'] . '</p><span>' . $social_custom_data[$field['fid']] . '</span></div></a>';
												echo '</li>';
											}
										}
									}
								}
								?>
							</ul>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
            <?php echo GetAd('profile_side_bar');?>

        </div>
		
        <div class="col s12 m9">
            <!-- Right Main Area -->

            

			
            <div class="dt_user_profile">
                <div class="dt_user_about">
                    <?php if( !empty( $profile->about ) ) {?>
                        <div class="about_block"> <!-- About You -->
                            <h4>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" /></svg>
                                <?php echo __( 'About You' );?>
                                <span><a class="edit_link" href="<?php echo $site_url;?>/settings-profile/<?php echo $profile->username;?>" data-ajax="/settings-profile/<?php echo $profile->username;?>"><?php echo __( 'Edit' );?></a></span>
                            </h4>
                            <p class="description"><?php echo nl2br($profile->about);?></p>
                        </div>
                    <?php } ?>

                    <?php if( !empty( $profile->location ) ) {?>
                        <div class="about_block"> <!-- Location -->
                            <h4>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z" /></svg>
                                <?php echo __( 'Location' );?>
                                <span><a class="edit_link" href="<?php echo $site_url;?>/settings-profile/<?php echo $profile->username;?>" data-ajax="/settings-profile/<?php echo $profile->username;?>"><?php echo __( 'Edit' );?></a></span>
                            </h4>
                            <p class="description"><?php echo $profile->location;?></p>
                            <div class="location_map">
                                <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo urlencode($profile->location);?>&zoom=13&size=600x205&maptype=roadmap&key=<?php echo($config->google_map_api_key) ?>" alt="<?php echo __( 'Location' );?>" />
                            </div>
                        </div>
                    <?php } ?>

                    <div class="about_block"> <!-- Profile Info -->
                        <h4><?php echo __( 'Profile Info ' );?>
                            <span><a class="edit_link" href="<?php echo $site_url;?>/settings-profile/<?php echo $profile->username;?>" data-ajax="/settings-profile/<?php echo $profile->username;?>"><?php echo __( 'Edit' );?></a></span>
                        </h4>
                        <div class="dt_profile_info">
							<?php if( !empty( $profile->language ) || !empty( $profile->relationship ) || !empty( $profile->work_status ) || !empty( $profile->education ) ) {?>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#ff9800" d="M5,9.5L7.5,14H2.5L5,9.5M3,4H7V8H3V4M5,20A2,2 0 0,0 7,18A2,2 0 0,0 5,16A2,2 0 0,0 3,18A2,2 0 0,0 5,20M9,5V7H21V5H9M9,19H21V17H9V19M9,13H21V11H9V13Z"></path></svg> <?php echo __( 'Basic' );?></h5>
                            <?php } ?>
                            <?php if( !empty( $profile->gender ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Gender' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo __($profile->gender);?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->language ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Preferred Language' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->language;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->relationship ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Relationship status' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->relationship_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->work_status ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Work status' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->work_status_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->education ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Education Level' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->education_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php
                            $general_fields = GetProfileFields('general');
                            $general_custom_data = UserFieldsData($profile->id);
                            if (count($general_fields) > 0) {
                                foreach ($general_fields as $key => $field) {
                                    if($field['profile_page'] == 1) {
                                        if( isset($general_custom_data[$field['fid']]) && $general_custom_data[$field['fid']] !== null ) {
                                            echo '<div class="row">';
                                            echo '    <div class="col s6"><p class="info_title">' . $field['name'] . '</p></div>';
                                            if ($field['select_type'] == 'yes') {
                                                $options = @explode(',', $field['type']);
                                                array_unshift($options,"");
                                                unset($options[0]);
                                                if (isset($options[$general_custom_data[$field['fid']]])) {
                                                    echo '    <div class="col s6"><p>' . $options[$general_custom_data[$field['fid']]] . '</p></div>';
                                                } else {
                                                    echo '    <div class="col s6"><p>' . $general_custom_data[$field['fid']] . '</p></div>';
                                                }
                                            } else {
                                                echo '    <div class="col s6"><p>' . $general_custom_data[$field['fid']] . '</p></div>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                }
                            }
                            ?>

                        </div>
                        <div class="dt_profile_info">
                            <?php if( !empty( $profile->ethnicity ) || !empty( $profile->body ) || !empty( $profile->height ) || !empty( $profile->hair_color ) ) {?>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#4caf50" d="M9,11.75A1.25,1.25 0 0,0 7.75,13A1.25,1.25 0 0,0 9,14.25A1.25,1.25 0 0,0 10.25,13A1.25,1.25 0 0,0 9,11.75M15,11.75A1.25,1.25 0 0,0 13.75,13A1.25,1.25 0 0,0 15,14.25A1.25,1.25 0 0,0 16.25,13A1.25,1.25 0 0,0 15,11.75M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,11.71 4,11.42 4.05,11.14C6.41,10.09 8.28,8.16 9.26,5.77C11.07,8.33 14.05,10 17.42,10C18.2,10 18.95,9.91 19.67,9.74C19.88,10.45 20,11.21 20,12C20,16.41 16.41,20 12,20Z"></path></svg> <?php echo __( 'Looks' );?></h5>
                            <?php } ?>

                            <?php if( !empty( $profile->ethnicity ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Ethnicity' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->ethnicity_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->body ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Body Type' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->body_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->height ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Height' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->height;?>cm</p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->hair_color ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Hair color' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->hair_color_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="dt_profile_info">
                            <?php if( !empty( $profile->character ) || !empty( $profile->children ) || !empty( $profile->friends ) || !empty( $profile->pets ) ) {?>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#795548" d="M17.81,4.47C17.73,4.47 17.65,4.45 17.58,4.41C15.66,3.42 14,3 12,3C10.03,3 8.15,3.47 6.44,4.41C6.2,4.54 5.9,4.45 5.76,4.21C5.63,3.97 5.72,3.66 5.96,3.53C7.82,2.5 9.86,2 12,2C14.14,2 16,2.47 18.04,3.5C18.29,3.65 18.38,3.95 18.25,4.19C18.16,4.37 18,4.47 17.81,4.47M3.5,9.72C3.4,9.72 3.3,9.69 3.21,9.63C3,9.47 2.93,9.16 3.09,8.93C4.08,7.53 5.34,6.43 6.84,5.66C10,4.04 14,4.03 17.15,5.65C18.65,6.42 19.91,7.5 20.9,8.9C21.06,9.12 21,9.44 20.78,9.6C20.55,9.76 20.24,9.71 20.08,9.5C19.18,8.22 18.04,7.23 16.69,6.54C13.82,5.07 10.15,5.07 7.29,6.55C5.93,7.25 4.79,8.25 3.89,9.5C3.81,9.65 3.66,9.72 3.5,9.72M9.75,21.79C9.62,21.79 9.5,21.74 9.4,21.64C8.53,20.77 8.06,20.21 7.39,19C6.7,17.77 6.34,16.27 6.34,14.66C6.34,11.69 8.88,9.27 12,9.27C15.12,9.27 17.66,11.69 17.66,14.66A0.5,0.5 0 0,1 17.16,15.16A0.5,0.5 0 0,1 16.66,14.66C16.66,12.24 14.57,10.27 12,10.27C9.43,10.27 7.34,12.24 7.34,14.66C7.34,16.1 7.66,17.43 8.27,18.5C8.91,19.66 9.35,20.15 10.12,20.93C10.31,21.13 10.31,21.44 10.12,21.64C10,21.74 9.88,21.79 9.75,21.79M16.92,19.94C15.73,19.94 14.68,19.64 13.82,19.05C12.33,18.04 11.44,16.4 11.44,14.66A0.5,0.5 0 0,1 11.94,14.16A0.5,0.5 0 0,1 12.44,14.66C12.44,16.07 13.16,17.4 14.38,18.22C15.09,18.7 15.92,18.93 16.92,18.93C17.16,18.93 17.56,18.9 17.96,18.83C18.23,18.78 18.5,18.96 18.54,19.24C18.59,19.5 18.41,19.77 18.13,19.82C17.56,19.93 17.06,19.94 16.92,19.94M14.91,22C14.87,22 14.82,22 14.78,22C13.19,21.54 12.15,20.95 11.06,19.88C9.66,18.5 8.89,16.64 8.89,14.66C8.89,13.04 10.27,11.72 11.97,11.72C13.67,11.72 15.05,13.04 15.05,14.66C15.05,15.73 16,16.6 17.13,16.6C18.28,16.6 19.21,15.73 19.21,14.66C19.21,10.89 15.96,7.83 11.96,7.83C9.12,7.83 6.5,9.41 5.35,11.86C4.96,12.67 4.76,13.62 4.76,14.66C4.76,15.44 4.83,16.67 5.43,18.27C5.53,18.53 5.4,18.82 5.14,18.91C4.88,19 4.59,18.87 4.5,18.62C4,17.31 3.77,16 3.77,14.66C3.77,13.46 4,12.37 4.45,11.42C5.78,8.63 8.73,6.82 11.96,6.82C16.5,6.82 20.21,10.33 20.21,14.65C20.21,16.27 18.83,17.59 17.13,17.59C15.43,17.59 14.05,16.27 14.05,14.65C14.05,13.58 13.12,12.71 11.97,12.71C10.82,12.71 9.89,13.58 9.89,14.65C9.89,16.36 10.55,17.96 11.76,19.16C12.71,20.1 13.62,20.62 15.03,21C15.3,21.08 15.45,21.36 15.38,21.62C15.33,21.85 15.12,22 14.91,22Z"></path></svg> <?php echo __( 'Personality' );?></h5>
                            <?php } ?>

                            <?php if( !empty( $profile->character ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Character' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->character_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->children ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Children' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->children_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->friends ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Friends' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->friends_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->pets ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Pets' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->pets_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="dt_profile_info">
                            <?php if( !empty( $profile->live_with ) || !empty( $profile->car ) || !empty( $profile->religion ) || !empty( $profile->smoke ) || !empty( $profile->drink ) || !empty( $profile->travel ) ) {?>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#2196f3" d="M15,18.54C17.13,18.21 19.5,18 22,18V22H5C5,21.35 8.2,19.86 13,18.9V12.4C12.16,12.65 11.45,13.21 11,13.95C10.39,12.93 9.27,12.25 8,12.25C6.73,12.25 5.61,12.93 5,13.95C5.03,10.37 8.5,7.43 13,7.04V7A1,1 0 0,1 14,6A1,1 0 0,1 15,7V7.04C19.5,7.43 22.96,10.37 23,13.95C22.39,12.93 21.27,12.25 20,12.25C18.73,12.25 17.61,12.93 17,13.95C16.55,13.21 15.84,12.65 15,12.39V18.54M7,2A5,5 0 0,1 2,7V2H7Z"></path></svg> <?php echo __( 'Lifestyle' );?></h5>
                            <?php } ?>

                            <?php if( !empty( $profile->live_with ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'I live with' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->live_with_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->car ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Car' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->car_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->religion ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Religion' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->religion_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->smoke ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Smoke' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->smoke_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->drink ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Drink' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->drink_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->travel ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Travel' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->travel_txt;?></p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="dt_profile_info">
                            <?php if( !empty( $profile->music ) || !empty( $profile->dish ) || !empty( $profile->song ) || !empty( $profile->hobby ) || !empty( $profile->city ) || !empty( $profile->sport ) || !empty( $profile->book ) || !empty( $profile->movie ) || !empty( $profile->colour ) || !empty( $profile->tv ) ) {?>
                                <h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#e91e63" d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z"></path></svg> <?php echo __( 'Favourites' );?></h5>
                            <?php } ?>

                            <?php if( !empty( $profile->music ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Music Genre' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->music;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->dish ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Dish' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->dish;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->song ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Song' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->song;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->hobby ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Hobby' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->hobby;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->city ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'City' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->city;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->sport ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Sport' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->sport;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->book ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Book' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->book;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->movie ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Movie' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->movie;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->colour ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'Color' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->colour;?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( !empty( $profile->tv ) ) {?>
                                <div class="row">
                                    <div class="col s6">
                                        <p class="info_title"><?php echo __( 'TV Show' );?></p>
                                    </div>
                                    <div class="col s6">
                                        <p><?php echo $profile->tv;?></p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="dt_profile_info">
                            <?php
                            $is_show_title = false;
                            $_profile_custom_data = '';
                            $profile_fields = GetProfileFields('profile');
                            $profile_custom_data = UserFieldsData($profile->id);
                            if (count($profile_fields) > 0) {
                                foreach ($profile_fields as $key => $field) {
                                    if($field['profile_page'] == 1) {
                                        if( isset($profile_custom_data[$field['fid']]) && $profile_custom_data[$field['fid']] !== null ) {
                                            $is_show_title = true;
                                            if( !empty($profile_custom_data[$field['fid']]) ) {
                                                $_profile_custom_data .= '<div class="row">';
                                                $_profile_custom_data .= '    <div class="col s6"><p class="info_title">' . __( $field['name'] ) . '</p></div>';
                                                if ($field['select_type'] == 'yes') {
                                                    $profile_options = @explode(',', $field['type']);
                                                    array_unshift($profile_options, "");
                                                    unset($profile_options[0]);
                                                    if (isset($profile_options[$profile_custom_data[$field['fid']]])) {
                                                        $_profile_custom_data .= '    <div class="col s6"><p>' . $profile_options[$profile_custom_data[$field['fid']]] . '</p></div>';
                                                    } else {
                                                        $_profile_custom_data .= '    <div class="col s6"><p>' . $profile_custom_data[$field['fid']] . '</p></div>';
                                                    }
                                                } else {
                                                    $_profile_custom_data .= '    <div class="col s6"><p>' . $profile_custom_data[$field['fid']] . '</p></div>';
                                                }
                                                $_profile_custom_data .= '</div>';
                                            }
                                        }
                                    }
                                }
                            }

                            if($is_show_title == true){
                                echo '<h5><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#ff9800" d="M5,9.5L7.5,14H2.5L5,9.5M3,4H7V8H3V4M5,20A2,2 0 0,0 7,18A2,2 0 0,0 5,16A2,2 0 0,0 3,18A2,2 0 0,0 5,20M9,5V7H21V5H9M9,19H21V17H9V19M9,13H21V11H9V13Z"></path></svg> '. __( 'Other' ) .'</h5>';
                            }
                            echo $_profile_custom_data;
                            ?>
                        </div>


                    </div>
                </div>
            </div> <!-- End Right Main Area -->
        </div>
    </div>
</div>
<!-- End Profile  -->

<div id="upload_images" class="modal" style="width: 30%;">
    <div class="modal-content">
        <div class="dt_user_prof_complt">
            <h5 class="valign-wrapper"><?php echo __( 'Upload Completion' );?><span id="c_perc">0%</span></h5>
            <div class="progress" id="c_prog">
                <div class="determinate" id="c_det" style="width: 0%"></div>
            </div>
        </div>

    </div>
</div>


<a href="javascript:void(0);" class="btn-floating btn-large waves-effect waves-light bg_gradient only-mobile" style="bottom: 100px;position: fixed;right: 32px;" onclick="document.getElementById('avatar_profileimg').click(); return false">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-7 -6 40 40"><path fill="currentColor" d="M5,3A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H14.09C14.03,20.67 14,20.34 14,20C14,19.32 14.12,18.64 14.35,18H5L8.5,13.5L11,16.5L14.5,12L16.73,14.97C17.7,14.34 18.84,14 20,14C20.34,14 20.67,14.03 21,14.09V5C21,3.89 20.1,3 19,3H5M19,16V19H16V21H19V24H21V21H24V19H21V16H19Z"></path></svg>
</a>


<div id="upload_video" class="modal" style="width: 60%;">
    <div class="modal-content">
        <h6 class="bold" style="margin-top: 0;"><?php echo __( 'Add Video' );?></h6>
        <?php if ($config->lock_pro_video == '1' && $profile->lock_pro_video == '0' && $profile->is_pro == '1'){ ?>
            <a href="javascript:void(0);" id="btn_video_upload" onclick="document.getElementById('avatar_profilevideo').click(); return false" class="btn_upld_prf_vid waves-effect">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9,16V10H5L12,3L19,10H15V16H9M5,20V18H19V20H5Z"></path></svg> <?php echo __( 'Upload' );?>
            </a>
            <input type="file" id="avatar_profilevideo" class="hide" accept="video/*" name="profile_videos">
        <?php } elseif ($config->lock_pro_video == '1' && $profile->lock_pro_video == '1' && $profile->is_pro == '1') { ?>
            <p><?php echo __('To unlock video upload feature in your account, you have to pay');?>  <?php echo $config->currency_symbol . (int)$config->lock_pro_video_fee;?>.</p>
            <div class="modal-body  credit_pln">
                <p class="bold"><?php echo __( 'Pay Using' );?></p>
                <div class="pay_using">
                    <div class="pay_u_btns valign-wrapper">
                        <?php if(!empty($config->paypal_id)){?>
                            <button id="lock_pro_video_paypal" onclick="clickAndDisable(this);" class="btn paypal valign-wrapper">
                                <span><?php echo __( 'PayPal' );?></span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M8.32,21.97C8.21,21.92 8.08,21.76 8.06,21.65C8.03,21.5 8,21.76 8.66,17.56C9.26,13.76 9.25,13.82 9.33,13.71C9.46,13.54 9.44,13.54 10.94,13.53C12.26,13.5 12.54,13.5 13.13,13.41C16.38,12.96 18.39,11.05 19.09,7.75C19.13,7.53 19.17,7.34 19.18,7.34C19.18,7.33 19.25,7.38 19.33,7.44C20.36,8.22 20.71,9.66 20.32,11.58C19.86,13.87 18.64,15.39 16.74,16.04C15.93,16.32 15.25,16.43 14.05,16.46C13.25,16.5 13.23,16.5 13,16.65C12.83,16.82 12.84,16.79 12.45,19.2C12.18,20.9 12.08,21.45 12.04,21.55C11.97,21.71 11.83,21.85 11.67,21.93L11.56,22H10C8.71,22 8.38,22 8.32,21.97V21.97M3.82,19.74C3.63,19.64 3.5,19.47 3.5,19.27C3.5,19 6.11,2.68 6.18,2.5C6.27,2.32 6.5,2.13 6.68,2.06L6.83,2H10.36C14.27,2 14.12,2 15,2.2C17.62,2.75 18.82,4.5 18.37,7.13C17.87,10.06 16.39,11.8 13.87,12.43C13,12.64 12.39,12.7 10.73,12.7C9.42,12.7 9.32,12.71 9.06,12.85C8.8,13 8.59,13.27 8.5,13.6C8.46,13.67 8.23,15.07 7.97,16.7C7.71,18.33 7.5,19.69 7.5,19.72L7.47,19.78H5.69C4.11,19.78 3.89,19.78 3.82,19.74V19.74Z" /></svg>
                                <svg class="spinner" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="spinner__path" fill="none" stroke-width="7" stroke-linecap="round" cx="33" cy="33" r="29"></circle></svg>
                            </button>
                        <?php } ?>
                        <?php if(!empty($config->stripe_secret)){?>
                            <button id="lock_pro_video_stripe" class="btn stripe valign-wrapper"><?php echo __( 'Card' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" /></svg></button>
                        <?php } ?>
                        <?php if(!empty($config->paysera_password)){?>
                            <button id="lock_pro_video_sms_payment" onclick="lock_pro_video_pay_via_sms();" class="btn valign-wrapper sms"><?php echo __( 'SMS' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17,19V5H7V19H17M17,1A2,2 0 0,1 19,3V21A2,2 0 0,1 17,23H7C5.89,23 5,22.1 5,21V3C5,1.89 5.89,1 7,1H17M9,7H15V9H9V7M9,11H13V13H9V11Z"></path></svg></button>
                        <?php } ?>
                        <?php if( $config->cashfree_payment === 'yes' && !empty($config->cashfree_client_key) && !empty($config->cashfree_secret_key)){?>
                            <button id="cashfree_payment" onclick="lock_pro_video_pay_via_cashfree();" class="btn valign-wrapper cashfree"><?php echo __( 'cashfree' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17,19V5H7V19H17M17,1A2,2 0 0,1 19,3V21A2,2 0 0,1 17,23H7C5.89,23 5,22.1 5,21V3C5,1.89 5.89,1 7,1H17M9,7H15V9H9V7M9,11H13V13H9V11Z"></path></svg></button>
                        <?php } ?>
                        <?php if ($config->iyzipay_payment == "yes" && !empty($config->iyzipay_key) && !empty($config->iyzipay_secret_key)) { ?>
                            <button id="iyzipay-button1" class="btn-cart btn btn-iyzipay-payment" onclick="lock_pro_video_pay_via_iyzipay();">
                                <img src="<?php echo GetMedia('upload/photos/iyzipay.png');?>" width="35" height="35">
                                <?php echo __( 'Iyzipay');?>
                            </button>
                        <?php } ?>
                        <?php if ($config->paystack_payment == "yes") { ?>
                            <button id="paystack-button1" class="btn-cart btn btn-paystack-payment" onclick="lock_pro_video_pay_via_paystack();">
                                <img src="<?php echo GetMedia('upload/photos/iyzipay.png');?>" width="35" height="35">
                                <?php echo __( 'PayStack');?>
                            </button>
                        <?php } ?>
                        <?php if ($config->authorize_payment == "yes") { ?>
                            <button id="authorize-button1" class="btn-cart btn btn-authorize-payment" onclick="lock_pro_video_pay_via_authorize();">
                                <img src="<?php echo GetMedia('upload/photos/iyzipay.png');?>" width="35" height="35">
                                <?php echo __( 'Authorize.net');?>
                            </button>
                        <?php } ?>
                        <?php if ($config->securionpay_payment == "yes") { ?>
                            <button id="securionpay-button1" class="btn-cart btn btn-securionpay-payment" onclick="lock_pro_video_pay_via_securionpay();">
                                <img src="<?php echo GetMedia('upload/photos/iyzipay.png');?>" width="35" height="35">
                                <?php echo __( 'Securionpay');?>
                            </button>
                        <?php } ?>
                        <?php if ($config->checkout_payment == 'yes') { ?>
                            <button id="2co_credit" class="btn 2co valign-wrapper"  onclick="lock_pro_video_pay_via_2co();">
                                <?php echo __( '2Checkout' );?> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" /></svg>
                            </button>
                        <?php } ?>
                        <?php if ($config->payu_payment == 'yes') { ?>
                            <button class="btn-payu btn" onclick="pay_using_payu('lock_pro_video',this,true);">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                                <circle style="fill:#F0EFEB;" cx="250.63" cy="256" r="250.63"/>
                                <path style="fill:#BAD000;" d="M482.348,203.706c-0.031,3.703-2.302,5.892-6.005,5.933c-4.767,0.041-9.544,0-14.322-0.01
                                    c0,0,0.368,39.691-0.143,59.537c-0.604,23.989-13.391,40.305-36.499,46.688c-19.539,5.401-39.292,5.36-58.606-1.197
                                    c-19.651-6.67-30.443-20.766-32.643-41.43c-0.307-2.946-0.399-5.892-0.399-8.849c0-23.641-0.01-47.292,0-70.932
                                    c0-10.659,3.171-13.974,13.8-14.444c5.759-0.256,11.519-0.491,17.216,0.583c5.309,0.992,8,4.02,8.501,9.432
                                    c0.194,2.036,0.286,4.092,0.297,6.128c0.01,23.723,0,47.445,0.01,71.157c0,6.69,1.882,12.449,8.245,15.795
                                    c3.12,1.637,6.527,2.353,10.025,2.68c5.463,0.512,10.884,0.471,16.275-0.634c9.125-1.862,13.871-7.427,14.209-16.756
                                    c0.02-0.685,0-1.371,0.01-2.046c0.031-24.48,0.051-48.959,0.102-73.428c0-1.361,0.133-2.731,0.348-4.071
                                    c0.737-4.675,3.56-7.335,8.143-8.276c2.588-0.532,5.227-0.563,7.846-0.685v0.01h3.376c0,0-0.01-3.202,0.092-4.184
                                    c0.358-3.294,2.302-5.442,5.565-5.483c9.616-0.133,19.242-0.143,28.868-0.02c3.519,0.051,5.667,2.496,5.688,6.087
                                    C482.399,184.761,482.41,194.234,482.348,203.706z"/>
                                <path style="fill:#AEB702;" d="M462.049,209.608c-4.395-0.019-8.799-0.221-13.181-0.002c-3.831,0.191-6.82-2.287-6.7-6.79
                                    c0.195-7.349,0.147-16.58,0.036-23.927c0,0,1.054,0.038,1.609,0.059c3.476,0.133,6.956,0.041,10.379,0.941
                                    c4.086,1.075,6.535,3.534,7.336,7.721c0.734,3.842,0.35,7.708,0.432,11.563c0.074,3.484,0.049,6.97,0.068,10.456
                                    C462.026,209.63,462.049,209.608,462.049,209.608z"/>
                                <g>
                                    <path style="fill:#BAD000;" d="M30.566,254.119c0-16.973-0.007-33.945,0.007-50.918c0.003-3.183,0.152-6.365,0.906-9.476
                                        c2.131-8.783,8.36-14.172,17.964-14.541c15.813-0.607,31.665-1.121,47.446,0.431c10.109,0.994,19.334,4.434,26.219,12.442
                                        c4.948,5.756,7.334,12.647,8.381,20.037c1.395,9.841,1.247,19.632-1.478,29.27c-3.813,13.482-13.004,21.238-26.31,24.539
                                        c-5.985,1.485-12.09,1.96-18.244,1.955c-11.138-0.01-22.277,0.049-33.414-0.06c-2.052-0.02-2.51,0.579-2.498,2.549
                                        c0.086,13.184,0.038,26.368,0.044,39.552c0.001,1.921-0.144,3.827-1.345,5.403c-2.535,3.327-13.56,3.38-16.196,0.119
                                        c-0.732-0.906-1.161-1.955-1.233-3.121c-0.102-1.662-0.239-3.327-0.241-4.99C30.559,289.58,30.566,271.85,30.566,254.119z
                                         M49.598,226.714c0,7.122,0.053,14.245-0.041,21.367c-0.021,1.602,0.407,1.993,1.99,1.984c11.744-0.07,23.488-0.019,35.232-0.05
                                        c3.183-0.008,6.354-0.326,9.489-0.895c8.892-1.615,14.439-6.599,15.961-14.592c1.357-7.129,1.452-14.315-0.016-21.443
                                        c-1.651-8.016-6.336-13.199-14.495-15.024c-3.269-0.731-6.581-1.095-9.904-1.12c-9.925-0.075-19.852-0.04-29.776-0.012
                                        c-1.127,0.003-2.273,0.137-3.376,0.371c-2.643,0.561-4.277,2.203-4.697,4.892c-0.222,1.416-0.341,2.861-0.348,4.294
                                        C49.578,213.227,49.597,219.97,49.598,226.714z"/>
                                    <path style="fill:#BAD000;" d="M254.031,359.114c-5.007,0.103-6.924-1.408-8.045-6.344c-0.335-1.473-0.697-2.955-0.84-4.453
                                        c-0.317-3.301,0.96-4.974,4.237-5.574c2.902-0.532,5.874-0.743,8.733-1.432c6.736-1.624,11.535-5.758,14.67-11.901
                                        c1.379-2.701,2.533-5.493,3.5-8.36c0.247-0.73,1.035-1.6,0.363-2.283c-0.522-0.53-1.426,0.007-2.151,0.143
                                        c-3.613,0.676-7.235,0.692-10.842,0.039c-7.54-1.366-12.324-6.094-15.346-12.847c-3.198-7.145-4.774-14.804-6.843-22.299
                                        c-5.714-20.703-11.325-41.434-16.954-62.161c-1.96-7.219-0.324-9.31,7.149-9.29c0.607,0.002,1.213-0.001,1.819,0.023
                                        c5.42,0.21,7.799,2.031,9.272,7.291c1.874,6.695,3.658,13.416,5.488,20.125c4.853,17.795,9.709,35.59,14.569,53.383
                                        c0.179,0.656,0.42,1.296,0.638,1.941c2.383,7.064,5.422,8.593,13.517,7.591c2.988-0.369,4.689-2.597,5.801-5.227
                                        c1.808-4.274,2.554-8.851,3.64-13.323c5.191-21.379,10.31-42.775,15.472-64.161c1.346-5.576,3.68-7.474,9.376-7.628
                                        c1.886-0.051,3.779-0.121,5.661,0.273c3.095,0.647,4.215,2.025,4.147,5.21c-0.041,1.916-0.599,3.731-1.056,5.56
                                        c-7.984,31.954-15.958,63.912-24.005,95.85c-2.136,8.477-5.147,16.622-10.198,23.874c-6.411,9.204-15.392,14.053-26.347,15.555
                                        c-1.2,0.165-2.404,0.308-3.61,0.417C255.246,359.159,254.636,359.114,254.031,359.114z"/>
                                    <path style="fill:#BAD000;" d="M217.32,264.609c0,7.954,0.198,15.912-0.043,23.859c-0.439,14.439-7.613,24.022-21.491,28.005
                                        c-14.077,4.04-28.42,4.587-42.552,0.302c-15.477-4.693-22.236-16.534-21.578-32c0.341-8.006,2.55-15.217,8.769-20.698
                                        c4.733-4.172,10.459-6.293,16.516-7.608c5.716-1.241,11.524-1.685,17.365-1.692c7.424-0.01,14.849-0.078,22.271,0.047
                                        c2.056,0.035,2.608-0.609,2.489-2.578c-0.237-3.926,0.144-7.868-0.29-11.802c-0.664-6.024-3.828-10.087-9.441-12.187
                                        c-6.368-2.381-13.045-2.508-19.719-2.276c-6.814,0.236-13.584,0.936-20.264,2.415c-4.828,1.069-7.177-0.811-7.475-5.777
                                        c-0.48-7.999,0.846-10.022,8.77-11.406c14.431-2.522,28.919-3.102,43.234,0.737c9.82,2.633,17.614,7.969,21.373,17.941
                                        c1.536,4.077,2.165,8.322,2.155,12.675c-0.016,7.348-0.004,14.696-0.004,22.044C217.376,264.609,217.348,264.609,217.32,264.609z
                                         M199.027,278.821c0-2.196-0.117-4.402,0.036-6.588c0.126-1.794-0.439-2.332-2.263-2.311c-8.028,0.096-16.059,0.036-24.088,0.044
                                        c-3.112,0.003-6.195,0.344-9.242,0.961c-8.537,1.727-12.401,5.73-13.309,13.738c-0.909,8.033,2.585,14.437,9.874,16.623
                                        c10.053,3.015,20.224,2.593,30.109-0.919c5.249-1.864,7.899-6.068,8.568-11.565C199.118,285.481,199.006,282.15,199.027,278.821z"
                                        />
                                    <path style="fill:#BAD000;" d="M511.995,154.443c0,3.404,0.015,6.809-0.004,10.213c-0.017,3.057-1.546,4.714-4.528,4.726
                                        c-6.96,0.029-13.921,0.008-20.881-0.059c-2.603-0.026-4.319-1.597-4.354-4.233c-0.095-7.185-0.104-14.375,0.018-21.56
                                        c0.047-2.789,1.75-4.238,4.562-4.253c6.809-0.038,13.619-0.037,20.428-0.003c3.212,0.016,4.735,1.566,4.754,4.727
                                        C512.01,147.482,511.994,150.962,511.995,154.443z"/>
                                    <path style="fill:#BAD000;" d="M462.042,128.996c0-2.271-0.032-4.543,0.009-6.813c0.04-2.213,0.973-3.116,3.203-3.124
                                        c4.618-0.018,9.235-0.02,13.853,0.001c2.204,0.01,3.203,0.928,3.23,3.139c0.058,4.617,0.055,9.235,0.008,13.852
                                        c-0.023,2.226-1.13,3.354-3.378,3.384c-4.541,0.058-9.084,0.047-13.625-0.008c-2.252-0.027-3.293-1.133-3.328-3.393
                                        c-0.036-2.346-0.008-4.693-0.008-7.039C462.019,128.996,462.031,128.996,462.042,128.996z"/>
                                </g>
                                </svg>
                                <span><?php echo __( 'payu' );?></span>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <a href="javascript:void(0);" id="btn_video_upload" onclick="document.getElementById('avatar_profilevideo').click(); return false" class="btn_upld_prf_vid waves-effect">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9,16V10H5L12,3L19,10H15V16H9M5,20V18H19V20H5Z"></path></svg> <?php echo __( 'Upload' );?>
            </a>
            <input type="file" id="avatar_profilevideo" class="hide" accept="video/*" name="profile_videos">
        <?php } ?>
        <div class="dt_user_prof_complt hide" style="margin: 50px 5px;">
            <h5 class="valign-wrapper"><?php echo __( 'Upload Completion' );?><span id="c_percx">0%</span></h5>
            <div class="progress" id="c_progx">
                <div class="determinate" id="c_detx" style="width: 0%"></div>
            </div>
        </div>
		<div class="dt_prof_upldd_vid_ldng center hide">
			<p><?php echo __('Please wait..');?></p>
			<svg width="120" height="30" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="currentColor"> <circle cx="15" cy="15" r="15"> <animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite" /> <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite" /> </circle> <circle cx="60" cy="15" r="9" fill-opacity="0.3"> <animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite" /> <animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite" /> </circle> <circle cx="105" cy="15" r="15"> <animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite" /> <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite" /> </circle> </svg>
		</div>
        <div id="video_form" class="hide">
            <div class="form-group">
                <label class="col-md-12" for="privacy"><?php echo __( 'Privacy');?></label>
                <div class="col-md-12">
                    <select name="privacy" id="privacy" class="form-control">
                        <option value="0" selected><?php echo __( 'Public');?></option>
                        <option value="1"><?php echo __( 'Private');?></option>
                    </select>
                </div>
            </div>
			<br>
			<input type="file" id="video_thumbnail" class="hide" accept="image/x-png, image/gif, image/jpeg" name="video_thumbnail">
            <div class="item active form-group" onclick="document.getElementById('video_thumbnail').click(); return false">
                <label class="col-md-12" for="privacy"><?php echo __( 'Thumbnail');?></label>
                <img id="video_thumbnail_image" src="<?php echo $config->uri;?>/upload/photos/video-placeholder.jpg" class="dt_prof_upldd_vid_thmb">
                <input type="file" id="video_thumbnail" class="hide" accept="image/x-png, image/gif, image/jpeg" name="video_thumbnail">
            </div>
            <input type="hidden" name="media_id" id="media_id">
        </div>
    </div>
    <div class="modal-footer">
        <div class="video_upload_form_progress hide" id="img_upload_progress">
            <div class="progress">
                <div id="img_upload_progress_bar" class="determinate progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            </div>
        </div>
        <button class="modal-close waves-effect btn-flat"><?php echo __( 'Close' );?></button>
        <button class="waves-effect waves-light btn-flat btn_primary white-text" disabled id="btn-upload-video-file" data-selected=""><?php echo __( 'Upload' );?></button>
    </div>
</div>

<div class="bank_transfer_modal modal modal-fixed-footer">
	<div class="modal-dialog">
    <div class="modal-content dt_bank_trans_modal">
		<div class="modal-header">
			<h5 class="modal-title"><?php echo __( 'Bank Transfer' );?></h5>
		</div>
        <div class="modal-body">
            <div class="bank_info"><?php echo htmlspecialchars_decode($config->bank_description);?></div>
			<div class="dt_user_profile hide_alert_info_bank_trans">
                <span class="valign-wrapper">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path></svg> <?php echo __( 'Note' );?>:
                </span>
				<ul class="browser-default dt_prof_vrfy">
					<li><?php echo __( 'Please transfer the amount of' );?> <b><span id="bank_transfer_price"></span></b> <?php echo __( 'to this bank account to buy' );?> <b>"<span id="bank_transfer_description"></span>"</b></li>
					<li><?php echo $config->bank_transfer_note;?></li>
				</ul>
            </div>
			<p class="dt_bank_trans_upl_rec"><a href="javascript:void(0);" onclick="$('.bank_transfer_modal').addClass('up_rec_active'); return false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M13.5,16V19H10.5V16H8L12,12L16,16H13.5M13,9V3.5L18.5,9H13Z"></path></svg> <?php echo __( 'Upload Receipt' );?></a></p>
            <div class="upload_bank_receipts">
                <div onclick="document.getElementById('receipt_img').click(); return false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M13.5,16V19H10.5V16H8L12,12L16,16H13.5M13,9V3.5L18.5,9H13Z"></path></svg>
                    <p><?php echo __( 'Upload Receipt' );?></p>
					<img id="receipt_img_preview" src="">
                </div>
            </div>
            <input type="file" id="receipt_img" class="hide" accept="image/x-png, image/gif, image/jpeg" name="receipt_img">
        </div>
        <!--<span style="display: block;text-align: center;" id="receipt_img_path"></span>-->
    </div>
    <div class="modal-footer">
		<div class="bank_transfr_progress hide" id="img_upload_progress">
			<div class="progress">
				<div id="img_upload_progress_bar" class="determinate progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
			</div>
		</div>
		<button class="modal-close waves-effect btn-flat"><?php echo __( 'Close' );?></button>
        <button class="waves-effect waves-green btn btn-flat bold" disabled id="btn-upload-receipt" data-selected=""><?php echo __( 'Confirm' );?></button>
    </div>
	</div>
</div>


<script>
	<?php if ($config->securionpay_payment === "yes") { ?>
        $(function () {
            SecurionpayCheckout.key = '<?php echo($config->securionpay_public_key); ?>';
            SecurionpayCheckout.success = function (result) {
                $.post(window.ajax + 'securionpay/handle', result, function(data, textStatus, xhr) {
                    if (data.status == 200) {
                        window.location.href = data.url;
                    }
                }).fail(function(data) {
                    M.toast({html: data.responseJSON.message});
                });
            };
            SecurionpayCheckout.error = function (errorMessage) {
                M.toast({html: errorMessage});
            };
        });
        function lock_pro_video_pay_via_securionpay(){
            price = <?php echo (int)$config->lock_pro_video_fee;?>;
            $.post(window.ajax + 'securionpay/token', {type:'lock_pro_video',price:price}, function(data, textStatus, xhr) {
                if (data.status == 200) {
                    SecurionpayCheckout.open({
                        checkoutRequest: data.token,
                        name: 'lock pro video',
                        description: '<?php echo __( "Unlock Upload video feature");?>'
                    });
                }
            }).fail(function(data) {
                M.toast({html: data.responseJSON.message});
            });
        }
    <?php } ?>
	<?php if ($config->authorize_payment === "yes") { ?>
    function lock_pro_video_pay_via_authorize() {
        $('#authorize_btn').attr('onclick', 'AuthorizeVideoRequest()');
        $('#authorize_modal').modal('open');
    }
    function AuthorizeVideoRequest() {
        $('#authorize_btn').html("<?php echo __('please_wait');?>");
        $('#authorize_btn').attr('disabled','true');
        authorize_number = $('#authorize_number').val();
        authorize_month = $('#authorize_month').val();
        authorize_year = $('#authorize_year').val();
        authorize_cvc = $('#authorize_cvc').val();
        price = <?php echo (int)$config->lock_pro_video_fee;?>;
        $.post(window.ajax + 'authorize/pay', {type:'lock_pro_video',card_number:authorize_number,card_month:authorize_month,card_year:authorize_year,card_cvc:authorize_cvc,price:price}, function(data) {
            if (data.status == 200) {
                window.location.href = data.url;
            } else {
                $('#authorize_alert').html("<div class='alert alert-danger'>"+data.message+"</div>");
                setTimeout(function () {
                    $('#authorize_alert').html("");
                },3000);
            }
            $('#authorize_btn').html("<?php echo __( 'pay' );?>");
            $('#authorize_btn').removeAttr('disabled');
        }).fail(function(data) {
            $('#authorize_alert').html("<div class='alert alert-danger'>"+data.responseJSON.message+"</div>");
            setTimeout(function () {
                $('#authorize_alert').html("");
            },3000);
            $('#authorize_btn').html("<?php echo __( 'pay' );?>");
            $('#authorize_btn').removeAttr('disabled');
        });
    }
    <?php } ?>
	function lock_pro_video_pay_via_paystack() {
        $('#paystack_btn').attr('onclick', 'InitializeVideoPaystack()');
        $('#paystack_wallet_modal').modal('open');
    }
    function InitializeVideoPaystack() {
        $('#paystack_btn').html("<?php echo __('please_wait');?>");
        $('#paystack_btn').attr('disabled','true');
        email = $('#paystack_wallet_email').val();
        price = <?php echo (int)$config->lock_pro_video_fee;?>;
        $.post(window.ajax + 'paystack/initialize', {type:'lock_pro_video',email:email,price:price}, function(data) {
            if (data.status == 200) {
                window.location.href = data.url;
            } else {
                $('#paystack_wallet_alert').html("<div class='alert alert-danger'>"+data.message+"</div>");
                setTimeout(function () {
                    $('#paystack_wallet_alert').html("");
                },3000);
            }
            $('#paystack_btn').html("<?php echo __( 'Confirm' );?>");
            $('#paystack_btn').removeAttr('disabled');
        });
    }
    
    function lock_pro_video_pay_via_2co(){
        $('#2checkout_type').val('lock_pro_video');
        $('#2checkout_description').val('<?php echo __( "Unlock Upload video feature");?>');
        $('#2checkout_price').val(<?php echo (int)$config->lock_pro_video_fee;?>);

        $('#2checkout_modal').modal('open');
    }
    function lock_pro_video_pay_via_iyzipay(){
        $('.btn-iyzipay-payment').attr('disabled','true');

        $.post(window.ajax + 'iyzipay/createsession', {
            payType: 'lock_pro_video',
            description: '<?php echo __( "Unlock Upload video feature");?>',
            price: <?php echo (int)$config->lock_pro_video_fee;?>
        }, function(data) {
            if (data.status == 200) {
                $('#iyzipay_content').html('');
                $('#iyzipay_content').html(data.html);
            } else {
                $('.btn-iyzipay').attr('disabled', false).html("Iyzipay App not set yet.");
            }
            $('.btn-iyzipay').removeAttr('disabled');
            $('.btn-iyzipay').find('span').text("<?php echo __( 'iyzipay');?>");
        });

        $('.btn-iyzipay-payment').removeAttr('disabled');

    }

    function lock_pro_video_pay_via_cashfree(){
        $('.cashfree-payment').attr('disabled','true');

        $('#cashfree_type').val('lock_pro_video');
        $('#cashfree_description').val('<?php echo __( 'Unlock Upload video feature' );?>');
        $('#cashfree_price').val(<?php echo (int)$config->lock_pro_video_fee;?>);

        $("#cashfree_alert").html('');
        $('.go_pro--modal').fadeOut(250);
        $('#cashfree_modal_box').modal('open');

        $('.btn-cashfree-payment').removeAttr('disabled');
    }

    
    function unlock_photo_private_pay_via_bank(amount){
        $('#bank_transfer_price').text('<?php echo $config->currency_symbol;?> <?php echo (int)$config->lock_private_photo_fee;?>');
        $('#bank_transfer_description').text('<?php echo __( 'Unlock Private Photo Payment' );?>');
        $('#receipt_img_path').html('');
        $('#receipt_img_preview_unlock_photo_private').attr('src', '');
        $('.bank_transfer_modal').removeClass('up_rec_img_ready, up_rec_active');
        $('.bank_transfer_modal').modal('open');
    }

    $(document).ready(function(){

        document.getElementById('receipt_img').addEventListener('change', function(e) {
            let imgPath = $(this)[0].files[0].name;
            if (typeof(FileReader) != "undefined") {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#receipt_img_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
            $('#receipt_img_path').html(imgPath);
            $('.bank_transfer_modal').addClass('up_rec_img_ready');
            $('#btn-upload-receipt').removeAttr('disabled');
            $('#btn-upload-receipt').removeClass('btn-flat').addClass('btn-success');
        });

        document.getElementById('btn-upload-receipt').addEventListener('click', function(e) {
            e.preventDefault();
            let bar = $('#img_upload_progress');
            let percent = $('#img_upload_progress_bar');

            let formData = new FormData();
            formData.append("description", '<?php echo __( 'Unlock Private Photo Payment' );?>');
            formData.append("price", <?php echo (int)$config->lock_private_photo_fee;?>);
            formData.append("mode", 'unlock_photo_private');
            formData.append("receipt_img", $("#receipt_img")[0].files[0], $("#receipt_img")[0].files[0].value);
            bar.removeClass('hide');
            $.ajax({
                xhr: function() {
                    let xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            let percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            //status.html( percentComplete + "%");
                            percent.width(percentComplete + '%');
                            percent.html(percentComplete + '%');
                            if (percentComplete === 100) {
                                bar.addClass('hide');
                                percent.width('0%');
                                percent.html('0%');
                            }
                        }
                    }, false);
                    return xhr;
                },
                url: window.ajax + 'profile/upload_receipt',
                type: "POST",
                async: true,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                timeout: 60000,
                dataType: false,
                data: formData,
                success: function(result) {
                    if( result.status == 200 ){
                        $('.bank_transfer_modal').modal('close');
                        $('.payment_modalx').modal('close');
                        M.toast({html: '<?php echo __('Your receipt uploaded successfully.');?>'});
                        return false;
                    }
                }
            });
        });


        $( document ).on( 'click', '#btn-upload-video-file', function(e){
            var formData = new FormData();
                formData.append("privacy", $('#privacy').val() );
                formData.append("media_id", $('#media_id').val() );
                if(typeof $('#video_thumbnail')[0].files[0] !== "undefined") {
                    formData.append("video_thumbnail", $('#video_thumbnail')[0].files[0], $('#video_thumbnail')[0].files[0].value);
                }
                console.log(formData);

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            xstatus.html( percentComplete + "%");
                            xbar.css({'width': percentComplete + '%'});
                            if (percentComplete === 100) {
                                xbar.hide();
                                xbar.width('0%');
                                xstatus.html( "0%");
                                $('.dt_user_prof_complt').addClass('hide');
                            }
                        }
                    }, false);
                    return xhr;
                },
                url: window.ajax + 'profile/confirm_upload_video',
                type: "POST",
                async: true,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                timeout: 60000,
                dataType: false,
                success: function(result) {
                    if( result.status == 200 ){
                        // $('#video_form').removeClass('hide');
                        // $('#media_id').val(result.media_id);
                        // $('#btn-upload-video-file').attr('disabled', false);
                        // e.preventDefault();
                        $('#upload_video').modal('close');
                        setTimeout(function() {
                            $("#ajaxRedirect").attr("data-ajax", '/' + window.loggedin_user );
                            $("#ajaxRedirect").click();
                        }, 500);

                    }
                },
                error(data){
                    $('#upload_video').modal('close');
                }
            });

        });

        $( document ).on( 'change', '#video_thumbnail', function(e){
            if (typeof(FileReader) != "undefined") {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#video_thumbnail_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $( document ).on( 'change', '#avatar_profilevideo', function(e){

            <?php
                if($profile->is_pro == '0'){
                    $user_image_count = (int)$db->where('user_id', $profile->id)->getValue('mediafiles','count(id)');
                    $config_max_image = (int)$config->max_photo_per_user;
                    if( $user_image_count >= $config_max_image ) {?>
                        M.toast({html: '<?php echo __('You reach to limit of media uploads.');?>'});
                        $('#upload_video').modal('close');
                        return false;
            <?php }} ?>

            $('#btn_video_upload').addClass('hide');
            $('.dt_user_prof_complt').removeClass('hide');
            var xbar = $('#c_detx');
            var xstatus = $('#c_percx');
            var formData = new FormData();
                formData.append("video", $(this)[0].files[0],$(this)[0].files[0].value );
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            xstatus.html( percentComplete + "%");
                            xbar.css({'width': percentComplete + '%'});
                            if (percentComplete === 100) {
                                xbar.hide();
                                xbar.width('0%');
                                xstatus.html( "0%");
                                $('.dt_user_prof_complt').addClass('hide');
                                $('.dt_prof_upldd_vid_ldng').removeClass('hide');
                            }
                        }
                    }, false);
                    return xhr;
                },
                url: window.ajax + 'profile/upload_video',
                type: "POST",
                async: true,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                timeout: 0,
                dataType: false,
                success: function(result) {
                    if( result.status == 200 ){
                        $('.dt_prof_upldd_vid_ldng').addClass('hide');
                        $('#video_form').removeClass('hide');
                        $('#video_form').show();
                        $('#media_id').val(result.media_id);
                        if(typeof result.thumb !== "undefined") {
                            $('#video_thumbnail_image').attr('src', result.thumb);
                        }
                        $('#btn-upload-video-file').attr('disabled', false);
                        e.preventDefault();
                    }
                },
                error(result){
                    M.toast({html: result.responseJSON.message});
                    $('#upload_video').modal('close');
                }
            });
        });

    });
</script>
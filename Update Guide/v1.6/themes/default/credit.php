<?php if( isGenderFree($profile->gender) === true ){?><script>window.location = window.site_url;</script><?php } ?>
<?php //$profile = auth();?>
<!-- Credits  -->
<div class="container page-margin find_matches_cont">
	<div class="row r_margin">
		<div class="col l3">
			<?php require( $theme_path . 'main' . $_DS . 'sidebar.php' );?>
		</div>
		
		<div class="col l9">
			<div class="dt_credits dt_sections">
				<?php if (file_exists($theme_path . 'third-party-payment.php')) { ?>
					<?php require( $theme_path . 'third-party-payment.php' );?>
			    <?php } ?>
				<div class="credit_bln">
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,17V16H9V14H13V13H10A1,1 0 0,1 9,12V9A1,1 0 0,1 10,8H11V7H13V8H15V10H11V11H14A1,1 0 0,1 15,12V15A1,1 0 0,1 14,16H13V17H11Z"></path></svg>
						<h2><?php echo __( 'Your' );?> <?php echo ucfirst( $config->site_name );?> <?php echo __( 'Credits balance' );?></h2>
						<p><span><?php echo (int)$profile->balance;?></span> <?php echo __( 'Credits' );?></p>
					</div>
				</div>
				<hr class="border_hr">
                <?php if(IS_LOGGED == true){ ?>
                    <?php if($config->credit_earn_system == 1){?>
                        <div class="row">
                            <div class="col s12">
                                <h3>Daily Tribute</h3>
                            <?php
                                global $db;
                                if($profile->reward_daily_credit == 1){
                                    $dates = $db->where('user_id', $profile->id)->get('daily_credits',null,array('from_unixtime( max(created_at) ) as DaysFromNow'));
                            ?>
                                    <p><?php echo __( 'Congratulation!. you login to our site for' );?> <?php echo (int)$config->credit_earn_max_days;?> <?php echo __( 'days' );?>, <?php echo __( 'and you earn' );?> <?php echo (int)$config->credit_earn_max_days * (int)$config->credit_earn_day_amount;?> <?php echo __( 'credits' );?> , <span class="time ajax-time age" title="<?php echo $dates[0]['DaysFromNow'];?>"></span></p>
                            <?php } else {
                                    $dates = $db->where('user_id', $profile->id)->get('daily_credits',null,array('count(*) as CountDays','TIMESTAMPDIFF(DAY, from_unixtime( max(created_at) ), from_unixtime( min(created_at) )) as TotalDays','TIMESTAMPDIFF(DAY, now() , from_unixtime( min(created_at) )) as DaysFromNow'));
                            ?>
                                    <p><?php echo __( 'User who logs in consecutively for' );?> <?php echo (int)$config->credit_earn_max_days;?> <?php echo __( 'days' );?>, <?php echo __( 'and you earn' );?> <?php echo (int)$config->credit_earn_max_days * (int)$config->credit_earn_day_amount;?> <?php echo __( 'credits' );?></p>
                                    <p><?php echo __( 'You currently logged in for' );?> <?php echo $dates[0]["CountDays"];?> <?php echo __( 'days' );?></p>
                            <?php } ?>
                            </div>
                        </div>
                        <hr class="border_hr">
                    <?php } ?>
                <?php } ?>
				<div class="row">
					<div class="col s12"><!-- Features -->
						<ul class="credit_ftr">
							<p><?php echo __( 'Use your Credits to' );?></p>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#00bee7" d="M2.81,14.12L5.64,11.29L8.17,10.79C11.39,6.41 17.55,4.22 19.78,4.22C19.78,6.45 17.59,12.61 13.21,15.83L12.71,18.36L9.88,21.19L9.17,17.66C7.76,17.66 7.76,17.66 7.05,16.95C6.34,16.24 6.34,16.24 6.34,14.83L2.81,14.12M5.64,16.95L7.05,18.36L4.39,21.03H2.97V19.61L5.64,16.95M4.22,15.54L5.46,15.71L3,18.16V16.74L4.22,15.54M8.29,18.54L8.46,19.78L7.26,21H5.84L8.29,18.54M13,9.5A1.5,1.5 0 0,0 11.5,11A1.5,1.5 0 0,0 13,12.5A1.5,1.5 0 0,0 14.5,11A1.5,1.5 0 0,0 13,9.5Z" /></svg> <?php echo __( 'Boost your profile' );?>
							</li>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#ff7102" d="M22,12V20A2,2 0 0,1 20,22H4A2,2 0 0,1 2,20V12A1,1 0 0,1 1,11V8A2,2 0 0,1 3,6H6.17C6.06,5.69 6,5.35 6,5A3,3 0 0,1 9,2C10,2 10.88,2.5 11.43,3.24V3.23L12,4L12.57,3.23V3.24C13.12,2.5 14,2 15,2A3,3 0 0,1 18,5C18,5.35 17.94,5.69 17.83,6H21A2,2 0 0,1 23,8V11A1,1 0 0,1 22,12M4,20H11V12H4V20M20,20V12H13V20H20M9,4A1,1 0 0,0 8,5A1,1 0 0,0 9,6A1,1 0 0,0 10,5A1,1 0 0,0 9,4M15,4A1,1 0 0,0 14,5A1,1 0 0,0 15,6A1,1 0 0,0 16,5A1,1 0 0,0 15,4M3,8V10H11V8H3M13,8V10H21V8H13Z" /></svg> <?php echo __( 'Send a gift' );?>
							</li>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#00cdaf" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12C22,10.84 21.79,9.69 21.39,8.61L19.79,10.21C19.93,10.8 20,11.4 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4C12.6,4 13.2,4.07 13.79,4.21L15.4,2.6C14.31,2.21 13.16,2 12,2M19,2L15,6V7.5L12.45,10.05C12.3,10 12.15,10 12,10A2,2 0 0,0 10,12A2,2 0 0,0 12,14A2,2 0 0,0 14,12C14,11.85 14,11.7 13.95,11.55L16.5,9H18L22,5H19V2M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12H16A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8V6Z" /></svg> <?php echo __( 'Get seen 100x in Discover' );?>
							</li>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#8c4fe6" d="M5,16L3,5L8.5,12L12,5L15.5,12L21,5L19,16H5M19,19A1,1 0 0,1 18,20H6A1,1 0 0,1 5,19V18H19V19Z" /></svg> <?php echo __( 'Put yourself First in Search' );?>
							</li>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#0456C4" d="M5.5,2C3.56,2 2,3.56 2,5.5V18.5C2,20.44 3.56,22 5.5,22H16L22,16V5.5C22,3.56 20.44,2 18.5,2H5.5M5.75,4H18.25A1.75,1.75 0 0,1 20,5.75V15H18.5C16.56,15 15,16.56 15,18.5V20H5.75A1.75,1.75 0 0,1 4,18.25V5.75A1.75,1.75 0 0,1 5.75,4M14.44,6.77C14.28,6.77 14.12,6.79 13.97,6.83C13.03,7.09 12.5,8.05 12.74,9C12.79,9.15 12.86,9.3 12.95,9.44L16.18,8.56C16.18,8.39 16.16,8.22 16.12,8.05C15.91,7.3 15.22,6.77 14.44,6.77M8.17,8.5C8,8.5 7.85,8.5 7.7,8.55C6.77,8.81 6.22,9.77 6.47,10.7C6.5,10.86 6.59,11 6.68,11.16L9.91,10.28C9.91,10.11 9.89,9.94 9.85,9.78C9.64,9 8.95,8.5 8.17,8.5M16.72,11.26L7.59,13.77C8.91,15.3 11,15.94 12.95,15.41C14.9,14.87 16.36,13.25 16.72,11.26Z" /></svg> <?php echo __( 'Get additional Stickers' );?>
							</li>
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#f44336" d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" /></svg> <?php echo __( 'Double your chances for a friendship' );?>
							</li>
						</ul>
					</div>
					<div class="col s12"> <!-- Plans -->
						<div class="credit_pln">
							<h2><?php echo __( 'Buy Credits' );?></h2>
							<div class="dt_plans">
								<p>
									<input type="radio" name="plans" id="plan_1" value="<?php echo __( 'Bag of Credits' ) . " " . (int)$config->bag_of_credits_amount;?>" data-price="<?php echo (int)$config->bag_of_credits_price;?>">
									<label for="plan_1" class="plan_1">
										<span class="title"><?php echo __( 'Bag of Credits' );?></span>
										<b><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,17V16H9V14H13V13H10A1,1 0 0,1 9,12V9A1,1 0 0,1 10,8H11V7H13V8H15V10H11V11H14A1,1 0 0,1 15,12V15A1,1 0 0,1 14,16H13V17H11Z"></path></svg> <?php echo (int)$config->bag_of_credits_amount;?></b>
										<img src="<?php echo $theme_url;?>assets/img/credits/bag.svg" alt="<?php echo __( 'Bag of Credits' );?>"/>
										<span class="amount"><?php echo $config->currency_symbol . (int)$config->bag_of_credits_price;?></span>
									</label>
								</p>
								<p>
									<input type="radio" name="plans" id="plan_2" value="<?php echo __( 'Box of Credits' ) . " " .(int)$config->box_of_credits_amount;?>" data-price="<?php echo (int)$config->box_of_credits_price;?>">
									<label for="plan_2" class="plan_2">
										<span class="title"><?php echo __( 'Box of Credits' );?></span>
										<b><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,17V16H9V14H13V13H10A1,1 0 0,1 9,12V9A1,1 0 0,1 10,8H11V7H13V8H15V10H11V11H14A1,1 0 0,1 15,12V15A1,1 0 0,1 14,16H13V17H11Z"></path></svg> <?php echo (int)$config->box_of_credits_amount;?></b>
										<img src="<?php echo $theme_url;?>assets/img/credits/box.svg" alt="<?php echo __( 'Box of Credits' );?>"/>
										<span class="amount"><?php echo $config->currency_symbol . (int)$config->box_of_credits_price;?></span>
									</label>
								</p>
								<p>
									<input type="radio" name="plans" id="plan_3" value="<?php echo __( 'Chest of Credits' ) . " " .(int)$config->chest_of_credits_amount;?>" data-price="<?php echo (int)$config->chest_of_credits_price;?>">
									<label for="plan_3" class="plan_3">
										<span class="title"><?php echo __( 'Chest of Credits' );?></span>
										<b><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,17V16H9V14H13V13H10A1,1 0 0,1 9,12V9A1,1 0 0,1 10,8H11V7H13V8H15V10H11V11H14A1,1 0 0,1 15,12V15A1,1 0 0,1 14,16H13V17H11Z"></path></svg> <?php echo (int)$config->chest_of_credits_amount;?></b>
										<img src="<?php echo $theme_url;?>assets/img/credits/chest.svg" alt="<?php echo __( 'Chest of Credits' );?>"/>
										<span class="amount"><?php echo $config->currency_symbol . (int)$config->chest_of_credits_price;?></span>
									</label>
								</p>
							</div>
							<div class="pay_using hidden">
								<p class="bold"><?php echo __( 'Pay Using' );?></p>
								<div class="pay_u_btns valign-wrapper">
									<?php if ($config->paypal_payment == '1') { ?>
									<button id="paypal" onclick="clickAndDisable(this);" class="btn paypal valign-wrapper">
										<span><?php echo __( 'PayPal' );?></span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M8.32,21.97C8.21,21.92 8.08,21.76 8.06,21.65C8.03,21.5 8,21.76 8.66,17.56C9.26,13.76 9.25,13.82 9.33,13.71C9.46,13.54 9.44,13.54 10.94,13.53C12.26,13.5 12.54,13.5 13.13,13.41C16.38,12.96 18.39,11.05 19.09,7.75C19.13,7.53 19.17,7.34 19.18,7.34C19.18,7.33 19.25,7.38 19.33,7.44C20.36,8.22 20.71,9.66 20.32,11.58C19.86,13.87 18.64,15.39 16.74,16.04C15.93,16.32 15.25,16.43 14.05,16.46C13.25,16.5 13.23,16.5 13,16.65C12.83,16.82 12.84,16.79 12.45,19.2C12.18,20.9 12.08,21.45 12.04,21.55C11.97,21.71 11.83,21.85 11.67,21.93L11.56,22H10C8.71,22 8.38,22 8.32,21.97V21.97M3.82,19.74C3.63,19.64 3.5,19.47 3.5,19.27C3.5,19 6.11,2.68 6.18,2.5C6.27,2.32 6.5,2.13 6.68,2.06L6.83,2H10.36C14.27,2 14.12,2 15,2.2C17.62,2.75 18.82,4.5 18.37,7.13C17.87,10.06 16.39,11.8 13.87,12.43C13,12.64 12.39,12.7 10.73,12.7C9.42,12.7 9.32,12.71 9.06,12.85C8.8,13 8.59,13.27 8.5,13.6C8.46,13.67 8.23,15.07 7.97,16.7C7.71,18.33 7.5,19.69 7.5,19.72L7.47,19.78H5.69C4.11,19.78 3.89,19.78 3.82,19.74V19.74Z" /></svg>
										<svg class="spinner" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="spinner__path" fill="none" stroke-width="7" stroke-linecap="round" cx="33" cy="33" r="29"></circle></svg>
									</button>
									<?php } ?>
									<?php if ($config->stripe_payment == '1') { ?>
									<button id="stripe_credit" class="btn stripe valign-wrapper"><?php echo __( 'Card' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" /></svg></button>
									<?php } ?>
<!--									<button id="stripe_credit_btn" class="hide"></button>-->
                                    <?php if($config->bank_payment == '1'){?>
                                        <button id="bank_transfer" class="btn valign-wrapper bank"><?php echo __( 'Bank Transfer' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15,14V11H18V9L22,12.5L18,16V14H15M14,7.7V9H2V7.7L8,4L14,7.7M7,10H9V15H7V10M3,10H5V15H3V10M13,10V12.5L11,14.3V10H13M9.1,16L8.5,16.5L10.2,18H2V16H9.1M17,15V18H14V20L10,16.5L14,13V15H17Z"></path></svg></button>
                                    <?php } ?>
                                    <?php if($config->paysera_payment == '1'){?>
                                    <button id="sms_payment" onclick="PayViaSms();" class="btn valign-wrapper sms"><?php echo __( 'SMS' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17,19V5H7V19H17M17,1A2,2 0 0,1 19,3V21A2,2 0 0,1 17,23H7C5.89,23 5,22.1 5,21V3C5,1.89 5.89,1 7,1H17M9,7H15V9H9V7M9,11H13V13H9V11Z"></path></svg></button>
                                    <?php } ?>

                                    <?php if( $config->cashfree_payment === 'yes' && !empty($config->cashfree_client_key) && !empty($config->cashfree_secret_key)){?>
                                        <button id="cashfree_payment" onclick="PayViaCashfree();" class="btn valign-wrapper cashfree"><?php echo __( 'cashfree' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" /></svg></button>
                                    <?php } ?>
                                    <?php if ($config->iyzipay_payment == "yes" && !empty($config->iyzipay_key) && !empty($config->iyzipay_secret_key)) { ?>
                                        <button id="iyzipay-button1" class="valign-wrapper btn btn-iyzipay-payment iyzipay" onclick="PayViaIyzipay();">
                                            <?php echo __( 'Iyzipay');?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" /></svg>
                                        </button>
                                    <?php } ?>
                                    <?php if ($config->paystack_payment == "yes" && !empty($config->paystack_secret_key)) { ?>
                                        <button id="paystack-button1" class="valign-wrapper btn btn-paystack-payment paystack" onclick="PayPaystack();">
                                            <?php echo __( 'PayStack');?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" /></svg>
                                        </button>
                                    <?php } ?>
                                    <?php if ($config->authorize_payment == "yes") { ?>
                                        <button id="authorize-button1" class="valign-wrapper btn btn-authorize-payment authorize" onclick="PayAuthorize();">
                                            <?php echo __( 'Authorize.net');?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" /></svg>
                                        </button>
                                    <?php } ?>
                                    <?php if ($config->securionpay_payment == "yes") { ?>
                                        <button id="securionpay-button1" class="valign-wrapper btn btn-securionpay-payment securionpay" onclick="PaySecurionpay();">
											<?php echo __( 'Securionpay');?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20,8H4V6H20M20,18H4V12H20M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z" /></svg>
                                        </button>
                                    <?php } ?>
                                    <?php if ($config->checkout_payment == 'yes') { ?>
                                        <button id="2co_credit" class="btn 2co valign-wrapper twoco"  onclick="PayVia2Co();">
                                            <?php echo __( '2Checkout' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M9,7V9H13V11H11A2,2 0 0,0 9,13V17H11L15,17V15H11V13H13A2,2 0 0,0 15,11V9A2,2 0 0,0 13,7H9M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2Z" /></svg>
                                        </button>
                                    <?php } ?>
                                    <?php if ($config->coinbase_payment == '1') { ?>
										<button class="btn-coinbase btn valign-wrapper coinbase" onclick="pay_using_coinbase();">
											<?php echo __( 'coinbase' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zm-141.651-35.33c4.937-32.999-20.191-50.739-54.55-62.573l11.146-44.702-27.213-6.781-10.851 43.524c-7.154-1.783-14.502-3.464-21.803-5.13l10.929-43.81-27.198-6.781-11.153 44.686c-5.922-1.349-11.735-2.682-17.377-4.084l.031-.14-37.53-9.37-7.239 29.062s20.191 4.627 19.765 4.913c11.022 2.751 13.014 10.044 12.68 15.825l-12.696 50.925c.76.194 1.744.473 2.829.907-.907-.225-1.876-.473-2.876-.713l-17.796 71.338c-1.349 3.348-4.767 8.37-12.471 6.464.271.395-19.78-4.937-19.78-4.937l-13.51 31.147 35.414 8.827c6.588 1.651 13.045 3.379 19.4 5.006l-11.262 45.213 27.182 6.781 11.153-44.733a1038.209 1038.209 0 0 0 21.687 5.627l-11.115 44.523 27.213 6.781 11.262-45.128c46.404 8.781 81.299 5.239 95.986-36.727 11.836-33.79-.589-53.281-25.004-65.991 17.78-4.098 31.174-15.792 34.747-39.949zm-62.177 87.179c-8.41 33.79-65.308 15.523-83.755 10.943l14.944-59.899c18.446 4.603 77.6 13.717 68.811 48.956zm8.417-87.667c-7.673 30.736-55.031 15.12-70.393 11.292l13.548-54.327c15.363 3.828 64.836 10.973 56.845 43.035z"/></svg>
										</button>
									<?php } ?>
                                    <?php if ($config->yoomoney_payment == '1') { ?>
										<button class="btn-yoomoney btn valign-wrapper yoomoney" onclick="pay_using_yoomoney();">
											<?php echo __( 'yoomoney' );?> <svg width="57" height="40" viewBox="0 0 57 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M36.33 0c-11.14 0-20 8.987-20 20 0 11.14 8.987 20 20 20 11.012 0 20-8.987 20-20s-8.988-20-20-20zm0 27.342c-4.051 0-7.47-3.418-7.47-7.469 0-4.05 3.419-7.468 7.47-7.468 4.05 0 7.468 3.418 7.468 7.468-.127 4.178-3.418 7.469-7.469 7.469zM16.203 5.696V34.81h-7.09L0 5.696h16.203z" fill="currentColor"/></svg>
										</button>
									<?php } ?>
									<?php if ($config->razorpay_payment == '1') { ?>
										<button class="btn-razorpay btn valign-wrapper razorpay" onclick="pay_using_razorpay();">
											<?php echo __( 'razorpay' );?> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 284 324" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g> <polygon id="Fill-17" fill="currentColor" points="122.6338 105.6902 106.8778 163.6732 197.0338 105.3642 138.0748 325.3482 197.9478 325.4032 285.0458 0.4822"/> <path d="M25.5947,232.9246 L0.8077,325.4026 L123.5337,325.4026 C123.5337,325.4026 173.7317,137.3196 173.7457,137.2656 C173.6987,137.2956 25.5947,232.9246 25.5947,232.9246" fill="currentColor"/> </g> </g> </svg>
										</button>
									<?php } ?>
									<?php if ($config->fortumo_payment == '1') { ?>
										<button class="btn-fortumo btn valign-wrapper fortumo" onclick="pay_using_fortumo();">
											<?php echo __( 'fortumo' );?> <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="300.000000pt" height="300.000000pt" viewBox="0 0 300.000000 300.000000" preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none"> <path d="M1518 2850 c-210 -38 -411 -160 -524 -318 -92 -127 -119 -269 -71 -363 30 -59 286 -340 302 -331 6 4 110 83 231 177 271 210 339 277 396 391 39 78 42 94 46 178 5 111 -14 167 -71 210 -65 50 -205 75 -309 56z"/> <path d="M2210 2306 c-132 -28 -263 -84 -359 -154 -100 -73 -511 -407 -509 -413 2 -4 52 -60 112 -126 285 -309 336 -352 480 -400 75 -25 93 -27 246 -27 151 0 173 3 255 28 565 172 752 736 333 1006 -101 66 -199 92 -358 96 -88 2 -158 -1 -200 -10z"/> <path d="M545 2120 c-224 -48 -439 -243 -516 -470 -30 -89 -31 -208 -3 -270 77 -167 300 -200 517 -78 31 18 170 125 308 237 l250 204 -24 26 c-13 14 -78 90 -145 167 -102 118 -130 145 -172 163 -57 25 -155 34 -215 21z"/> <path d="M947 1421 c-294 -241 -349 -298 -416 -435 -100 -202 -108 -405 -22 -575 95 -187 305 -293 518 -261 290 44 529 270 604 569 17 69 21 105 17 190 -6 120 -28 195 -82 276 -31 47 -362 435 -371 435 -2 0 -114 -90 -248 -199z"/> </g> </svg>
										</button>
									<?php } ?>
									<?php if ($config->coinpayments == '1') { ?>
										<button class="btn-coinpayments btn valign-wrapper coinpayments" onclick="pay_using_coinpayments();">
											<?php echo __( 'coinpayments' );?> <svg xmlns="http://www.w3.org/2000/svg" width="196" height="46" viewBox="0 0 38 45" fill="none"> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M0.161987 18.9846L1.44177 14.0873L10.4551 8.86938V15.407L0.161987 21.8952V18.9846Z" fill="currentColor"/> <path opacity="0.7" fill-rule="evenodd" clip-rule="evenodd" d="M4.42798 19.1574L14.5777 12.8464V18.0292C14.5777 18.0292 14.4234 19.7398 13.6814 20.0584C13.1328 20.2823 4.43068 25.4312 4.43068 25.4312L4.42798 19.1574Z" fill="currentColor"/> <path opacity="0.9" fill-rule="evenodd" clip-rule="evenodd" d="M9.95569 22.2194L18.9784 16.9021V22.0842C18.9784 22.0842 18.9784 23.5168 18.0822 24.0207C17.5038 24.3299 9.95772 28.7219 9.95772 28.7219L9.95569 22.2194Z" fill="currentColor"/> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M13.6947 7.01864L18.6555 3.82056V10.3547L13.6994 13.3878L13.6947 7.01864Z" fill="currentColor"/> <path opacity="0.7" fill-rule="evenodd" clip-rule="evenodd" d="M17.7343 10.9115L22.7195 7.96704V14.7312L17.7322 17.6277L17.7343 10.9115Z" fill="currentColor"/> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M21.5567 2.07729L24.9517 0V4.50631C24.9517 4.50631 24.9517 6.76082 24.0554 7.212C23.8829 7.30331 21.575 8.64668 21.575 8.64668L21.5567 2.07729Z" fill="currentColor"/> <path opacity="0.9" fill-rule="evenodd" clip-rule="evenodd" d="M21.6464 15.2719L25.0285 13.2427L24.9507 18.4207C24.9507 18.4207 25.0285 19.7864 24.0545 20.4499C23.8299 20.6495 21.5267 21.771 21.5673 21.7933C21.6079 21.8156 21.6329 15.0886 21.6464 15.2719Z" fill="currentColor"/> <path opacity="0.7" fill-rule="evenodd" clip-rule="evenodd" d="M25.6279 6.30849L28.3336 4.51733C28.3336 4.51733 28.3607 7.20407 28.3336 9.02432C28.3137 9.57723 28.1847 10.1207 27.9541 10.6236C27.7234 11.1264 27.3956 11.5788 26.9896 11.9546C26.9896 11.9546 25.5901 12.8258 25.6327 12.8502C25.6753 12.8745 25.6279 6.30849 25.6279 6.30849Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M10.455 8.86499C10.4131 8.95292 2.18034 13.0385 0.932341 14.44C1.56885 13.903 0.391204 14.9704 0.25592 16.5782L0.647567 31.6888C0.647567 31.6888 0.0184966 34.3038 3.11109 36.0814C5.31622 37.349 18.0708 44.5901 19.6367 45.3267C21.2026 46.0634 21.6065 44.8992 21.6065 44.8992V30.2324C21.5726 30.1925 22.0739 27.915 19.3898 26.1976C18.8744 25.7498 2.34741 18.2219 1.64529 15.8517C0.891079 13.3064 10.455 9.52315 10.455 8.86499Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8377 30.1024L21.6426 29.52V45.1453C21.6426 45.1453 21.2543 45.9266 20.8377 46.001C20.7883 45.9753 20.8377 30.1024 20.8377 30.1024Z" fill="currentColor"/> <path d="M1.07855 16.3644C1.1929 16.546 1.32403 16.7165 1.47019 16.8737C1.30482 16.6911 1.16592 16.4862 1.05758 16.2649C0.0835329 13.7527 7.14537 10.928 10.0878 9.04077C10.0878 9.04077 2.94547 12.5872 1.52972 13.8244C0.278342 14.9175 0.188378 15.5784 0.188378 15.5784L0.0375366 16.5017C0.0686516 16.0539 0.0787979 15.6541 0.188378 15.5784C0.17485 15.6562 1.06705 16.2474 1.07855 16.3644Z" fill="currentColor"/> <path d="M18.6372 26.8178C18.0568 26.3274 10.65 22.9405 5.5282 19.8777C5.83259 20.0698 6.10383 20.2382 6.31691 20.3789L18.4492 44.776C18.7049 44.9113 18.8976 45.0202 19.0451 45.0892L20.8376 45.9848V30.3128C20.8153 30.2952 21.0162 28.1314 18.6372 26.8178Z" fill="currentColor"/> <path opacity="0.3" d="M0.5538 33.7224C0.276449 33.1509 0.0897757 32.5398 0.000488281 31.9109C0.0277243 32.5519 0.218175 33.1755 0.5538 33.7224Z" fill="currentColor"/> <path d="M5.52811 19.8778C3.7153 18.805 2.21365 17.7484 1.46959 16.8751C1.32361 16.7177 1.19272 16.547 1.07861 16.3651C1.06509 16.2481 0.19927 15.5744 0.222268 15.4939C0.112688 15.5703 0.0430172 16.0445 0.0119019 16.495L0.0355766 31.9059C0.123511 33.047 0.211446 33.091 0.514482 33.7207C0.957536 34.4073 1.1767 34.6677 1.96675 35.3725C3.8215 36.5055 15.3058 43.0742 18.4653 44.7748L6.31681 20.3722L5.52811 19.8778Z" fill="currentColor"/> <path opacity="0.2" d="M5.50781 19.8692C3.69501 18.7964 2.19335 17.7399 1.44929 16.8666C1.30979 16.7085 1.18568 16.5375 1.07861 16.3559C1.06509 16.2396 0.195888 15.5658 0.222268 15.4854C0.168155 15.5374 0.0673683 16.1408 0.036253 16.5906L0.0119019 31.9535C0.0558692 32.9133 0.243237 33.1792 0.519217 33.7514C0.914245 34.4096 1.42224 34.9013 1.99516 35.364C3.85058 36.497 15.2861 43.0657 18.4457 44.7662L6.29652 20.3637L5.50781 19.8692Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M18.225 33.1678L15.7039 31.612C15.2562 31.3522 14.8246 31.52 15.0458 31.9793V36.1656C15.1533 36.3205 15.3705 36.8218 15.2697 37.0747C14.9085 37.0572 16.7037 38.5629 17.7183 39.1304C18.0139 39.2961 18.5652 39.3651 18.5226 38.6826V33.7096C18.5239 33.6012 18.4968 33.4944 18.4441 33.3998C18.3921 33.3049 18.3167 33.225 18.225 33.1678Z" fill="currentColor"/> <path fill-rule="evenodd" clip-rule="evenodd" d="M18.1177 33.4176C17.7254 32.9292 16.4145 32.1791 15.525 31.5372C15.3011 31.3735 14.9114 31.4898 14.9162 31.7611C14.9723 34.9287 14.9838 36.3864 15.1671 37.0067C15.3024 37.4802 16.7872 38.4752 17.6313 39.0359C17.8823 39.2057 18.2212 39.2463 18.232 38.9392C18.2794 37.6073 18.232 34.5175 18.232 33.7274C18.2282 33.6138 18.1873 33.5045 18.1157 33.4163L18.1177 33.4176Z" fill="currentColor"/> </svg>
										</button>
									<?php } ?>
									<?php if ($config->ngenius_payment == '1') { ?>
										<button class="btn-ngenius_payment btn valign-wrapper ngenius_payment" onclick="pay_using_ngenius();">
											<?php echo __( 'ngenius' );?> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" /></svg>
										</button>
									<?php } ?>
									<?php if ($config->aamarpay_payment == '1') { ?>
										<button class="btn-aamarpay_payment btn valign-wrapper aamarpay_payment" onclick="pay_using_aamarpay();">
											<?php echo __( 'aamarpay' );?> <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="64.000000pt" height="73.000000pt" viewBox="0 0 64.000000 73.000000" preserveAspectRatio="xMidYMid meet"> <g transform="translate(0.000000,73.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none"> <path d="M342 533 l3 -108 120 -5 c66 -3 122 -5 123 -4 2 2 -34 27 -80 56 -62 41 -93 69 -122 111 -22 31 -41 57 -43 57 -2 0 -2 -48 -1 -107z"/> <path d="M67 432 c8 -20 23 -53 33 -72 14 -28 17 -51 13 -110 l-5 -75 53 59 c102 112 103 94 -11 169 l-99 66 16 -37z"/> </g> </svg>
										</button>
									<?php } ?>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Credits  -->
<div class="modal fade" id="aamarpay_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content add_money_modal add_address_modal">
            <h5 class="modal-title text-center"><?php echo __( 'aamarpay' );?></h5>
            <div class="modal-body">
                <div id="aamarpay_alert" style="    color: red;"></div>
                <form id="aamarpay_form" method="post">
                    <div class="form-group">
                        <input class="form-control shop_input" type="text" placeholder="<?php echo __( 'Name' );?>"  value="<?php echo $profile->full_name;?>" id="aamarpay_name">
                    </div>
                    <div class="form-group">
                        <input class="form-control shop_input" type="email" placeholder="<?php echo __( 'Email' );?>" value="" data-email="<?php echo base64_encode($profile->email);?>" id="aamarpay_email">
                    </div>
                    <div class="form-group">
                        <input id="aamarpay_number" class="form-control shop_input" type="text" placeholder="<?php echo __( 'phone' );?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-main" onclick="AamarpayRequest()" id="aamarpay_button"><?php echo __( 'Pay' );?></button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo __( 'Cancel' );?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<a href="javascript:void(0);" id="btnProSuccess" style="visibility: hidden;display: none;"></a>

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

<div class="modal fade" id="stripe_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content add_money_modal add_address_modal">
            <h5 class="modal-title text-center">Stripe</h5>
            <div class="modal-body">
                <div id="stripe_alert" style="    color: red;"></div>
                <form id="stripe_form" method="post">
                    <div class="form-group">
                        <input class="form-control shop_input" type="text" placeholder="<?php echo __( 'Name' );?>"  value="<?php echo $profile->full_name;?>" id="stripe_name">
                    </div>
                    <div class="form-group">
                        <input class="form-control shop_input" type="email" placeholder="<?php echo __( 'Email' );?>" value="" data-email="<?php echo base64_encode($profile->email);?>" id="stripe_email">
                    </div>
                    <div class="form-group">
                        <input id="stripe_number" class="form-control shop_input" type="text" placeholder="<?php echo __( 'Card Number' );?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="stripe_month" type="text" class="form-control shop_input" autocomplete="off" placeholder="<?php echo __( 'Month' );?> (01)">
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="stripe_year" type="text" class="form-control shop_input" autocomplete="off" placeholder="<?php echo __( 'Year' );?> (2019)">
                                    <?php for ($i=date('Y'); $i <= date('Y')+15; $i++) {  ?>
                                        <option value="<?php echo($i) ?>"><?php echo($i) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="stripe_cvc" type="text" class="form-control shop_input" autocomplete="off" placeholder="CVC" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-main" onclick="SH_StripeRequest()" id="stripe_button"><?php echo __( 'Pay' );?></button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><?php echo __( 'Cancel' );?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="stripe_mcodal modal modal-fixed-footer">
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
<?php if ($config->razorpay_payment == '1' && !empty($config->razorpay_key_id)) { ?>
<div class="modal fade" id="razorpay_modal" role="dialog" data-keyboard="false" style="overflow-y: auto;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></span></button>
				<h4 class="modal-title"><?php echo __( 'razorpay' );?></h4>
			</div>
			<form class="form form-horizontal" method="post" id="razorpay_form" action="#">
				<div class="modal-body twocheckout_modal">
					<div id="razorpay_alert"></div>
					<div class="clear"></div>
					<div class="sun_input col-md-6">
						<input id="razorpay_name" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __( 'name' );?>">
					</div>
					<div class="sun_input col-md-6">
						<input id="razorpay_email" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __( 'email' );?>">
					</div>
					<div class="sun_input col-md-6">
						<input id="razorpay_phone" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __( 'phone_number' );?>">
					</div>
					<input type="hidden" name="razorpay_type" id="razorpay_type">
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<div class="modal-footer">
					<div class="ball-pulse"><div></div><div></div><div></div></div>
					<button type="button" class="btn btn-main" id="razorpay_btn" onclick="SignatureRazorpay()"><?php echo __( 'pay' );?></button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<?php } ?>

<script>
<?php if ($config->aamarpay_payment == '1') { ?>
	function pay_using_aamarpay() {
		$('#aamarpay_modal').modal('open');
	}
	function AamarpayRequest() {
		$('#aamarpay_button').html("<?php echo __('please_wait');?>");
		$('#aamarpay_button').attr('disabled','true');
		plans = document.getElementsByName('plans');
		var price = 0;
	    var description = '';
	    for (index = 0; index < plans.length; index++) {
	        if (plans[index].checked) {
	            description = plans[index].value;
	            price = plans[index].getAttribute('data-price');
	            break;
	        }
	    }
		$.post(window.ajax + 'aamarpay/get',{price:price,name:$('#aamarpay_name').val(),email:$('#aamarpay_email').val(),phone:$('#aamarpay_number').val()}, function (data) {
			$('#aamarpay_button').removeAttr('disabled');
	        $('#aamarpay_button').text("<?php echo __('Pay');?>");
	        if (data.status == 200) {
	        	location.href = data.url;
	        }
	    }).fail(function(data) {
	    	$('#aamarpay_button').removeAttr('disabled');
	        $('#aamarpay_button').text("<?php echo __('Pay');?>");
    		M.toast({html: data.responseJSON.message});
		});
		
	}
<?php } ?>
<?php if ($config->ngenius_payment == '1') { ?>
	function pay_using_ngenius() {
		plans = document.getElementsByName('plans');
		var price = 0;
	    var description = '';
	    for (index = 0; index < plans.length; index++) {
	        if (plans[index].checked) {
	            description = plans[index].value;
	            price = plans[index].getAttribute('data-price');
	            break;
	        }
	    }
		$.post(window.ajax + 'ngenius/get',{price:price}, function (data) {
	        if (data.status == 200) {
	        	location.href = data.url;
	        }
	    }).fail(function(data) {
    		M.toast({html: data.responseJSON.message});
		});
	}
<?php } ?>
<?php if ($config->coinpayments == '1') { ?>
	function pay_using_coinpayments() {
		plans = document.getElementsByName('plans');
		var price = 0;
	    var description = '';
	    for (index = 0; index < plans.length; index++) {
	        if (plans[index].checked) {
	            description = plans[index].value;
	            price = plans[index].getAttribute('data-price');
	            break;
	        }
	    }
		$.post(window.ajax + 'coinpayments/get',{price:price}, function (data) {
	        if (data.status == 200) {
	        	location.href = data.url;
	        }
	    }).fail(function(data) {
    		M.toast({html: data.responseJSON.message});
		});
	}
<?php } ?>
<?php if ($config->fortumo_payment == '1' && !empty($config->fortumo_service_id)) { ?>
	function pay_using_fortumo() {
		$.post(window.ajax + 'fortumo/get', function (data) {
	        if (data.status == 200) {
	        	location.href = data.url;
	        }
	    }).fail(function(data) {
    		M.toast({html: data.responseJSON.message});
		});
	}
<?php } ?>
<?php if ($config->razorpay_payment == '1' && !empty($config->razorpay_key_id)) { ?>
	function pay_using_razorpay() {
		$("#razorpay_alert").html('');
		$('#razorpay_modal').modal('open');
	}
	function SignatureRazorpay() {
		$('#razorpay_btn').html("<?php echo __('please_wait');?>");
		$('#razorpay_btn').attr('disabled','true');
	    var merchant_order_id = "<?php echo(round(111111,9999999)) ?>";
	    var card_holder_name_id = $('#razorpay_name').val();
	    var email = $('#razorpay_email').val();
	    var phone = $('#razorpay_phone').val();
	    var currency_code_id = "INR";

	    if (!email || !phone || !card_holder_name_id) {
	    	$('#razorpay_alert').html("<div class='alert alert-danger'><?php echo(__('please check your details')) ?></div>");
			setTimeout(function () {
				$('#razorpay_alert').html("");
			},3000);
			$('#razorpay_btn').html("<?php echo __('pay');?>");
			$('#razorpay_btn').removeAttr('disabled');
			return false;
	    }
	    plans = document.getElementsByName('plans');
	    var price = 0;
	    var description = '';
	    for (index = 0; index < plans.length; index++) {
	        if (plans[index].checked) {
	            description = plans[index].value;
	            price = plans[index].getAttribute('data-price');
	            break;
	        }
	    }


	    price = price * 100;
	    
	    var razorpay_options = {
	        key: "<?php echo $config->razorpay_key_id; ?>",
	        amount: price,
	        name: "<?php echo $config->site_name; ?>",
	        description: getDescription(),
	        image: "<?php echo $config->sitelogo;?>",
	        netbanking: true,
	        currency: currency_code_id,
	        prefill: {
	            name: card_holder_name_id,
	            email: email,
	            contact: phone
	        },
	        notes: {
	            soolegal_order_id: merchant_order_id,
	        },
	        handler: function (transaction) {
	            jQuery.ajax({
	                url: window.ajax + 'razorpay/create',
	                type: 'post',
	                data: {payment_id: transaction.razorpay_payment_id, order_id: merchant_order_id, card_holder_name_id: card_holder_name_id,  merchant_amount: price, currency: currency_code_id}, 
	                dataType: 'json',
	                success: function (data) {
	                	if (data.status == 200) {
	                		<?php if (!empty($_COOKIE['redirect_page'])) { 
	                			$redirect_page = preg_replace('/on[^<>=]+=[^<>]*/m', '', $_COOKIE['redirect_page']);
						        $redirect_page = preg_replace('/\((.*?)\)/m', '', $redirect_page);
	                			?>
	                			window.location = "<?php echo($redirect_page); ?>";
	                		<?php }else{ ?>
		                		window.location = data.url;
	                	    <?php } ?>
	                	}
	                	else{
	                		if (data.url != '') {
	                			window.location = data.url;
	                		}
	                		else{
	                			$('#razorpay_alert').html("<div class='alert alert-danger'>"+data.message+"</div>");
								setTimeout(function () {
									$('#razorpay_alert').html("");
								},3000);
								$('#razorpay_btn').html("<?php echo __('pay');?>");
								$('#razorpay_btn').removeAttr('disabled');

	                		}
	                	}
	                }
	            });
	        },
	        "modal": {
	            "ondismiss": function () {
	                // code here
	            }
	        }
	    };
	    // obj        
	    var objrzpv1 = new Razorpay(razorpay_options);
	    objrzpv1.open();
	    e.preventDefault();
	}
<?php } ?>
<?php if ($config->yoomoney_payment == '1' && !empty($config->yoomoney_wallet_id)) { ?>
	function pay_using_yoomoney() {
	    plans = document.getElementsByName('plans');
	    var price = 0;
	    var description = '';
	    for (index = 0; index < plans.length; index++) {
	        if (plans[index].checked) {
	            description = plans[index].value;
	            price = plans[index].getAttribute('data-price');
	            break;
	        }
	    }
	    $.post(window.ajax + 'yoomoney/create',{price:price,description:description}, function (data) {
	        if (data.status == 200) {
	        	$('body').append(data.html);
				document.getElementById("yoomoney_form").submit();
				$("#yoomoney_form").remove();
	        }
	    }).fail(function(data) {
    		M.toast({html: data.responseJSON.message});
		});
	}
<?php } ?>
<?php if ($config->coinbase_payment == '1' && !empty($config->coinbase_key)) { ?>
	function pay_using_coinbase() {
	    plans = document.getElementsByName('plans');
	    var price = 0;
	    var description = '';
	    for (index = 0; index < plans.length; index++) {
	        if (plans[index].checked) {
	            description = plans[index].value;
	            price = plans[index].getAttribute('data-price');
	            break;
	        }
	    }
	    $.post(window.ajax + 'coinbase/create',{price:price,description:description}, function (data) {
	        if (data.status == 200) {
	            window.location.href = data.url;
	        }
	    }).fail(function(data) {
    		M.toast({html: data.responseJSON.message});
		});
	}
<?php } ?>
<?php if ($config->securionpay_payment == 'yes') { ?>
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
    function PaySecurionpay(){
    	price = getPrice();
    	$.post(window.ajax + 'securionpay/token', {type:'credit',price:price}, function(data, textStatus, xhr) {
    		if (data.status == 200) {
    			SecurionpayCheckout.open({
					checkoutRequest: data.token,
					name: 'Credits',
					description: getDescription()
				});
    		}
    	}).fail(function(data) {
    		M.toast({html: data.responseJSON.message});
		});
    }
<?php } ?>

<?php if ($config->authorize_payment == 'yes') { ?>
    function PayAuthorize(){
        $('#authorize_btn').attr('onclick', 'AuthorizeWalletRequest()');
        $('#authorize_modal').modal('open');
    }
    function AuthorizeWalletRequest() {
		$('#authorize_btn').html("<?php echo __('please_wait');?>");
	    $('#authorize_btn').attr('disabled','true');
		authorize_number = $('#authorize_number').val();
		authorize_month = $('#authorize_month').val();
		authorize_year = $('#authorize_year').val();
		authorize_cvc = $('#authorize_cvc').val();
		price = getPrice();
		$.post(window.ajax + 'authorize/pay', {type:'credit',card_number:authorize_number,card_month:authorize_month,card_year:authorize_year,card_cvc:authorize_cvc,price:price}, function(data) {
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

<?php if ($config->paystack_payment == 'yes') { ?>
    function PayPaystack(){
        $('#paystack_btn').attr('onclick', 'InitializeWalletPaystack()');
        $('#paystack_wallet_modal').modal('open');
    }
    function InitializeWalletPaystack() {
		$('#paystack_btn').html("<?php echo __('please_wait');?>");
	    $('#paystack_btn').attr('disabled','true');
		email = $('#paystack_wallet_email').val();
		price = getPrice();
		$.post(window.ajax + 'paystack/initialize', {type:'credit',email:email,price:price}, function(data) {
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
<?php } ?>

<?php if ($config->checkout_payment == 'yes') { ?>
    function PayVia2Co(){
        $('#2checkout_type').val('credits');
        $('#2checkout_description').val(getDescription());
        $('#2checkout_price').val(getPrice());

        $('#2checkout_modal').modal('open');
    }
<?php } ?>

<?php if ($config->iyzipay_payment == "yes" && !empty($config->iyzipay_key) && !empty($config->iyzipay_secret_key)) { ?>
	function PayViaIyzipay(){
		$('.btn-iyzipay-payment').attr('disabled','true');

		$.post(window.ajax + 'iyzipay/createsession', {
            payType: 'credits',
            description: getDescription(),
            price: getPrice()
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
<?php } ?>

function PayViaCashfree(){

    $('.cashfree-payment').attr('disabled','true');

    $('#cashfree_type').val('credits');
    $('#cashfree_description').val(getDescription());
    $('#cashfree_price').val(getPrice());

    $("#cashfree_alert").html('');
    $('.go_pro--modal').fadeOut(250);
    $('#cashfree_modal_box').modal('open');

    $('.btn-cashfree-payment').removeAttr('disabled');
}

function PayViaSms() {
    window.location = window.ajax + 'sms/generate_credit_link?price=' + getPrice() + '00';
}

function getDescription() {
    var plans = document.getElementsByName('plans');
    for (index=0; index < plans.length; index++) {
        if (plans[index].checked) {
            return plans[index].value;
            break;
        }
    }
}

function getPrice() {
    var plans = document.getElementsByName('plans');
    for (index=0; index < plans.length; index++) {
        if (plans[index].checked) {
            return plans[index].getAttribute('data-price');
            break;
        }
    }
}

document.getElementById('paypal').addEventListener('click', function(e) {
    $.post(window.ajax + 'paypal/generate_link', {description:getDescription(), amount:getPrice(), mode: "credits"}, function (data) {
        if (data.status == 200) {
            window.location.href = data.location;
        } else {
            $('.modal-body').html('<i class="fa fa-spin fa-spinner"></i> <?php echo __( 'Payment declined' );?> ');
        }
    });
        
    e.preventDefault();
});

document.getElementById('bank_transfer').addEventListener('click', function(e) {
    $('#bank_transfer_price').text('<?php echo $config->currency_symbol;?>' + getPrice());
    $('#bank_transfer_description').text(getDescription());
    $('#receipt_img_path').html('');
    $('#receipt_img_preview').attr('src', '');
	$('.bank_transfer_modal').removeClass('up_rec_img_ready, up_rec_active');
    $('.bank_transfer_modal').modal('open');
});

document.getElementById('stripe_credit').addEventListener('click', function(e) {

    $('#stripe_email').val(atob($('#stripe_email').attr('data-email')));
    $('#stripe_number').val('');
    $('#stripe_cvc').val('');
    $('#stripe_modal').removeClass('up_rec_img_ready, up_rec_active');
    //$('#stripe_modal').modal('open');

    $.post(window.ajax + 'stripe/createsession', {
        payType: 'credits',
        description: getDescription(),
        price: getPrice()
    }, function (data) {
        if (data.status == 200) {
            stripe.redirectToCheckout({ sessionId: data.session_id });
        } else {
            // $('.modal-body').html('<i class="fa fa-spin fa-spinner"></i> <?php echo __('Payment declined');?> ');
        }
    });
});

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
        formData.append("description", getDescription());
        formData.append("price", getPrice());
        formData.append("mode", 'credits');
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
                M.toast({html: '<?php echo __('Your receipt uploaded successfully.');?>'});
                return false;
            }
        }
    });
});
</script>
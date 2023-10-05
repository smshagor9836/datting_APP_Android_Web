    <?php if(IS_LOGGED == true){ ?>
        <div id="pay_modal_wallet">
            <div class="modal modal-sm" id="pay-go-pro" role="dialog" data-keyboard="false">
				<div class="modal-content">
					<h6 class="bold"><?php echo __( 'pay_from_credits' );?></h6>

					<div class="pay_modal_wallet_alert"></div>
					<p class="pay_modal_wallet_text"></p>

					<div class="clear"></div>
					<div class="modal-footer">
						<div class="ball-pulse"><div></div><div></div><div></div></div>
						<button type="button" class="btn waves-effect waves-light btn-flat btn_primary white-text btn-main" id="pay_modal_wallet_btn"><?php echo __( 'pay' );?></button>
					</div>
				</div>
            </div>
        </div>

        <?php if($config->credit_earn_system == 1){?>
        <div class="payment_modal modal" id="reward_daily_credit_modal">
            <div class="modal-dialog">
                <div class="modal-content dt_bank_trans_modal">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo __( 'Credit Reward' );?></h5>
                    </div>
                    <div class="modal-body  credit_pln">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"></circle><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path></svg>
                        <p><?php echo __( 'Congratulation!. you login to our site for' );?> <?php echo (int)$config->credit_earn_max_days;?> <?php echo __( 'days' );?>, <?php echo __( 'and you earn' );?> <?php echo (int)$config->credit_earn_max_days * (int)$config->credit_earn_day_amount;?> <?php echo __( 'credits' );?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php if($config->isDailyCredit){ ?>
            <script>
                $(document).ready(function() {
                    $('#reward_daily_credit_modal').modal({
                        onCloseEnd: function(){
                            window.location.href = window.site_url+'/credit';
                        }
                    }).modal("open");

                });
            </script>
        <?php }} ?>
        <div class="payment_modalx modal modal-sm">
			<div class="modal-content">
				<h6 class="bold"><?php echo __( 'Unlock Private Photo Payment' );?></h6>
				<div class="modal-body">
					<p><?php echo __( 'To unlock private photo feature in your account, you have to pay' );?> <?php echo $config->currency_symbol . (int)$config->lock_private_photo_fee;?>.</p>

					<div class="modal-footer">
						<button onclick="PayUsingWallet('private_photo','show');" class="btn waves-effect waves-light btn-flat btn_primary white-text btn-main"><?php echo __( 'Pay Using' );?></button>
					</div>
				</div>
			</div>
        </div>


        <?php if(IS_LOGGED === true){ ?>
            <?php if ($config->checkout_payment == 'yes') { ?>
                <div class="modal modal-sm" id="2checkout_modal" role="dialog" data-keyboard="false" style="overflow-y: auto;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <h4 class="modal-title"><?php echo __('Check out');?></h4>
                            <form class="form form-horizontal" method="post" id="2checkout_form" action="#">
                                <div class="modal-body twocheckout_modal">
                                    <div id="2checkout_alert"></div>
                                    <div class="clear"></div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="card_name" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __('name');?>" value="<?php echo $profile->full_name;?>">
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="card_address" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __('address');?>" value="<?php echo $profile->address;?>">
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="card_city" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __('city');?>" value="<?php echo $profile->city;?>">
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="card_state" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __('state');?>" value="<?php echo $profile->state;?>">
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="card_zip" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __('zip');?>" value="<?php echo $profile->zip;?>">
                                        </div>
                                        <div class="input-field col s6">
                                            <select id="card_country" name="card_country" class="browser-default">
                                                <option value="" disabled selected><?php echo __( 'Choose your country' );?></option>
                                                <?php
                                                $_countries = Dataset::load('countries');
                                                foreach( $_countries as $key => $val ){
                                                    echo '<option value="'. $key .'" data-code="'. $val['isd'] .'">'. $val['name'] .'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="card_email" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __('email');?>" value="<?php echo $profile->email;?>">
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="card_phone" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __('phone number');?>" value="<?php echo $profile->cc_phone_number;?>">
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <hr class="border_hr">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="_number_" type="text" class="form-control input-md" autocomplete="off" placeholder="<?php echo __('card number');?>">
                                            <input id="card_number" name="card_number" type="hidden" class="form-control input-md" autocomplete="off">
                                        </div>
                                        <div class="input-field col s4">
                                            <select id="card_month" name="card_month" type="text" class="browser-default" autocomplete="off" placeholder="<?php echo __('month');?> (01)">
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
                                        <div class="input-field col s4 no-padding-both">
                                            <select id="card_year" name="card_year" type="text" class="browser-default" autocomplete="off" placeholder="<?php echo __('year');?> (2021)">
                                                <?php for ($i=date('Y'); $i <= date('Y')+15; $i++) {  ?>
                                                    <option value="<?php echo($i) ?>"><?php echo($i) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="input-field col s4">
                                            <input id="card_cvc" name="card_cvc" type="text" class="form-control input-md" autocomplete="off" placeholder="CVC" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <input type="hidden" id="2checkout_type" class="hidden" name="payType">
                                    <input type="hidden" id="2checkout_description" class="hidden" name="description">
                                    <input type="hidden" id="2checkout_price" class="hidden" name="price">
                                    <input id="card_token" name="token" type="hidden" value="">
                                </div>
                                <div class="clear"></div>
                                <div class="modal-footer">
                                    <div class="ball-pulse"><div></div><div></div><div></div></div>
                                    <button type="button" class="btn btn-main" onclick="tokenRequest()" id="2checkout_btn"><?php echo __('pay');?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    // Called when token created successfully.
                    var successCallback = function(data) {
                        var myForm = document.getElementById('2checkout_form');
                        $.post(window.ajax + 'checkout/createsession', {
                            card_number: $("#card_number").val(),
                            card_cvc: $("#card_cvc").val(),
                            card_month: $("#card_month").val(),
                            card_year: $("#card_year").val(),
                            card_name: $("#card_name").val(),
                            card_address: $("#card_address").val(),
                            card_city: $("#card_city").val(),
                            card_state: $("#card_state").val(),
                            card_zip: $("#card_zip").val(),
                            card_country: $("#card_country").val(),
                            card_email: $("#card_email").val(),
                            card_phone: $("#card_phone").val(),
                            token: data.response.token.token,
                            payType: $("#2checkout_type").val(),
                            description: $("#2checkout_description").val(),
                            price: $("#2checkout_price").val()
                        }, function(data, textStatus, xhr) {
                            $('#2checkout_btn').html("<?php echo __('pay');?>");
                            $('#2checkout_btn').attr('disabled');
                            $('#2checkout_btn').removeAttr('disabled');
                            $('#2checkout_form').find('.ball-pulse').fadeOut(100);
                            if (data.status == 200) {
                                window.location.href = data.url;
                            } else {
                                $('#2checkout_alert').html("<div class='alert alert-danger'>"+data.error+"</div>");
                                setTimeout(function () {
                                    $('#2checkout_alert').html("");
                                },3000);
                            }
                            /*optional stuff to do after success */
                        });
                    };

                        // Called when token creation fails.
                    var errorCallback = function(data) {
                        $('#2checkout_btn').html("<?php echo __('pay');?>");
                        $('#2checkout_btn').removeAttr('disabled');
                        $('#2checkout_form').find('.ball-pulse').fadeOut(100);
                        if (data.errorCode === 200) {
                            tokenRequest();
                        } else {
                            $('#2checkout_alert').html("<div class='alert alert-danger'>"+data.errorMsg+"</div>");
                            setTimeout(function () {
                                $('#2checkout_alert').html("");
                            },3000);
                        }
                    };

                    var tokenRequest = function() {
                        $('#card_number').val($('#_number_').val());
                        $('#2checkout_btn').html("<?php echo __('please wait');?>");
                        $('#2checkout_btn').attr('disabled','true');
                        if ($("#card_number").val() != '' && $("#card_cvc").val() != '' && $("#card_month").val() != '' && $("#card_year").val() != '' && $("#card_name").val() != '' && $("#card_address").val() != '' && $("#card_city").val() != '' && $("#card_state").val() != '' && $("#card_zip").val() != '' && $("#card_country").val() != 0 && $("#card_email").val() != '' && $("#card_phone").val() != '') {
                            $('#2checkout_form').find('.ball-pulse').fadeIn(100);
                            // Setup token request arguments
                            var args = {
                                sellerId: "<?php echo($config->checkout_seller_id) ?>",
                                publishableKey: "<?php echo($config->checkout_publishable_key) ?>",
                                ccNo: $("#card_number").val(),
                                cvv: $("#card_cvc").val(),
                                expMonth: $("#card_month").val(),
                                expYear: $("#card_year").val()
                            };

                            // Make the token request
                            TCO.requestToken(successCallback, errorCallback, args);
                        }
                        else{
                            $('#2checkout_btn').html("<?php echo __('pay');?>");
                            $('#2checkout_btn').removeAttr('disabled');
                            $('#2checkout_alert').html("<div class='alert alert-danger'><?php echo __('please check details');?></div>");
                            setTimeout(function () {
                                $('#2checkout_alert').html("");
                            },3000);

                        }
                    };

                    $(function() {
                        try {
                            // Pull in the public encryption key for our environment
                            TCO.loadPubKey("<?php echo($config->checkout_mode) ?>");
                        } catch(e) {
                            console.log(e.toSource());
                        }

                    });
                </script>

            <?php } 
        }?>

        <!-- Boost Modal -->
		<div id="modal_boost" class="modal modal-sm">
			<div class="modal-content">
				<?php
					$_cost = 0;
					if( $profile->is_pro == "1" ){
						$_cost = $config->pro_boost_me_credits_price;
					}else{
						$_cost = $config->normal_boost_me_credits_price;
					}
                    if ( isGenderFree($profile->gender) === true ) {
                        $_cost = 0;
                    }
				?>
				<h6 class="bold"><?php echo __('Boost me!');?></h6>
				<p><?php echo __('Get seen more by people around you in find match.');?></p>
				<p><?php
                    if ( isGenderFree($profile->gender) === true ) {
                        echo __('Boost your profile for free for') . ' ' . $config->boost_expire_time . ' ' . __('miuntes') . '.';
                    }else {
                        echo __('This service costs you') . ' ' . $_cost . ' ' . __('credits and will last for') . ' ' . $config->boost_expire_time . ' ' . __('miuntes') . '.';
                    }
                    ?></p>
				<div class="modal-footer">
					<button type="button" class="btn-flat waves-effect modal-close"><?php echo __( 'Cancel' );?></button>
					<?php if($profile->balance >= $_cost ){?>
						<button data-userid="<?php echo $profile->id;?>" id="btn_boostme" class="modal-close waves-effect waves-light btn-flat btn_primary white-text"><?php
                            if ( isGenderFree($profile->gender) === true ) {
                                echo __( 'Boost For Free' );
                            }else{
                                echo __( 'Boost Now' );
                            }


                            ?></button>
					<?php }else{ ?>
						<a href="<?php echo $site_url;?>/credit" data-ajax="/credit" class="modal-close waves-effect waves-light btn-flat btn_primary white-text"><?php echo __( 'Buy Credits' );?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- End Boost Modal -->
		
		<div class="sidenav_overlay" onclick="javascript:$('body').removeClass('side_open');"></div>
	<?php } ?>
		
	<!-- Scroll to top  -->
    <a href="javascript:void(0);" class="btn-floating btn-large waves-effect waves-light dt_to_top bg_gradient"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z"></path></svg></a>
    <!-- End Scroll to top  -->

	<?php require( $theme_path . 'main' . $_DS . 'geolocation.php' );?>
    <?php require( $theme_path . 'main' . $_DS . 'custom-footer-js.php' );?>
    <?php //write_console();?>
	
	<script type="text/javascript">
		$(document).on('click', '.find_matches_cont > .row > .col.l3 .dt_sections [data-ajax]', function() {
			$('body').removeClass('side_open');
        });
        $('#open_slide').on('click', function(event) {
    event.preventDefault();
    $('body').addClass('side_open');
});
		</script>

    <?php if( IS_LOGGED == true ){ ?>
        <div style="display:none">
            <audio id="notification-sound" class="sound-controls" preload="auto" style="visibility: hidden;">
                <source src="<?php echo $theme_url; ?>assets/mp3/New-notification.mp3" type="audio/mpeg">
            </audio>
            <audio id="message-sound" class="sound-controls" preload="auto" style="visibility: hidden;">
                <source src="<?php echo $theme_url; ?>assets/mp3/New-message.mp3" type="audio/mpeg">
            </audio>
            <audio id="calling-sound" class="sound-controls" preload="auto">
                <source src="<?php echo $theme_url; ?>assets/mp3/calling.mp3" type="audio/mpeg">
            </audio>
            <audio id="video-calling-sound" class="sound-controls" preload="auto">
                <source src="<?php echo $theme_url; ?>assets/mp3/video_call.mp3" type="audio/mpeg">
            </audio>
        </div>
    <?php } ?>

    <?php if(route( 1 ) !== 'find-matches'){ ?>
    <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#ffffff",
                        "text": "#afafaf"
                    },
                    "button": {
                        "background": "#c649b8"
                    }
                },
                "theme": "edgeless",
                "position": "bottom-left",
                "content": {
                    "message": "<?php echo __('This website uses cookies to ensure you get the best experience on our website.');?>",
                    "dismiss": "<?php echo __('Got It!');?>",
                    "link": "<?php echo __('Learn More');?>",
                    "href": "<?php echo $site_url;?>/privacy"
                }
            });
        });
    </script>
    <?php } ?>


<?php if( IS_LOGGED == true ){ ?>
    <?php if ($config->cashfree_payment == 'yes') { ?>
        <div class="modal modal-sm" id="cashfree_modal_box" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content add_money_modal add_address_modal">
                <h4 class="modal-title text-center"><?php echo __('Cashfree');?></h4>
                <div class="modal-body">
                    <div id="cashfree_alert"></div>
                    <form id="cashfree_form" method="post">
                    <div class="form-group">
                        <label class="plr15" for="cashfree_name"><?php echo __('name');?></label>
                        <input class="form-control shop_input" type="text" placeholder="<?php echo __('name');?>" value="<?php echo $profile->full_name; ?>" id="cashfree_name" name="name">
                    </div>
                    <div class="form-group">
                        <label class="plr15" for="cashfree_email"><?php echo __('email');?></label>
                        <input class="form-control shop_input" type="email" placeholder="<?php echo __('email');?>" value="<?php echo $profile->email; ?>" id="cashfree_email" name="email">
                    </div>
                    <div class="form-group">
                        <label class="plr15" for="cashfree_phone"><?php echo __('phone_number');?></label>
                        <input class="form-control shop_input" type="text" placeholder="<?php echo __('phone_number');?>" id="cashfree_phone" name="phone" value="<?php echo $profile->phone_number; ?>">
                    </div>

                    <input id="cashfree_type" name="cashfree_type" type="hidden" value="">
                    <input id="cashfree_description" name="cashfree_description" type="hidden" value="">
                    <input id="cashfree_price" name="cashfree_price" type="hidden" value="0">

                    <div class="modal-footer">
                        <button class="waves-effect waves-light btn-flat btn_primary white-text" id="cashfree_button" type="button" onclick="InitializeCashfree()"><?php echo __('pay');?></button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function(){
            $('#cashfree_modal_box').modal();
        });
        function InitializeCashfree() {
            $('#cashfree_button').html("<?php echo __('please_wait');?>");
            $('#cashfree_button').attr('disabled','true');
            name = $('#cashfree_name').val();
            phone = $('#cashfree_phone').val();
            email = $('#cashfree_email').val();
            amount = $('#cashfree_price').val();
            description = $('#cashfree_description').val();
            payType = $('#cashfree_type').val();
            $.post(window.ajax + 'cashfree/createsession', {
                name:name,
                phone:phone,
                email:email,
                description:description,
                price:amount,
                payType:payType
            }, function(data) {
            if (data.status == 200) {
                $('body').append(data.html);
                document.getElementById("redirectForm").submit();
            } else {
                $('#cashfree_alert').html("<div class='alert alert-danger'>"+data.message+"</div>");
                setTimeout(function () {
                $('#cashfree_alert').html("");
                },3000);
            }
            $('#cashfree_button').html("<?php echo __('pay');?>");
            $('#cashfree_button').removeAttr('disabled');
            });
        }
        </script>
    <?php } ?>

    <?php if ($config->iyzipay_payment === "yes" && !empty($config->iyzipay_key) && !empty($config->iyzipay_secret_key)) { ?>
        <div id="iyzipay_content"></div>
        <script>
            function unlock_photo_private_pay_via_iyzipay(){
                $('.btn-iyzipay-payment').attr('disabled','true');

                $.post(window.ajax + 'iyzipay/createsession', {
                    payType: 'unlock_private_photo',
                    description: '<?php echo __( "Unlock Private photo feature");?>',
                    price: <?php echo (int)$config->lock_private_photo_fee;?>
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
        </script>
    <?php } ?>
    
    <?php if ($config->securionpay_payment === "yes") { ?>
        <script type="text/javascript">
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
        function unlock_photo_private_pay_via_securionpay(){
            price = <?php echo (int)$config->lock_private_photo_fee;?>;
            $.post(window.ajax + 'securionpay/token', {type:'unlock_private_photo',price:price}, function(data, textStatus, xhr) {
                if (data.status == 200) {
                    SecurionpayCheckout.open({
                        checkoutRequest: data.token,
                        name: 'unlock private photo',
                        description: '<?php echo __( "Unlock Private photo feature");?>'
                    });
                }
            }).fail(function(data) {
                M.toast({html: data.responseJSON.message});
            });
        }
    </script>
    <?php } ?>
    <?php if ($config->authorize_payment === "yes") { ?>
        
        <script type="text/javascript">
            function unlock_photo_private_pay_via_authorize(){
                $('#authorize_btn').attr('onclick', 'AuthorizePhotoRequest()');
                $('#authorize_modal').modal('open');
            }
            function AuthorizePhotoRequest() {
                $('#authorize_btn').html("<?php echo __('please_wait');?>");
                $('#authorize_btn').attr('disabled','true');
                authorize_number = $('#authorize_number').val();
                authorize_month = $('#authorize_month').val();
                authorize_year = $('#authorize_year').val();
                authorize_cvc = $('#authorize_cvc').val();
                price = <?php echo (int)$config->lock_private_photo_fee;?>;
                $.post(window.ajax + 'authorize/pay', {type:'unlock_private_photo',card_number:authorize_number,card_month:authorize_month,card_year:authorize_year,card_cvc:authorize_cvc,price:price}, function(data) {
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
        </script>
    <?php } ?>
    <?php if ($config->paystack_payment === "yes") { ?>
        
        <script>
            function unlock_photo_private_pay_via_paystack(){
                $('#paystack_btn').attr('onclick', 'InitializePhotoPaystack()');
                $('#paystack_wallet_modal').modal('open');
            }
            function InitializePhotoPaystack() {
                $('#paystack_btn').html("<?php echo __('please_wait');?>");
                $('#paystack_btn').attr('disabled','true');
                email = $('#paystack_wallet_email').val();
                price = <?php echo (int)$config->lock_private_photo_fee;?>;
                $.post(window.ajax + 'paystack/initialize', {type:'unlock_private_photo',email:email,price:price}, function(data) {
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
        </script>
    <?php } ?>
<?php } ?>
</body>
</html>
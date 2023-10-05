<?php if (!isset($_POST['ajax'])) {?><?php require( $theme_path . 'main' . $_DS . 'header.php' );?>
    <?php
        if( isset( $_SESSION['JWT'] ) ){
            require( $theme_path . 'main' . $_DS . 'nav-logged-in.php' );
        }else{
            require( $theme_path . 'main' . $_DS . 'nav-not-logged-in.php' );
        }
    ?>
    <?php if ($data['name'] !== 'login' && $data['name'] !== 'contact' && $data['name'] !== 'register' && $data['name'] !== 'forgot' && $data['name'] !== 'reset' && $data['name'] !== 'verifymail' && $data['name'] !== 'index' && $data['name'] !== 'home' && IS_LOGGED) { ?>
    <div class="container" style="transform: none;"><?php echo GetAd('header');?></div>
    <?php } ?>
    <div id="container">
<?php } ?>
        <?php require($file_path);?>
<?php if (!isset($_POST['ajax'])) {?>
    </div>
    <a href="javascript:void(0);" id="ajaxRedirect" style="visibility: hidden;display: none;"></a>
    <?php require( $theme_path . 'main' . $_DS . 'full-footer.php' );?>
    <?php require( $theme_path . 'main' . $_DS . 'footer.php' );?>
<?php } ?>
<?php if ($config->filter_by_cities == 1 && !empty($config->geo_username)) { ?>
<script type="text/javascript">
    function ChangeCountryKey(self) {
        $('.city_country_key').val($(self).find(":selected").val());
    }
    function SearchForCity(self) {
        let country_code = $('.city_country_key').val();
        let city = $(self).val();
        if (city.length >= 3) {
            $.post('http://api.geonames.org/searchJSON?name='+city+'&username=<?php echo($config->geo_username); ?>&cities=cities1000&country='+country_code, {},function (data) {
                if (typeof data != 'undefined' && typeof data.geonames != 'undefined') {
                    $('.city_search_result').html('');
                    data.geonames.forEach(element => {
                        $('.city_search_result').append('<p onclick="AddCityToFilter(this)">'+element.name+'</p>');
                    });
                }
            });
        }
        //return clearTimeout(CitySearchTime);
    }
    function AddCityToFilter(self) {
        $('.city_search_result').html('');
        $('.selected_city').val($(self).text());
    }
</script>
<?php } ?>



<script type="text/javascript">
    function PayUsingWallet(type,type2 = 'hide') {
        let price = 0;
        let main_price = 0;
        if (type == 'pro') {
            price = main_price = getPrice();
        }
        else if(type == 'private_photo'){
            price = <?php echo (int)$config->lock_private_photo_fee;?>;
        }
        else if(type == 'private_video'){
            price = <?php echo (int)$config->lock_pro_video_fee;?>;
        }
        price = parseInt(price * <?php echo $config->credit_price; ?>);
        $('.pay_modal_wallet_alert').html("");
        if (type2 == 'show') {
            if (type == 'pro') {
                $('.pay_modal_wallet_text').html("<?php echo __( 'pay_to_upgrade' ); ?>");
                $('#pay_modal_wallet_btn').html("<?php echo __( 'pay' );?> "+'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="margin-top: -3px;"><path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,17V16H9V14H13V13H10A1,1 0 0,1 9,12V9A1,1 0 0,1 10,8H11V7H13V8H15V10H11V11H14A1,1 0 0,1 15,12V15A1,1 0 0,1 14,16H13V17H11Z"></path></svg> '+price);
                $('#pay_modal_wallet_btn').removeAttr('disabled');
            }
            else if(type == 'private_photo'){
                $('.pay_modal_wallet_text').html("<?php echo __( 'pay_to_unlock_private_photo' ); ?>");
                $('#pay_modal_wallet_btn').html("<?php echo __( 'pay' );?> "+'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="margin-top: -3px;"><path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,17V16H9V14H13V13H10A1,1 0 0,1 9,12V9A1,1 0 0,1 10,8H11V7H13V8H15V10H11V11H14A1,1 0 0,1 15,12V15A1,1 0 0,1 14,16H13V17H11Z"></path></svg> '+price);
                $('#pay_modal_wallet_btn').removeAttr('disabled');
            }
            else if(type == 'private_video'){
                $('.pay_modal_wallet_text').html("<?php echo __( 'pay_to_unlock_private_photo' ); ?>");
                $('#pay_modal_wallet_btn').html("<?php echo __( 'pay' );?> "+'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="margin-top: -3px;"><path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,17V16H9V14H13V13H10A1,1 0 0,1 9,12V9A1,1 0 0,1 10,8H11V7H13V8H15V10H11V11H14A1,1 0 0,1 15,12V15A1,1 0 0,1 14,16H13V17H11Z"></path></svg> '+price);
                $('#pay_modal_wallet_btn').removeAttr('disabled');
            }
            $('#pay_modal_wallet_btn').attr('onclick', "PayUsingWallet('"+type+"')");
            
            if (parseInt(<?php echo $profile->balance; ?>) < price ) {
                $('.pay_modal_wallet_alert').html("<div class='alert alert-danger'><a href='javascript:void(0)' onclick='SetPageCookie(\""+type+"\",\""+type+"\")'><?php echo __('please_top_up_credits')?></a></div>");
                $('#pay_modal_wallet_btn').attr('disabled','true');
                $('.pay_modal_wallet_text').html("");
            }
            $('#pay-go-pro').modal('open');
        }
        else{
            $('#pay_modal_wallet_btn').html("<?php echo __('please wait');?>");
            $('#pay_modal_wallet_btn').attr('disabled','true');
            let link = '';
            if (type == 'pro') {
                link = '?pay_for=pro&price='+main_price;
            }
            else if (type == 'private_photo'){
                link = '?pay_for=private_photo';
            }
            else if (type == 'private_video'){
                link = '?pay_for=private_video';
            }
            $.get(window.ajax + 'wallet/pay' + link, function (data) {
                if (data.status == 200) {
                    location.href = data.url;
                }

            }).fail(function(data) {
                $('#pay_modal_wallet_btn').html("<?php echo __( 'pay' );?> "+'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="margin-top: -3px;"><path fill="currentColor" d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,17V16H9V14H13V13H10A1,1 0 0,1 9,12V9A1,1 0 0,1 10,8H11V7H13V8H15V10H11V11H14A1,1 0 0,1 15,12V15A1,1 0 0,1 14,16H13V17H11Z"></path></svg> '+price);
                $('#pay_modal_wallet_btn').removeAttr('disabled');
                $('#payu_btn').removeAttr('disabled');
                $('.pay_modal_wallet_alert').html("<div class='alert alert-danger'>"+data.responseJSON.message+"</div>");
            });
        }
            
    }
    function SetPageCookie(type,id){
        $.get(window.ajax + 'wallet/set?type=' + type, function (data) {
            location.href = window.site_url+'/credit';
        });
    }
</script>
<?php
Class Razorpay extends Aj {
	public function create()
    {
    	global $db,$config;
    	$data['status'] = 400;
    	if (!empty($_POST['payment_id']) && !empty($_POST['order_id']) && !empty($_POST['merchant_amount']) && is_numeric($_POST['merchant_amount'])) {


    		$payment_id = Secure($_POST['payment_id']);
    		$realprice    = (int)Secure($_POST['merchant_amount']);
    		$amount      = 0;
    		$realprice = $realprice / 100;
            if ($realprice == self::Config()->bag_of_credits_price) {
                $amount = self::Config()->bag_of_credits_amount;
            } else if ($realprice == self::Config()->box_of_credits_price) {
                $amount = self::Config()->box_of_credits_amount;
            } else if ($realprice == self::Config()->chest_of_credits_price) {
                $amount = self::Config()->chest_of_credits_amount;
            }
    		$currency_code = "INR";
		    $check = array(
			    'amount' => $realprice,
			    'currency' => $currency_code,
			);


			$json = CheckRazorpayPayment($payment_id,$check);
			if (!empty($json) && empty($json->error_code)) {
				$user           = $db->objectBuilder()->where('id', self::ActiveUser()->id)->getOne('users', array('balance'));
				$newbalance = $user->balance + $amount;
                $updated    = $db->where('id', self::ActiveUser()->id)->update('users', array('balance' => $newbalance));
                if ($updated) {
                    RegisterAffRevenue(self::ActiveUser()->id,$realprice);
                    $db->insert('payments', array(
                        'user_id' => self::ActiveUser()->id,
                        'amount' => $realprice,
                        'type' => 'CREDITS',
                        'pro_plan' => '0',
                        'credit_amount' => $amount,
                        'via' => 'Razorpay'
                    ));
                    $_SESSION[ 'userEdited' ] = true;
                    $url = $config->uri . '/ProSuccess';
                    if (!empty($_COOKIE['redirect_page'])) {
                        $redirect_page = preg_replace('/on[^<>=]+=[^<>]*/m', '', $_COOKIE['redirect_page']);
                        $url = preg_replace('/\((.*?)\)/m', '', $redirect_page);
                    }
                    $data['status'] = 200;
                    $data['url'] = $url;
                } else {
                	$data['message'] = __('Error While update balance after charging');
                }
			}
			else{
		    	$data['message'] = $json->error_code . ':' . $json->error_description;
		    }
    	}
    	else{
    		$data['status'] = 400;
	        $data['message'] = __('please check your details');
    	}
    	return $data;
    }
}
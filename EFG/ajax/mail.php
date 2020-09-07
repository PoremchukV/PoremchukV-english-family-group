
<?php
if(isset($_POST)) {
 
    $email_to = "kvitka147@gmail.com";
    $email_from = "kvitka147@gmail.com";
    $email_subject = "Заявка с сайта English Family Group";
 
    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $mobile = $_POST['mobile']; // required
    $comments = $_POST['comments']; // required
 
    $response = array('status' => false, 'message' => array());
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $mobile_exp = "/^\d{3}\d{2}\d{2}\d{2}$/";
 
    if(!isset($name) || empty($name)) {
      array_push($response['message'], 'Введите свое Имя.');
    }
    if(!isset($mobile) || empty($mobile)||!preg_match($mobile_exp,$mobile)) {
      array_push($response['message'], 'Укажите свой номер телефона.');
    }
  if(!isset($email) || !preg_match($email_exp,$email)) {
    array_push($response['message'], 'Адрес электронной почты не корректный.');
  }
 
  
 
 
	if(!empty($response['message'])) {
		echo json_encode($response);
	} else {
		$email_body = "Form details:\n\n";
		$email_body .= "Name: ".$name."\n";
		$email_body .= "Email: ".$email."\n";
		$email_body .= "Mobile: ".$mobile."\n";
		$email_body .= "Comments: ".$comments."\n";
 
		// create email headers
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		if(mail($email_to, $email_subject, $email_body, $headers)) {
 			$response = array('status' => true, 'message' => 'Благодарим Вас за обращение к нам. Мы свяжемся с вами очень скоро.');
 			echo json_encode($response);
 
		} 
	}
 }
?>
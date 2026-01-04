<?php 
class ControllerMailSubscribe extends Controller { 
	
   // запись email в БД
    public function add_subscriber() {
        $json = $this->request->post;
        $this->load->model('mail/subscriber');
        $this->model_mail_subscriber->add_subscriber($json);
    }
	
	// отправка письма админу при новом подписчике
    public function send() {   
    $this->load->model('setting/setting');
    $json = $this->request->post;     
    $mail = new Mail($this->config->get('config_mail_engine'));
    $from = $this->config->get('config_email'); 
    $mail->parameter = $this->config->get('config_mail_parameter');
	$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
	$mail->smtp_username = $this->config->get('config_mail_smtp_username');
	$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
	$mail->smtp_port = $this->config->get('config_mail_smtp_port');
	$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
	$data = array();
	foreach($json as $key => $val) {          
          $data['subscriber'][] = array(
               'text' => $key,
               'value' => $val
		   );
		}     
	$mail->setTo($from);
	$mail->setFrom('admin@your_store.ru');
	$mail->setSender('admin@your_store.ru');
	$mail->setSubject('Новый подписчик на сайте');
	$mail->setHtml($this->load->view('mail/subscribe', $data));
	$mail->send();
	$this->add_subscriber();	
    }    
}

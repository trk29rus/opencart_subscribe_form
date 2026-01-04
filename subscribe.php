<?php 
class ControllerMailSubscribe extends Controller {   
    public function send() {   
    $this->load->model('setting/setting');
    $json = $this->request->post; 
    // отправка письма админу при новом подписчике
    $mail = new Mail($this->config->get('config_mail_engine'));
    $from = $this->config->get('config_email'); 
    $mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
		$data = array();
		foreach ($json as $key => $val) {
           $data['text'] .= $key.':' .$val.'<br>';
		}      
		$mail->setTo($from);
		$mail->setFrom($from);
		$mail->setSender('admin@your_store.ru');
		$mail->setSubject('Новый подписчик на сайте');
		$mail->setHtml($this->load->view('mail/subscribe', $data));
		$mail->send();		
    }    
}

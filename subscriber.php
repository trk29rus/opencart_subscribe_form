<!--Разместить в /catalog/model/mail/-->
<?php
class ModelMailSubscribe extends Model {
	public function add_subscriber($json) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "subscribe SET email = '".$json['email']."'");
	
	}
}

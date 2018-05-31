<?php
namespace Home\Model;
use Home\Model\BaseModel;
class UserModel extends BaseModel {
   public function getInfoByPhone($phone) {
   		$data = $this->where(array('phone'=>$phone))->find();
   		return $data;
   }
}
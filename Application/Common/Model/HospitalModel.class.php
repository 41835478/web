<?php
namespace Common\Model;
use Think\Model;
use Think\Model\ViewModel ;
/**
* 
*/
class HospitalModel extends ViewModel
{
	
	public $viewFields = array(

		'hospital'=>array('id','hid','name_cn'),
		'hospitaladd'=>array('_on'=>'hospital.hid=hospitaladd.hid'),
	);

}
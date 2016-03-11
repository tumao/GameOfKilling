<?php
namespace Core\Orms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Orm extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

}
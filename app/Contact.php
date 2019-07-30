<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $filltable = ['first_name','last_name','email','city','contry','job_city'];
    //
}

<?php

namespace App\Http\Controllers\backend;
use App\models\Prov;


class home extends backendController
{
    public function __construct(Prov $model)
    {
        parent::__construct($model);
    }
    public function index() {
        return view('back_end.home');
    }
}

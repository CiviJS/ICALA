<?php

namespace App\Services;

use App\Models\Admin;

class AdminsService{
   
    public function obtenerAdmins():array 
    {
        $admins = Admin::select('id','name')->get();
        return $admins->toArray();
    }


}
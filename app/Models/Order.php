<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Bascet;

class Order extends Model
{
    use HasFactory;

    public function bascets() {
        $bascetsID = unserialize($this->bascetsID);
        $bascets = [];

        foreach ($bascetsID as $bascetID) {
            array_push($bascets, Bascet::find($bascetID));
        }
        return $bascets;
    }
}

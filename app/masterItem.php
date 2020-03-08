<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class masterItem extends Model
{
    protected $fillable = [
        'combination_id', 'prin', 'chocolate', 'fresh_berries', 'raiins', 'pineapple', 'vanilla_ice_cream', 'brown_rice', 'roasted_soybeans', 'coconut', 'honey', 'miso', 'personal_flavor_print_file_name', 'personal_top_flavor_1', 'personal_top_flavor_2', 'personal_top_flavor_3', 'recommendation_1_id', 'recommendation_1_title', 'recommendation_1_compatibillity', 'recommendation_2_id', 'recommendation_2_title', 'recommendation_2_compatibility',
    ];
    protected $primaryKey = null;
}

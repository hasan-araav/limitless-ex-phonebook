<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneType;

class PhoneBook extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'phone_type', 'phone_number'];
    
    /**
     * Get the phonetype associated with the PhoneBook
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function phonetype()
    {
        return $this->hasOne(PhoneType::class, 'id', 'phone_type');
    }
}

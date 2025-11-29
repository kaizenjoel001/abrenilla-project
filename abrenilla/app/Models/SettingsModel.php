<?php

namespace App\Models;
use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'value'];

    public function getSetting($name)
    {
        return $this->where('name', $name)->first();
    }

    public function updateSetting($name, $value)
    {
        $setting = $this->where('name', $name)->first();
        if ($setting) {
            return $this->where('name', $name)->set(['value' => $value])->update();
        } else {
            return $this->insert(['name' => $name, 'value' => $value]);
        }
    }
}

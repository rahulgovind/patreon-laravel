<?php namespace PatreonLaravel\Models;

class PatreonUser
{
    private $_data;

    public static function createFromJSON($json)
    {
        $result = new static();
        $result->_data = collect($json);
        return $result;
    }

    public function id()
    {
        return $this->_data['id'];
    }
}
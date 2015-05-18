<?php

class mysqlsetup
{

    public function setup($postParams)
    {

    }

    private function setupDatabase($params)
    {
        if ($this->validateSetupDatabase($params)) {

        }
    }

    private function validateSetupDatabase($params)
    {
        //todo-atwi: implement
    }

    private function setupAdminUser($params)
    {
        if ($this->validateAdminUser($params)) {

        }
    }

    private function validateAdminUser($params)
    {
        //todo-atwi: implement
    }
}
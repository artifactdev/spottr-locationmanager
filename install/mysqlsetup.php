<?php

class mysqlsetup
{

    public function setup($postParams)
    {
        if (!empty($_POST['type'])) {
            switch ($_POST['type']) {
                case 'dbsetup':
                    $this->setupDatabase($_POST);
                    break;
                case 'adminsetup':
                    $this->setupAdminUser($_POST);
                    break;
            }
        }
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
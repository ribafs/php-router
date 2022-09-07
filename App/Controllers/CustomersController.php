<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Models\CustomersModel;

class CustomersController
{
    public function index()
    {
        $Customer = new CustomersModel('customer');
        $allRegs = $Customer->allRegs();

        // Load a view
        require_once APP . 'views/templates/header.php';
        require_once APP . 'views/templates/menu.php';                
        require_once APP . 'views/customers/index.php';
        require_once APP . 'views/templates/footer.php';
    }

    public function add()
    {
        $Customer = new CustomersModel('customers');
        if (isset($_POST['submit_add_customer'])) {
            $Customer->add($_POST['name'], $_POST['email']);
	        header('location: ' . URL . 'customers/index');	
        }

        require_once APP . 'views/templates/header.php';
        require_once APP . 'views/templates/menu.php';                                
        require_once APP . 'views/customers/add.php';
        require_once APP . 'views/templates/footer.php';
    }

    public function edit($field_id)
    {
        if (isset($field_id)) {
            $Customer = new CustomersModel('customers');
            $allRegs = $Customer->allRegs();
            $oneReg = $Customer->oneReg($field_id);

            if ($oneReg === false) {
                $error = new \Core\ErrorController();
                $error->index();
            } else {
                require_once APP . 'views/templates/header.php';
			    require_once APP . 'views/templates/menu.php';                        
                require_once APP . 'views/customers/edit.php';
                require_once APP . 'views/templates/footer.php';
            }
        } else {
            header('location: ' . URL . 'customers/index');
        }
    }

    public function update()
    {
        if (isset($_POST['submit_update_customer'])) {
          $Customer = new CustomersModel('customers');
          $Customer->update($_POST['name'], $_POST['email'], $_POST['field_id']);
        }
        header('location: ' . URL . 'customers/index');
    }

    public function delete($field_id)
    {
        if (isset($field_id)) {
            $Customer = new CustomersModel('customers');
            $Customer->delete($field_id);
        }
        header('location: ' . URL . 'customers/index');
    }
}

<?php
declare(strict_types = 1);
namespace App\Models;

use Core\Connection;

class CustomersModel extends Connection
{ 
    public function add($name, $email)
    {
        $sql = "INSERT INTO customers (name, email) VALUES (:name, :email)";
        $query = $this->pdo->prepare($sql);
        $parameters = array(":name" => $name, ":email" => $email);
        $query->execute($parameters);
    }

    public function oneReg($field_id)
    {
        $sql = 'SELECT id, name, email FROM customers WHERE id = :field_id LIMIT 1';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':field_id' => $field_id);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function update($name, $email, $field_id)
    {
        $sql = 'UPDATE customers SET name = :name, email = :email WHERE id = :field_id';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':name' => $name, ':email' => $email, ':field_id' => $field_id);
        $query->execute($parameters);
    }
    
    public function delete($field_id)
    {
        $sql = 'DELETE FROM customers WHERE id = :field_id';
        $query = $this->pdo->prepare($sql);
        $parameters = array(':field_id' => $field_id);
        $query->execute($parameters);
    }    

    public function allRegs()
    {
        $sql = "SELECT * FROM customers ORDER BY id DESC";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }    
}

<?php

declare(strict_types=1);

namespace newsworthy39;

use PDO;

class Elegant
{
    protected $tablename;
    protected $fields;
    protected $values;
    protected $pkid = 'id';

    protected function primarykey()
    {
        return 'id';
    }

    public function id() {
        return $this->values[$this->primarykey()];
    }

    protected function foreignkey()
    {
        return sprintf("%s%s", $this->tablename, $this->primarykey());
    }

    protected function tablename()
    {
        if (is_null($this->tablename)) {
            return strtolower(Elegant::get_class_name(get_class($this)));
        }

        return $this->tablename;
    }

    protected static function findModel(Elegant $instance, array $args)
    {
        try {

            $pdo = app()->get(\PDO::class);

            $placeholders = array();
            $keys = array_keys($args);
            foreach ($keys as $key) {
                $placeholders[] = sprintf("%s = :%s", $key, $key);
            }
            $where = implode(' AND ', $placeholders);
            $sql = sprintf("SELECT * from %s WHERE %s", $instance->tablename(), $where);

            $statement = $pdo->prepare($sql);
            $statement->execute($args);

            $found = false;
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $found = true;
                $fields = array_keys($row);

                foreach ($fields as $field) {
                    $instance->$field = $row[$field];
                }
                
                break;
            }

            $statement = null;
        } catch (PDOException $error) {
            printf("SQL error %s", $error);
        }

        if ($found) {
            return $instance;
        } else {
            return false;
        }
    }

    protected static function findModels(Elegant $model)
    {
        try {

            $pdo = app()->get(\PDO::class);

            $sql = sprintf("SELECT * from %s ", $model->tablename());

            $statement = $pdo->prepare($sql);

            $statement->execute();

            $found = false;
            $result = array();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $fields = array_keys($row);
                $instance = clone ($model);
                foreach ($fields as $field) {
                    $instance->$field = $row[$field];
                }
                array_push($result, $instance);
            }

            $statement = null;
        } catch (PDOException $error) {
            printf("SQL error %s", $error);
        }

        return $result;
    }

    protected static function createModel(Elegant $instance)
    {
        try {

            $pdo = app()->get(\PDO::class);

            $placeholders = array();
            $keys = array_keys($instance->values);
            foreach ($keys as $key) {
                $placeholders[] = sprintf(":%s", $key);
            }

            $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $instance->tablename(), implode(',', $keys),  implode(',', $placeholders));

            $statement = $pdo->prepare($sql);
            $statement->execute($instance->values);
            $instance->{$instance->primarykey()} = $pdo->lastInsertId();

            $statement = null;
        } catch (PDOException $error) {
            printf("%s %s", __METHOD__, $error);
        }

        return $instance;
    }

    protected static function saveModel(Elegant $instance)
    {
        try {

            $pdo = app()->get(\PDO::class);

            $placeholders = array();
            $arguments = array();
            $keys = array_values($instance->fields);
            foreach ($keys as $key) {
                $placeholders[] = sprintf("%s = :%s", $key, $key);

                // slice values, to match bound-variables 
                $arguments[$key] = $instance->values[$key];
            }

            // Add ID.
            $arguments[$instance->primarykey()] = $instance->id();

            $where = sprintf("%s = :%s", $instance->primarykey(), $instance->primarykey());
            $sql = sprintf("UPDATE %s SET %s WHERE %s", $instance->tablename(), implode(',', $placeholders), $where);
            $statement = $pdo->prepare($sql);
            $statement->execute($arguments);

            $statement = null;
        } catch (PDOException $error) {
            printf("%s %s", __METHOD__, $error);
        }
    }

    protected function deleteModel(Elegant $instance)
    {

        try {

            $pdo = app()->get(\PDO::class);

            // DELETE FROM table WHERE pkid = :pkid, $instance->$pkid

            $where = sprintf("%s = :%s", $instance->primarykey(), $instance->primarykey());

            $sql = sprintf("DELETE FROM `%s` WHERE %s", $instance->tablename(), $where);

            $statement = $pdo->prepare($sql);

            $statement->execute([$instance->primarykey() => $instance->values[$instance->primarykey()]]);

            $statement = null;
        } catch (PDOException $error) {
            printf("%s %s", __METHOD__, $error);
        }
    }

    public function get_class_name($classname)
    {
        if ($pos = strrpos($classname, '\\')) return substr($classname, $pos + 1);
        return $pos;
    }

    protected function assignTo(Elegant $left)
    {
        $this->values[$left->foreignkey()] = $left->values[$left->primarykey()];
    }

    protected function belongsTo(Elegant $instance)
    {
        $instance->assignTo($this);
    }

    protected function has(Elegant $left, Elegant $right)
    {

        // select * from right where right.fkid = left.pkid
        $result = array();
        try {

            $pdo = app()->get(\PDO::class);

            $sql = sprintf("SELECT r.* from %s r WHERE r.%s=:l%s", $right->tablename(), $left->foreignkey(), $left->foreignkey());
            $statement = $pdo->prepare($sql);

            $statement->execute([sprintf("l%s", $left->foreignkey()) => $left->values[$left->primarykey()]]);
            $found = false;
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $found = true;
                $fields = array_keys($row);

                $t = clone ($right);
                foreach ($fields as $field) {
                    $t->$field = $row[$field];
                }
                array_push($result, $t);
            }

            $statement = null;
        } catch (PDOException $error) {
            printf("SQL error %s", $error);
        }

        if ($found) {
            return $result;
        } else {
            return false;
        }
    }

    public function __get(String $field)
    {
        return $this->values[$field];
    }

    public function __set(String $field, String $value)
    {
        $this->values[$field] = $value;
    }
}

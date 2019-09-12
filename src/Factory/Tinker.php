<?php

declare(strict_types=1);

namespace newsworthy39\Factory;

class Tinker
{

    private $pdo, $classes;

    public function __construct()
    {
        $this->pdo = app()->get(\PDO::class);

        $this->classes = [
            \newsworthy39\Factory\Database\System::class
        ];
    }

    public function up()
    {
        try {
            foreach ($this->classes as $class) {
                $object = new $class();
                $statements = $object->up();
                foreach ($statements as $statement) {
                    $status = $this->pdo->exec($statement);
                }
            }
        } catch (PDOException $e) {
            printf("Error %s\n", $e->getMessage()); //Remove or change message in production code
        }
    }

    public function down()
    {
        try {
            foreach ($this->classes as $class) {
                $object = new $class();
                $statements = $object->down();
                foreach ($statements as $statement) {
                    $this->pdo->exec($statement);
                }
            }
        } catch (PDOException $e) {
            printf("Error %s\n", $e->getMessage()); //Remove or change message in production code
        }
    }
}

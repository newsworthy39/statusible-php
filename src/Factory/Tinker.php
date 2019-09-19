<?php

declare(strict_types=1);

namespace newsworthy39\Factory;

class Tinker
{
    private $pdo, $classes;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;

        $this->classes = [
            \newsworthy39\Factory\Database\System::class,
            \newsworthy39\Factory\Database\Migrations\SystemIndexes::class
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

                // insert into migrations.
                $sql = "INSERT INTO `migrations` (classname) VALUES (:classname)";
                $statement = $this->pdo->prepare($sql);
                $statement->execute(array('classname' => $class));
                $statement = null;
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

                    // remove from  migrations.
                    $sql = "DELETE FROM `migrations` WHERE classname = :classname";
                    $statement = $this->pdo->prepare($sql);
                    $statement->execute(array('classname' => $class));
                    $statement = null;
                }
            }
        } catch (PDOException $e) {
            printf("Error %s\n", $e->getMessage()); //Remove or change message in production code
        }
    }
}

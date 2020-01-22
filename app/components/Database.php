<?php

namespace App\components;

use PDO;

class Database
{
    private $pdo;

    /**
     * Database constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }



    /**
     * Возвращает все строки из таблицы $table
     * Также можно отсортировать полученные строки по возрастанию
     *
     *
     * @example SELECT * FROM news
     * @example SELECT * FROM leader ORDER by id DESC
     * @param string $table таблица
     * @param null $isDesc сортировка
     * @return array все строки
     */
    public function getAll($table, $isDesc = NULL)
    {
        $desc = ($isDesc) ? 'ORDER by `id` DESC' : NULL;
        $query = $this->pdo->prepare("SELECT * FROM $table $desc");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает строку из таблицы $table по $id
     *
     * @example SELECT * FROM news WHERE id = 20
     * @example SELECT * FROM specialties WHERE code = 09.02.03
     * @param $table таблица
     * @param int $id ID
     * @param string $idName значение ID по умолчанию.
     * @return mixed строка
     */
    public function getRow($table, $id, $idName = "id")
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE $idName = :id");
        $params = [
            ':id' => $id
        ];
        $query->execute($params);

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает первые или последние $rows строк из таблицы $table
     *
     * @example SELECT * FROM news ORDER BY id LIMIT 5
     * @example SELECT * FROM leaders ORDER BY id DESC LIMIT 15
     * @param $table таблица
     * @param $rows количество строк
     * @param null $isDesc
     * @return array
     */
    public function getFirstLastRows($table, $rows, $isDesc = NULL)
    {
        $desc = ($isDesc) ? 'DESC' : NULL;
        $query = $this->pdo->prepare("SELECT * FROM $table ORDER BY `id` $desc LIMIT $rows");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает несколько строк из таблицы $table от $first до $end
     * Предназначен для пагинатора.
     *
     * @param $table таблица
     * @param $first
     * @param $end
     * @return array
     */
    public function getLimitRows($table, $first, $end)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table ORDER BY `id` DESC LIMIT $first, $end");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает несколько строк из таблицы $table, которые находятся на позициях $pos
     *
     *
     * @example SELECT * FROM news WHERE id IN (1,2,3)
     * @param string $table таблица
     * @param string $pos
     * @return array
     */
    public function getSomeRows($table, $pos)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE `id` IN ($pos)");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает количество строк в таблице $table
     *
     * @example SELECT COUNT(*) as count FROM news
     * @param string $table
     * @return mixed
     */
    public function getCount($table)
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) as count FROM $table");
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает первую или последнюю стркоу из таблицы $table в зависимости от $isDesc
     * По умолчанию возвращает первую строчку
     *
     * @example SELECT * FROM news ORDER BY id LIMIT 1
     * @example SELECT * FROM leaders ORDER BY id DESC LIMIT 1
     * @param $table
     * @param null $isDesc
     * @return mixed
     */
    public function getFirstLastRow($table, $isDesc = NULL)
    {
        $desc = ($isDesc) ? 'DESC' : NULL;
        $query = $this->pdo->prepare("SELECT * FROM $table ORDER BY id $desc LIMIT 1");
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает строку удовлетворяющий условию
     *
     * @example SELECT * FROM news WHERE email = 'parviz23.10@inbox.ru' LIMIT 1
     * @param $table таблица
     * @param $column название столбца таблицы
     * @param $value значение в столбце таблицы
     * @return mixed
     */
    public function getRowCondition($table, $column, $value)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE $column = :value LIMIT 1");
        $params = [
            'value' => $value
        ];
        $query->execute($params);

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * * Возвращает строки удовлетворяющие условию $column = $value
     *
     * @example SELECT * FROM news WHERE lname = 'Abdulloev'
     * @param $table таблица
     * @param $column название столбца таблицы
     * @param $value значение в столбце таблицы
     * @return array
     */
    public function getAllCondition($table, $column, $value)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE $column = :value");
        $params = [
            'value' => $value
        ];
        $query->execute($params);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * Возвращает строку удовлетворяющий двойному условию
     *
     * @example SELECT * FROM leaders WHERE lname = 'Abdulloev' AND fname = 'Parviz' LIMIT 1
     * @param $table таблица
     * @param $fstColumn название первого столбца
     * @param $fstValue значение в первом столбце
     * @param $sndColumn название второго столбца
     * @param $sndValue значение во втором столбце
     * @return mixed
     */
    public function getRow2Condition($table, $fstColumn, $fstValue, $sndColumn, $sndValue)
    {
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE $fstColumn = :fstValue AND $sndColumn = :sndValue LIMIT 1");
        $params = [
            'fstValue' => $fstValue,
            'sndValue' => $sndValue
        ];
        $query->execute($params);

        return $query->fetch(PDO::FETCH_OBJ);
    }



    /**
     * Добавляет строку в таблицу $table
     *
     * @example INSERT INTO news (title, text) VALUES ('Заголовок', 'Текст новости')
     * @param $table таблица
     * @param $data
     */
    public function store($table, $data)
    {
        $keys = array_keys($data);
        $stringOfKeys = implode(',', $keys);
        $values = ":" . implode(', :', $keys);

        $query = $this->pdo->prepare("INSERT INTO $table ($stringOfKeys) VALUES ($values)");

        $query->execute($data);
    }



    /**
     * Изменяет строку $id из таблицы $table данными $data
     *
     * @param $table таблица
     * @param $id значение первичного ключа
     * @param $data данные
     * @param string $idName имя столбца (первичного ключа). По умолчанию 'id'
     */
    public function update($table, $id, $data, $idName = "id")
    {
        $fields = "";
        $data[$idName] = $id;
        foreach($data as $key => $value)
        {
            $fields .= $key . "=:" . $key . ",";
        }

        $fields = rtrim($fields, ',');

        $query = $this->pdo->prepare("UPDATE $table SET $fields WHERE $idName = :" . $idName);

        $query->execute($data);
    }



    /**
     * Удаляет строку из таблицы $table
     *
     * @param $table таблица
     * @param $id ID
     * @param string $idName имя столбца (первичного ключа). По умолчанию 'id'
     */
    public function delete($table, $id, $idName = "id")
    {
        $query = $this->pdo->prepare("DELETE FROM $table WHERE $idName = :id");
        $params = [
            ":id" => $id
        ];

        $query->execute($params);
    }


    /**`
     * Возвращает строки по результату сиимметричного соединения (INNER JOIN) двух таблиц ($fromTable, $joinTable)
     * по полям ($fromTableColumn, $joinTableColumn)
     *
     * @param $fromTable
     * @param $joinTable
     * @param $fromTableColumn
     * @param $joinTableColumn
     * @param string $type тип соединения (INNER, LEFT, RIGHT) JOIN
     * @return array
     */
    public function getAllJoinTables($fromTable, $joinTable, $fromTableColumn, $joinTableColumn, $type = "INNER")
    {
        $query = $this->pdo->prepare("SELECT * 
                                                 FROM $fromTable 
                                                      $type JOIN $joinTable on $fromTable.$fromTableColumn = $joinTable.$joinTableColumn");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * Возвращает строку по результату $type (INNER, LEFT или RIGHT) соединения двух таблиц ($fromTable, $joinTable)
     * по полям ($fromTableColumn, $joinTableColumn)
     *
     *
     * @param $fromTable
     * @param $joinTable
     * @param $fromTableColumn
     * @param $joinTableColumn
     * @param $id
     * @param string $idName название столбца
     * @param string $type тип соединения (INNER, LEFT, RIGHT) JOIN
     * @return mixed
     */
    public function getRowJoinTables($fromTable, $joinTable, $fromTableColumn, $joinTableColumn, $id, $idName = "id", $type = "INNER")
    {
        $query = $this->pdo->prepare("SELECT * 
                                                 FROM $fromTable 
                                                      $type JOIN $joinTable on $fromTable.$fromTableColumn = $joinTable.$joinTableColumn 
                                                 WHERE $fromTable.$idName = :id LIMIT 1");
        $params = [
            'id' => $id
        ];
        $query->execute($params);

        return $query->fetch(PDO::FETCH_OBJ);
    }


    /**
     * Поиск по таблице
     *
     * @param $table
     * @param $like
     * @param $firstColumn
     * @param null $secondColumn
     * @param null $thirdColumn
     * @return array
     */
    public function search($table, $like, $firstColumn, $secondColumn = NULL, $thirdColumn = NULL)
    {
        $like = '"%' . $like . '%"';
        $firstColumn = ($firstColumn) ? "$firstColumn LIKE $like" : NULL;
        $secondColumn = ($secondColumn) ? "OR $secondColumn LIKE $like" : NULL;
        $thirdColumn = ($thirdColumn) ? "OR $thirdColumn LIKE $like" : NULL;
        $query = $this->pdo->prepare("SELECT * FROM $table WHERE $firstColumn $secondColumn $thirdColumn");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
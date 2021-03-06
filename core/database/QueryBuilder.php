<?php
/**
 * Created by PhpStorm.
 * User: remco
 * Date: 05/10/2018
 * Time: 21:03
 */

class QueryBuilder
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table, $intoClass)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
    }

    public function comparator($email)
    {
        $password = $this->pdo->prepare("SELECT password FROM users WHERE email = '{$email}'");
        $password->execute();

        return $password->fetchAll(PDO::FETCH_ASSOC);
    }

    public function simpleSelectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectEvents(){

        $statement = $this->pdo->prepare("Select * from events order by date_event DESC ");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectOne($table, $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE `id` = '{$id}' ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    //<editor-fold desc="EVENTS">


    public function insertEvent($date_event, $eventname, $pictures, $description)
    {
        $query = $this->pdo->prepare("INSERT INTO events (`date_event`, `eventname`, `pictures`, `description`) VALUES ('{$date_event}', '{$eventname}', '{$pictures}', '{$description}');");
        $query->execute();
    }

    public function updateEvent($date_event, $eventname, $pictures, $description, $id)
    {
        $statement = $this->pdo->prepare("UPDATE events
        SET `date_event` = '{$date_event}', `eventname` ='{$eventname}', `pictures` = '{$pictures}',`description` = '{$description}'
        WHERE `id` = '{$id}'");

        $statement->execute();
    }

    //</editor-fold>

    public function delete($id, $table)
    {
        $statement = $this->pdo->prepare("DELETE FROM {$table} WHERE `id` = {$id}");
        var_dump($statement);

        $statement->execute();
    }

    public function insertMessage($email, $onderwerp, $bericht, $datum)
    {
        $statement = $this->pdo->prepare("INSERT INTO contact(email, onderwerp, bericht, datum) VALUES('{$email}','{$onderwerp}', '{$bericht}', '{$datum}')");
        $statement->execute();
    }

    public function insertDashboardMessage($email, $onderwerp, $bericht, $datum, $voorID)
    {
        $statement = $this->pdo->prepare("INSERT INTO contact(email, onderwerp, bericht, datum, voorID) VALUES('{$email}', '{$onderwerp}', '{$bericht}', '{$datum}', '{$voorID}')");
        $statement->execute();
    }

    public function selectAllMessages($intoClass, $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM contact where voorID = '{$id}' ORDER BY datum DESC ");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
    }


    public function selectMessage($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM contact WHERE id = {$id}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Berichten');
    }


    public function selectAdminMessages()
    {
        $statement = $this->pdo->prepare("SELECT * FROM contact WHERE voorID = 0");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Berichten');
    }

    public function selectUserID($email)
    {
        $statement = $this->pdo->prepare("SELECT id FROM users WHERE email = '{$email}'");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectUser($id)
    {
        $user = $this->pdo->prepare("SELECT * FROM users WHERE id = {$id}");
        $user->execute();

        return $user->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectUsers($id)
    {
        $user = $this->pdo->prepare("SELECT * FROM users WHERE id in ($id)");
        $user->execute();

        return $user->fetchAll(PDO::FETCH_CLASS, 'Users');
    }

    public function selectChildren()
    {
        $user = $this->pdo->prepare("SELECT * FROM users WHERE function = 'Kind'");
        $user->execute();

        return $user->fetchAll(PDO::FETCH_ASSOC);
    }

    //select profile
    public function selectProfile($profile, $id)
    {
        $user = $this->pdo->prepare("SELECT * FROM {$profile} WHERE id = {$id}");
        $user->execute();

        return $user->fetchAll(PDO::FETCH_ASSOC);
    }

    //<editor-fold desc="INSERT USERS">
    public function insertUser($fname, $lname, $email, $password, $mobile, $function)
    {
        $statement = $this->pdo->prepare("INSERT INTO users(fname, lname, email, password, mobile, function) VALUES('{$fname}','{$lname}', '{$email}', '{$password}', '{$mobile}', '{$function}');");
        $statement->execute();
    }

    public function insertAdmin($id, $nickname, $dob)
    {
        $statement = $this->pdo->prepare("insert into profiles_owners(id, nickname, dob) values({$id}, '{$nickname}', '{$dob}')");
        $statement->execute();
    }

    public function insertSpecialist($id, $nickname, $dob, $description)
    {
        $statement = $this->pdo->prepare("insert into profiles_doctors(id, nickname, dob, description) values({$id}, '{$nickname}', '{$dob}', '{$description}')");
        $statement->execute();
    }

    public function insertParent($id, $nickname, $dob, $rights)
    {
        $statement = $this->pdo->prepare("insert into profiles_parents(id, nickname, dob, rights) values({$id}, '{$nickname}', '{$dob}', {$rights})");
        $statement->execute();
    }

    public function insertKid($id, $nickname, $dob, $reason)
    {
        $statement = $this->pdo->prepare("insert into profiles_kids(id, nickname, dob, reason) values({$id}, '{$nickname}', '{$dob}', '{$reason}')");
        $statement->execute();
    }

    //</editor-fold>

    public function selectDBPassword($id)
    {
        $statement = $this->pdo->prepare("SELECT password FROM users WHERE id = {$id}");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changePassword($password, $id)
    {
        $statement = $this->pdo->prepare("update users set password = '{$password}' where id = '{$id}'");
        $statement->execute();
    }

    public function alterUser($email, $mobile, $id)
    {
        $user = $this->pdo->prepare("update users set email ='{$email}', mobile = '{$mobile}' where id = '{$id}';");
        $user->execute();
    }

    public function addNote($by, $date, $description, $kidID)
    {
        $user = $this->pdo->prepare("insert into day2dayinformation(byname, date, description, idkid) values('{$by}', '{$date}', '{$description}', '{$kidID}')");
        $user->execute();
    }

    public function selectNotes($kidID)
    {
        $user = $this->pdo->prepare("select * from day2dayinformation where idkid = {$kidID} order by date desc");
        $user->execute();

        return $user->fetchAll(PDO::FETCH_ASSOC);
    }

    public function safeuseredit($data)
    {
        $statement = $this->pdo->prepare("Update users set fname = '{$data["fname"]}', lname = '{$data["lname"]}', email = '{$data["email"]}',
                                          mobile = '{$data["mobile"]}', nickname = '{$data["nickname"]}', function = '{$data["function"]}' where id = '{$data["id"]}' ");
        $statement->execute();
    }
    public function read($id){
        $statement = $this->pdo->prepare("update contact set gelezen = 1 where id = {$id}");

        $statement->execute();
    }

    public function unreadMessages($id){
        $statement = $this->pdo->prepare("select * from contact where gelezen = 0 and voorID = {$id}");

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resetpassword($password, $id)
    {
        $statement = $this->pdo->prepare("update users set password = '{$password}' where id = '{$id}'");
        $statement->execute();
    }

    public function pairUsers($userID, $childID, $function)
    {
        $statement = $this->pdo->prepare("insert into pair_users(userID, childID, function) values('{$userID}', '{$childID}', '{$function}')");
        $statement->execute();
    }

    public function selectPairedChild($id)
    {
        $statement = $this->pdo->prepare("Select childID from pair_users where userID = '{$id}'");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}

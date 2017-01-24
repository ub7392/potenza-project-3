<?php

class Application_Model_Init{
  public function initDb(){
    $host='localhost';
    $username='root';
    $password='root';
    $database='project3';

    $conn=mysql_connect($host, $username, $password);

    if(!$conn) {
        die("Connection failed: ".$conn->error);
    }else{
        //echo("Connected successfully \n");
    }

    $createDB="CREATE DATABASE IF NOT EXISTS ".$database;
    if(mysql_query($createDB))
    {
      //echo("Database exists \n");
    }else{
      echo ("CONNECTION FAILED ".$conn->error);
      die();
    }

    mysql_select_db($database);

    $people="CREATE TABLE if not exists people
               (people_id  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                first_name  varchar(255),
                last_name  varchar(255),
                favorite_food  varchar(255)
                );";

             if(mysql_query($people)===TRUE)
              {
                //echo("People table created \n");
              }else{
                echo("Error creating people table: ".mysql_error());
                die();
              }

    $states="CREATE TABLE if not exists states
               (states_id  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                states_name  varchar(255),
                states_abbreviation  varchar(255)
              )";

    $addstates="INSERT INTO states
                  (states_name, states_abbreviation)
                  values('Louisiana', 'LA'),
                        ('Texas', 'TX'),
                        ('Alabama', 'AL'),
                        ('Mississippi', 'MS'),
                        ('Florida', 'FL'),
                        ('California', 'CA'),
                        ('New York', 'NY'),
                        ('Colorado', 'CO'),
                        ('Utah', 'UT'),
                        ('Tennessee', 'TN')";

    $result=mysql_query("SELECT * FROM states");

    if(mysql_num_rows($result)== 0){
      mysql_query($addstates);
    }

    if(mysql_query($states)===TRUE)
    {
        //echo("States table with tables created \n");
    }else{
      echo("Error creating states table: ".mysql_error());
    }

    $visits="CREATE TABLE if not exists visits
               (id  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                person_id  int,
                state_id  int,
                date_visited  varchar(255),
                FOREIGN KEY (person_id) REFERENCES people(people_id),
                FOREIGN KEY (state_id) REFERENCES states(states_id)
                );";

    if(mysql_query($visits)===TRUE)
    {
      //echo("Visits table created \n");
    }else{
      echo("Error creating visits table: ".mysql_error());
    }

    $addperson="INSERT INTO people
                (first_name, last_name, favorite_food)
                values('Laura', 'Bui', 'Candy')";

    $result1=mysql_query("SELECT * FROM people");

    if(mysql_num_rows($result1)== 0){
      mysql_query($addperson);
    }

    $addvisit="INSERT INTO visits
                (person_id, state_id, date_visited)
                values('1', '1', '01/01/01')";

    $result2=mysql_query("SELECT * FROM visits");

    if(mysql_num_rows($result2)==0){
      mysql_query($addvisit);
    }

  }
}
?>

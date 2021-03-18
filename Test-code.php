<?php 

// Env file
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "rayainar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS  airports (
id INT(6) UNSIGNED AUTO_INCREMENT,
name_airport VARCHAR(30) NOT NULL,
code VARCHAR(30) NOT NULL,
lat VARCHAR(50),
ing VARCHAR(50),
PRIMARY KEY (id),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
// Checking if the table is created
if ($conn->query($sql) === TRUE) {
    echo "Table airports created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  } 



 
  
  // data that will be insert into Table airports
  $airports = array(
     array(
        'gandhi',
        'forex',
        'forex',
        'forex',

    ),

     array(
        'gan',
        'duro',
        'sfsf',
        'ffssf',

    ),
);

// creating sql varaible to insert the value of the array
$sql = "INSERT INTO airports (name_airport, code, lat, ing) VALUES ";
// initialization of an array
$airports_sql = array();
var_dump($airports_sql);
// looping the varaible to insert the value of it
if (count($airports)) {
    foreach ($airports as $item) {
        $airports_sql[] = "( '{$item[0]}', '{$item[1]}', '{$item[2]}', '{$item[3]}')";
    }
}
// inserting the value and and adding it.
$sql .= implode(", ", $airports_sql);
// checking if the value is correct
/* var_dump($sql); */



// checking if the record is properly inserted
if ($conn->query($sql) === TRUE) {
    echo "New record in airports created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  };



 // creation table of flights 
 $sql = "CREATE TABLE IF NOT EXISTS   flights (
    id INT(11) UNSIGNED AUTO_INCREMENT,
    code_departure VARCHAR(30) NOT NULL,
    code_arrival VARCHAR(30)  NOT NULL,
    stopovers VARCHAR(30)  NOT NULL,
    price FLOAT(4,2),
    PRIMARY KEY(id),
    airport_id INT(11) UNSIGNED,
    FOREIGN KEY (airport_id) REFERENCES airports(id),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
// checking if the table is inserted
if ($conn->query($sql) === TRUE) {
    echo "Table flights created successfully";
  } else {
    echo "Error creating table flights: " . $conn->error;
  } 
// array of flights
$flights = array(
    array(
       '1',
       '1',
       'A450',
       '50',
       '1'
       

   ),

    array(
       '2',
       '2',
       'duro',
       '70',
       '2'

   ),
);

/* var_dump($flights);
 */

 // creation of varaible that insert the key and value of the array
$sql = "INSERT INTO flights ( stopovers,airport_id,code_departure, code_arrival, price) VALUES ";
// initialization of an array
$flights_sql = array();

// looping the array to insert the value in the other array
if (count($flights)) {
    foreach ($flights as $item) {
        $flights_sql[] = "( '{$item[0]}', '{$item[1]}', '{$item[2]}', '{$item[3]}', '{$item[4]}')";
    }
}
// insert the value and adding it.
$sql .= implode(", ", $flights_sql);
// checking the value
/* var_dump($sql); */

// checking if the record is insert properly
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  
  // creation of a query that find the minimum price and if the flights has only 1 stopovers.
  $query = ( "SELECT MIN(flights.price) AS lowestPrice FROM flights INNER JOIN 
   airports ON flights.airport_id = airports.id WHERE (flights.stopovers = 1)");
   // boolean value that check if th query is written properly
  $result = $conn->query($query);
   // checking the result
 /*  var_dump($result); */

        // looping the array until has value to fetch
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
           $rows[] = $row;
        }

        var_dump($rows);

     
        // looping the array to get the final data the solution of the query
        if (count($rows)) {
            foreach ($rows as $item) {
              // printing the result
               echo $item['lowestPrice'];
            }
        }
        
        
        
        /* free result set */
        $result->close();

$conn->close();
?>
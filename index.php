<!DOCTYPE html>
<html>
<head>
   <title>doc</title>
</head>
<body>
 
   <?php


     $_metodoClient = $_SERVER['REQUEST_METHOD'];
     $page = isset($_GET['page']) ? $_GET['page'] : 0;
     $size = isset($_GET['size']) ? $_GET['size'] : 20;

   if($_metodoClient === "GET" && !isset($_GET['id']))
   {
 
        require('database/data.php');
        $query = "SELECT * FROM employees ORDER BY id LIMIT" . $page * $size . ", " . $size;    

        $url = "http://172.17.0.1:8080";
        $totalElements = totalElements();
        $lastPage = ceil($totalElements / $size);
        $nextPage = ($page == $lastPage) ? $page : $page + 1;

        $data = array(
            "_embedded" => array("employees" => array()),
            "_links" => array(
                "first" => array("href" => "{$url}/employees?page=0&size=" . $size),
                "last" => array("href" => "{$url}/employees?page=" . $lastPage . "&size=" . $size),
                "next" => array("href" => "{$url}/employees?page=" . $nextPage . "&size=" . $size),
                "self" => array("href" => "{$url}/employees?page=" . $page . "&size=" . $size)
            ),
            "page" => array(
                "number" => $page,
                "size" => $size,
                "totalElements" => $totalElements,
                "totalPages" => $lastPage
            )
        );

        $employeeNumber = 0;
        while ($row = $queryResult->fetch_assoc()) {
            $data["_embedded"]["employees"][$employeeNumber]["birthDate"] = $row["birth_date"];
            $data["_embedded"]["employees"][$employeeNumber]["firstName"] = $row["first_name"];
            $data["_embedded"]["employees"][$employeeNumber]["gender"] = $row["gender"];
            $data["_embedded"]["employees"][$employeeNumber]["hireDate"] = $row["hire_date"];
            $data["_embedded"]["employees"][$employeeNumber]["id"] = $row["id"];
            $data["_embedded"]["employees"][$employeeNumber]["lastName"] = $row["last_name"];
            $employeeNumber++;
        }
        $connessione->query($query); 
   

   } else if($requestedMethod === "GET" && isset($_GET['id']))
     {

        require('database/data.php');
        $query = "SELECT * FROM employees WHERE id = $id";
        $data = array();

        while ($row = $queryResult->fetch_assoc())
        {
            
            $data["birthDate"] = $row["birth_date"];
            $data["firstName"] = $row["first_name"];
            $data["gender"] = $row["gender"];
            $data["hireDate"] = $row["hire_date"];
            $data["id"] = $row["id"];
            $data["lastName"] = $row["last_name"];
        }
        $connessione->query($query); 


   } else if($_metodoClient == "POST")
     {

        require('database/data.php');
        $query = "INSERT INTO employees VALUES(DEFAULT, '$data->birthDate', '$data->firstName', '$data->lastName', '$data->gender', '$data->hireDate');";
        $connessione->query($query); 

   }else if($_metodoClient == "DELETE")
     {
    
        require('database/data.php');
        $query = "DELETE FROM employees WHERE id = $id";
        $connessione->query($query); 

   }else if($_metodoClient == "PUT")
    {

        require('database/data.php');
        $query = "UPDATE employees SET birth_date = '$data->birthDate', first_name = '$data->firstName', gender = '$data->gender', hire_date = '$data->hireDate', last_name = '$data->lastName' WHERE id = '$data->id'";
        $connessione->query($query); 
   }

   function totalElements()
{
    require('database/data.php');
    $query = "SELECT COUNT(*) FROM employees";
    $result = $connessione->query($query);
    $row = $result->fetch_array();
    return intval($row[0]);
}
 
   ?>
  
</body>
</html>


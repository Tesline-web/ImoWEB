<?php 
session_start();
function get_PDO():PDO{
    $host = '127.0.0.1';
    $db   = 'imo';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    // Set PDO options
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

    ];

    try {
        // Create a PDO instance (connect to the database)
    return $pdo = new PDO($dsn, $user, $pass, $options);
    
    } catch (\PDOException $e) {
       // throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

}

function sign_in($mail,$password){
    if(check_user_not_exist($mail) == true){
        $pdo = get_PDO();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(mail,pass) VALUES(?,?)";
        $stmt = $pdo->prepare($query);
      if($stmt->execute([$mail, $password]) ){
        $_SESSION['connected'] = true;
        $_SESSION['mail'] = $mail;
        header("Location: account.php");
      }else{
        header("Location: sign_in.php");
        
      }    

    } 
    else{

    }

}

function check_user_not_exist($mail){
   $pdo = get_PDO();
   $query = "SELECT mail FROM users WHERE mail = ?";
   $stmt = $pdo->prepare($query);
    $stmt->execute([$mail]);
    $nombreUtilisateurs = $stmt->fetchColumn();
    if($nombreUtilisateurs > 0){
        return false;
    }
    else{
        return true;
    }

   
}


function get_user($mail){
    $pdo = get_PDO();
    $query = "SELECT  * FROM users WHERE mail = ?";
   $stmt = $pdo->prepare($query);
    $stmt->execute([$mail]);
   
    $user = $stmt->fetch();
    
    return $user;

}

function login($mail,$password){
    
  $pdo = get_PDO();
  if(!check_user_not_exist($mail)){
  
    $user = get_user($mail);
     if(password_verify($password, $user['pass'])){
      $_SESSION['connected'] = true;
      $_SESSION['mail'] = $mail;
      header("Location: admin_blog.php");
    }
    else{
      header("Location: login.php");
    }

  }
}

function get_exerpt($content){
    $exerpt = substr($content,0,150);
    return $exerpt."...";
}

function logout(){
    session_unset();
    
    session_destroy();
    header("Location: index.php ");
}
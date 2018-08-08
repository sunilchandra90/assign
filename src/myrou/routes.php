<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/api/routes', function (Request $request, Response $response) {
    $sql = "SELECT * FROM bank_details";
    try{


        $db = new db ();

        $db = $db->connect();


        $stmt = $db->query($sql);
        ini_set('memory_limit', '-1');
        // ini_set('memory_limit', '256M');
        $bank_details = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($bank_details);


    } catch(PDOException $e) {

        echo '{"error": {"text":  '.$e->getMessage().'}';

    }
    
    // $name = $args['name'];
    // $response->getBody()->write("Hello, $name");

    // return $response;
});
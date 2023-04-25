<?php

function getConnection($id){
    $cn = mysqli_connect('localhost', 'root', 'root');

    mysqli_set_charset($cn, "UTF-8");

    if (!$cn){
        die("Aurora Studios Services: Could not connect to database. Please try again later.");
    }

    $sql = "SELECT * FROM empregest.newstable WHERE Num = '$id'";

    $res = mysqli_query($cn, $sql);

    if ($res->num_rows > 0) {
        $fila = $res->fetch_assoc();
        $information = array(
            'Title' => $fila['title'],
            'Information' => $fila['info'],
            'URL' => $fila['url']
        );

        return $information;
    }
}


function ObtainNewsInformation($newsSection, $id, $max){

    $i = 0;

    while ($i < $max){
        $s = getConnection($id);

        if($s){
            if ($newsSection == "title"){
                return $s['Title'];
            }
            else if ($newsSection == "info"){
                return $s['Information'];
            }
            else{
                return $s['URL'];
            }

            $i++;
        }
        else{
            die("Espera atento a nuevas noticias!   -Aurora Studios");
        }
    }
}
?>
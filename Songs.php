<?php

require_once "CrudConnection.php";

class Songs extends CrudConnection
{
    private $connection;

    public function __construct()
    {
        $this->connection = $this->connectDatabase();
    }

    public function getRows()
    {
        $seeAllQuery = 'SELECT title, artist FROM song';
        foreach ($this->connection->query($seeAllQuery) as $row) {
            $rows[] = [
                $row['title'],
                $row['artist']
            ];
        }
        return $rows;
    }

    public function addRow($id_coder, $title, $artist, $genre, $url, $date, $status)
    {
        $addRowQuery = "insert into song (id_coder,title,artist,genre,url,date,status) values ('$id_coder','$title' ,'$artist', '$genre', '$url', '$date', '$status')";
        $resultAdd = $this->connection->query($addRowQuery);
        echo "Se ha insertado correctamente " . $title . "\n";
        if ($resultAdd){
            return true;
        }else {
            return false;
        }
    }

    function updateRow($id_song, $id_coder, $title, $artist, $genre, $url, $date, $status)
    {
        $updateQuery = "UPDATE song
        SET id_coder ='$id_coder', title = '$title', artist = '$artist', genre = '$genre', url = '$url', date = '$date', status='$status'
        WHERE id_song = '$id_song' ";

        $resultUpdate = $this->connection->query($updateQuery);
        echo "Se ha modificado correctamente el " . $title . "\n";
        if ($resultUpdate){
            return true;
        }else {
            return false;
        }
    }

    function deleteRow($id_song)
    {
        $deleteQuery = "DELETE FROM song WHERE id_song = '$id_song'";
        $resultDelete = $this->connection->query($deleteQuery);
        echo "Se ha eliminado correctamente " . $id_song . "\n";
        if ($resultDelete){
            return true;
        }else {
            return false;
        }
    }

    //--------------------------------------
    /**
     * La he añadido para facilitarme las inserciones
     */
    public function addRow2($id_coder, $title, $artist, $genre, $url, $date, $status)
    {
        $addRowQuery = "insert into song (id_coder,title,artist,genre,url,date,status,img) values ($id_coder,'$title' ,'$artist', '$genre', '$url', '2023-02-14 00:00:00.000000', $status,'defecto')";
        try {
            $resultAdd = $this->connection->query($addRowQuery);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $resultAdd = false;
        }

        if ($resultAdd){
            return true;
        }else {
            return false;
        }
    }
}
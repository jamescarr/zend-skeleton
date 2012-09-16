<?php
// modules/Album/src/Album/Model/GenreTable.php
namespace Album\Model;


class GenreTable {
    public function fetchAllAsArray(){
        return array(
                'alt' => 'Alternative',
                'country' => 'Country',
                'jazz' => 'Jazz',
                'rap' => 'Rap',
                'rock' => 'Rock'
            );
    }
}

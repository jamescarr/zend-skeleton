<?php
// module/Album/src/Album/Model/Album.php:
namespace Album\Model;

use Zend\Form\Annotation as Form;

class Album{
    /**
     * @Form\Required(false)
     * @Form\Attributes({"type":"hidden"})
     */
    public $id;
    
    /**
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Artist"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Validator({"name":"StringLength", "options":{"min":1, "max":100}})
     */
    public $artist;
    
    /**
     * @Form\Required(true)
     * @Form\Attributes({"type":"text"})
     * @Form\Options({"label":"Title"})
     * @Form\Filter({"name":"StringTrim"})
     * @Form\Filter({"name":"StripTags"})
     */
    public $title;

    /** 
     * @Form\Type("Zend\Form\Element\Select")
     * @Form\Options({"label":"Genre", "value_options":{
     *      "Rap":"Rap", 
     *      "Jazz":"Jazz", 
     *      "Alternative":"Alternative", 
     *      "Rock":"Rock"
     *      }
     * })
     */
    public $genre;

    public function exchangeArray($data){
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->artist = (isset($data['artist'])) ? $data['artist'] : null;
        $this->title  = (isset($data['title'])) ? $data['title'] : null;
        $this->genre  = (isset($data['genre'])) ? $data['genre'] : null;
    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }
}

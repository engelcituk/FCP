<?php
class idiomas{
    public $idioma;
    function  __construct() {
        $this->idioma =
        array(
            'espanol'=> array(
                0=>"Español",
                1=>"Ingles",
                2=>"Maya",
                3=>"Inicio",
                4=>"Aventuráte",
                5=>"ViveFCP",
                6=>"Conoce",
                7=>"Foro",
                8=>"Arqueología",
                9=>"Bellezas Naturales",
                10=>"Ecoturismo",
                11=>"Pueblos Emblematicos",
                12=>"Comiendo",
                13=>"Durmiendo",
                14=>"Servicios",
                15=>"Descripción",
                16=>"Localización",
                17=>"Cruz Parlante",
                18=>"Muyil"
            ),
            'ingles' => array(
                0=>"Spanish",
                1=>"English",
                2=>"Mayan",
                3=>"Home",
                4=>"Adventure",
                5=>"LiveFCP",
                6=>"Known",
                7=>"Forum",
                8=>"Archaeology",
                9=>"Natural Beauties",
                10=>"Ecotourism",
                11=>"Emblematic Villages",
                12=>"Eating",
                13=>"Sleeping",
                14=>"Services",
                15=>"Description",
                16=>"Location",
                17=>"Cruz Parlante",
                18=>"Muyil"

            )
        );
        return $this->idioma;
    }
}
?>
<?php
class View {

    public function showOptions($options) {
        $count = count($options);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion

        // mostrar el template
        require 'templates/listOptions.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }


    public function showPets($pets){
        require 'templates/pets.phtml';
    }

    public function showOwners($owners){
        require 'templates/owners.phtml';
    }

    public function showOwnersAndPets($pets,$owners){
        require 'templates/pets.phtml';
        require 'templates/owners.phtml';
    }

    public function showSpecificOwner($owner){
        require 'templates/specificOwner.phtml';
    }

    public function showSpecificPet($pet){
        require 'templates/specificPet.phtml';
    }
}
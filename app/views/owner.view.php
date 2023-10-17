<?php
class OwnerView {

    public function showOptions($options) {
        $count = count($options);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion

        // mostrar el template
        require 'templates/listOptions.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
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

    public function showSpecificPet($pet,$owner){
        require 'templates/specificPet.phtml';
    }

    public function showEditOwner($item){
        $itemType = 'owner';
        require 'templates/formCreateEdit.phtml';
    }

    public function showCreateOwner(){
        $itemType = 'owner';
        require 'templates/formCreateEdit.phtml';
    }
}
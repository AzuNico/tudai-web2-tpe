<?php
class View {

    public function showOptions($options) {
        require 'templates/home.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }


    public function showPets($pets,$owners){
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

    public function showSpecificPet($pet,$owner){
        require 'templates/specificPet.phtml';
    }
}
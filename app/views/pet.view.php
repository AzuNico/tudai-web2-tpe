<?php
class PetView
{

    public function showOptions($options) {
        require 'templates/home.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }


    public function showPets($pets, $owners)
    {
        require 'templates/pets.phtml';
    }

    public function showOwners($owners)
    {
        require 'templates/owners.phtml';
    }

    public function showPetsByOwner($owner,$pets){
        require 'templates/petsByOwner.phtml';
    }

    public function showSpecificOwner($owner)
    {
        require 'templates/specificOwner.phtml';
    }

    public function showSpecificPet($pet, $owner)
    {
        require 'templates/specificPet.phtml';
    }

    public function showEditPet($item, $owners)
    {
        $itemType = 'pet';
        require 'templates/formCreateEdit.phtml';
    }

    public function showCreatePet($owners)
    {
        $itemType = 'pet';
        require 'templates/formCreateEdit.phtml';
    }
}

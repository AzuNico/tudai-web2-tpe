<?php
class PetView
{

    public function showOptions($options) {
        require 'templates/listOptions.phtml';
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

    public function showOwnersAndPets($pets, $owners)
    {
        require 'templates/pets.phtml';
        require 'templates/owners.phtml';
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

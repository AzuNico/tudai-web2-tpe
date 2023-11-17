<?php
class OwnerView
{

    public function showOptions($options)
    {
        require 'templates/home.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }


    public function showOwners($owners)
    {
        require 'templates/owners.phtml';
    }

    public function showSpecificOwner($owner, $pets)
    {
        require 'templates/specificOwner.phtml';
    }

    public function showSpecificPet($pet, $owner)
    {
        require 'templates/specificPet.phtml';
    }

    public function showEditOwner($item)
    {
        $itemType = 'owner';
        require 'templates/formCreateEdit.phtml';
    }

    public function showCreateOwner()
    {
        $itemType = 'owner';
        require 'templates/formCreateEdit.phtml';
    }
}

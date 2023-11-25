<?php
class View {
    
    public function showError404() {
        require 'templates/404.phtml';
    }

    public function showError500() {
        require 'templates/500.phtml';
    }

}
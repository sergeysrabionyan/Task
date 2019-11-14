<?php

namespace MyProject\Controllers;

use MyProject\Models\Numbers\Numbers;

class FunctionalController extends AbstractController
{
    public function plusOne()
    {
        if (isset($this->user)) {
            $number = Numbers::getUserId($this->user->getId());
            $number->plusOneNumber();
            $number->save();
            $this->view->renderHtml('PageMain.php', [
                 'number' => $number]);
        } else {
            $this->view->renderHtml('login.php');
            return;
        }
    }

}
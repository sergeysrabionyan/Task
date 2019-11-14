<?php

namespace MyProject\Controllers;

use MyProject\Models\Numbers\Numbers;
use MyProject\Exceptions\UnathorizedException;

class MainController extends AbstractController
{

    public function main()
    {
        if ($this->user) {
            $number = Numbers::getUserId($this->user->getId());
            $this->view->renderHtml('PageMain.php', [
                 'number' => $number]);
            return;
        } else {
            throw new UnathorizedException();
        }
    }

}
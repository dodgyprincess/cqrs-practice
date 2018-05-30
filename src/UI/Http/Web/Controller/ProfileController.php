<?php

declare(strict_types=1);

namespace App\UI\Http\Web\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractRenderController
{
    /**
     * @Route(
     *     "/profile",
     *     name="profile",
     *     methods={"GET"}
     * )
     */
    public function profile()
    {
        return $this->render('profile/index.html.twig');
    }

    public function sayHello(Request $request) {
    }
}

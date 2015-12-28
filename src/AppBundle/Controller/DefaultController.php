<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    private $supportedLanguages = ['fr', 'en'];

    /**
     * Redirects from base path to localized one depending on client preferred language
     * @Route("/")
     */
    public function indexLangRedirectAction(Request $request)
    {
        $lang = $request->getPreferredLanguage($this->supportedLanguages);
        return $this->redirect($this->generateUrl('homepage', ['_locale' => $lang]));
    }

    /**
     * @Route("/{_locale}/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $fallbackLocale = $this->getParameter('locale');
        if (!in_array($request->getLocale(), $this->supportedLanguages))
            return $this->redirectToRoute('homepage', ['_locale' => $fallbackLocale]);

        // replace this example code with whatever you need
        return $this->render('AppBundle::index.html.twig');
    }
}

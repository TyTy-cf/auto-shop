<?php


namespace App\Controller\Front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

class LdlcPs5Controller extends AbstractController
{
    /**
     * @Route("/ldlc-ps5", name="ldlc_ps5")
     */
    public function __invoke()
    {
        $browser = new HttpBrowser(HttpClient::create());
        $list = $browser->request('GET', 'https://www.ldlc.com/jeux-loisirs/console/console-ps5/c7865/');

        dump($list->filter('body .listing-product ul > li .wrap-stock .stock span')->getNode(1)->textContent);


//        foreach (->getIterator() as $node) {
//            dump($node->textContent);
//        }


        return $this->render('Front/LDLC/index.html.twig', [

        ]);
    }
}

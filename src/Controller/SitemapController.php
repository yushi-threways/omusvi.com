<?php

namespace App\Controller;

use App\Entity\MyEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     */
    public function index(Request $request)
    {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];
        $urls[] = ['loc' => $this->generateUrl('default_index')];
        $urls[] = ['loc' => $this->generateUrl('fos_user_security_login')];
        $urls[] = ['loc' => $this->generateUrl('fos_user_registration_register')];
        $urls[] = ['loc' => $this->generateUrl('my_event_venue_index')];
        $urls[] = ['loc' => $this->generateUrl('contact_index')];
        $urls[] = ['loc' => $this->generateUrl('my_event_index')];
        $urls[] = ['loc' => $this->generateUrl('omipari_static', ['page' => 'pp'])];
        $urls[] = ['loc' => $this->generateUrl('omipari_static', ['page' => 'aosct'])];
        $urls[] = ['loc' => $this->generateUrl('omipari_static', ['page' => 'agree'])];
        $urls[] = ['loc' => $this->generateUrl('omipari_static', ['page' => 'about'])];

        foreach ($this->getDoctrine()->getRepository(MyEvent::class)->findAll() as $myEvent) {
            $images = [
                'loc' => 'https://omusvi.com/images/my_events/' . $myEvent->getImageName(),
                'title' => $myEvent->getName()
            ];

            $urls[] = [
                'loc' => $this->generateUrl('my_event_index', [
                    'id' => $myEvent->getId()
                ]),
                'image' => $images,
                'lastmod' => $myEvent->getUpdatedAt()->format('Y-m-d')
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname
            ]),
            200
        );

        // dd($urls);

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}

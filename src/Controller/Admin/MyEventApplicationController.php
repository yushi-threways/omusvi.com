<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\DBAL\Types\MyEventApplicationStatusEnumType;
use App\Entity\MyEventApplication;
use App\Service\Mailer\TwigSwiftMailer;
use Sonata\AdminBundle\Controller\CRUDController;

final class MyEventApplicationController extends CRUDController
{
    /**
     * @param MyEventApplication $application
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paiedAction(MyEventApplication $application, TwigSwiftMailer $mailer)
    {
        $this->admin->checkAccess('paied', $application);

        $application->setStatus(MyEventApplicationStatusEnumType::ACCEPTED);
        $this->getDoctrine()->getManager()->flush();

        $mailer->sendMessage('_email/my_event_application/accepted.txt.twig', [
            'data' => $application,
            'user' => $application->getUser(),
            'schedule' => $application->getMyEventSchedule(),
            'my_event' => $application->getMyEventSchedule()->getMyEvent(),
            'detail' => $application->getUser()->getUserDetail(),
        ]);

        $this->addFlash('success', '支払いを確認しました');

        return $this->redirectToList();
    }


    /**
     * @param MyEventApplication $application
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function RejectAction(MyEventApplication $application, TwigSwiftMailer $mailer)
    {
        $this->admin->checkAccess('reject', $application);

        $application->setStatus(MyEventApplicationStatusEnumType::ACCEPTED);
        $this->getDoctrine()->getManager()->flush();

        $mailer->sendMessage('_email/my_event_application/reject.txt.twig', [
            'data' => $application,
            'user' => $application->getUser(),
            'schedule' => $application->getMyEventSchedule(),
            'my_event' => $application->getMyEventSchedule()->getMyEvent(),
            'detail' => $application->getUser()->getUserDetail(),
        ]);

        $this->addFlash('success', '申込を却下しました');

        return $this->redirectToList();
    }
}

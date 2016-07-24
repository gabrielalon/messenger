<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class MessageController
 * @package ApiBundle\Controller
 */
class MessageController extends FOSRestController
{

    /**
     * Get a single note.
     *
     * @ApiDoc(
     *   output = "AppBundle\Model\Message",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="note")
     *
     * @param int $id the note id
     *
     * @return array
     *
     * @throws NotFoundHttpException when note not exist
     */
    public function getAction($id)
    {
        $message = $this->container->get('doctrine.entity_manager')
            ->getRepository('AppBundle:Message')
            ->find($id);

        if (false === $message) {
            throw $this->createNotFoundException("Note does not exist.");
        }

        return new Annotations\View($message);
    }
}
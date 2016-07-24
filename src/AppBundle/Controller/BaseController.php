<?php

namespace AppBundle\Controller;

use AppBundle\Model\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\DataCollectorTranslator;

/**
 * Class BaseController
 * @package AppBundle\Controller
 */
abstract class BaseController extends Controller
{
    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $this->onInvoke($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    abstract public function onInvoke(Request $request);

    /**
     * @return DataCollectorTranslator
     */
    protected function getTranslator()
    {
        return $this->get('translator');
    }

    /**
     * @param Message $message
     *
     * @return Form
     */
    protected function createDeleteForm(Message $message)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('message_delete', ['messageId' => $message->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
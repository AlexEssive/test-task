<?php

namespace Alex\TestProject\Plugin\Save;

use Magento\Framework\App\Request\Http;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class Post
 * @package Alex\TestProject\Plugin\Save
 */
class Post
{
    /**
     * @var Http
     */
    protected $request;

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Post constructor.
     * @param Http $request
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        Http $request,
        ObjectManagerInterface $objectManager
    ) {
        $this->request = $request;
        $this->objectManager = $objectManager;
    }

    public function afterExecute()
    {
        $post = $this->request->getPostValue();
        if (!$post) {
            return;
        }

        $model = $this->objectManager->create('Alex\TestProject\Model\Question');
        $model->setName($post['name']);
        $model->setEmail($post['email']);
        $model->setTelephone($post['telephone']);
        $model->setComment($post['comment']);
        $model->save();
    }
}

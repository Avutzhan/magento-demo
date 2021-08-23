<?php

namespace Inchoo\Blog\Observer;

use Inchoo\Blog\Api\Data\PostInterface;
use Inchoo\Blog\Api\PostManagementInterface;
use Inchoo\Blog\Api\PostRepositoryInterface;
use Inchoo\Blog\Model\Post;
use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Model\Page;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

/**
 * Class PageLoadAfter
 */
class PageLoadAfter implements ObserverInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * PageSaveAfter constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var PageInterface|Page $entity */
        $entity = $observer->getEvent()->getObject();

        /** @var Post $post */
        $post = $this->postRepository->getByPageId($entity->getId());

        if ($post->getId()) {
            $entity->setData('author', $post->getData('author'));
            $entity->setData('is_post', $post->getData('is_post'));
            $entity->setData('publish_date', $post->getData('publish_date'));

        }
    }
}

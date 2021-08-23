<?php

namespace Inchoo\Blog\Observer;

use Inchoo\Blog\Api\PostRepositoryInterface;
use Inchoo\Blog\Model\Post;
use Magento\Cms\Model\Page;
use Magento\Cms\Model\ResourceModel\Page\Collection;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Inchoo\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use Inchoo\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

/**
 * Class PageLoadAfter
 */
class PageCollectionLoadAfter implements ObserverInterface
{
    /**
     * @var PostCollectionFactory
     */
    private $postCollectionFactory;

    /**
     * @param PostCollectionFactory $postCollectionFactory
     */
    public function __construct(PostCollectionFactory $postCollectionFactory)
    {
        $this->postCollectionFactory = $postCollectionFactory;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        /** @var Collection $entity */
        $collection = $observer->getEvent()->getPageCollection();

        $pageIds = [];

        /** @var Page $item */
        foreach ($collection->getItems() as $item) {
            $pageIds[] = $item->getId();
        }

        $postCollection = $this->postCollectionFactory->create();
        $postCollection->addFieldToFilter('page_id', ['in' => $pageIds]);

        foreach ($postCollection->getItems() as $post) {
            $page = $collection->getItemById($post->getPageId());
            if ($page->getId()) {
                $page->setData('author', $post->getData('author'));
                $page->setData('is_post', $post->getData('is_post'));
                $page->setData('publish_date', $post->getData('publish_date'));
            }
        }

    }
}

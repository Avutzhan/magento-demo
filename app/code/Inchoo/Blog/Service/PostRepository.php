<?php

namespace Inchoo\Blog\Service;

use Inchoo\Blog\Api\Data\PostInterface;
use Inchoo\Blog\Api\PostManagementInterface;
use Inchoo\Blog\Api\PostRepositoryInterface;
use Inchoo\Blog\Model\Post;
use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Inchoo\Blog\Model\ResourceModel\Post as PostResource;
use Magento\Framework\Api\SearchCriteriaInterface;
use Inchoo\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use Inchoo\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;

/**
 * Class PostRepository
 */
class PostRepository implements PostRepositoryInterface
{
    private $pageRepository;

    private $searchCriteriaBuilder;

    /**
     * @var PostResource
     */
    private $resource;

    /**
     * @var PostManagementInterface
     */
    private $postManagement;

    /**
     * @var CollectionFactory
     */
    private $postCollectionFactory;

    /**
     * @param PageRepositoryInterface $pageRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PostResource $resource
     * @param PostManagementInterface $postManagement
     * @param PostCollectionFactory $postCollectionFactory
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PostResource $resource,
        PostManagementInterface $postManagement,
        PostCollectionFactory $postCollectionFactory
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resource = $resource;
        $this->postManagement = $postManagement;
        $this->postCollectionFactory = $postCollectionFactory;
    }

    /**
     * @return PageInterface|\Magento\Cms\Api\Data\PageSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get()
    {
        $postCollection = $this->postCollectionFactory->create();
        $postCollection->addFieldToFilter('is_post', ['eq' => 1]);

        $pageIds = [];

        /** @var Post $post */
        foreach ($postCollection->getItems() as $post) {
            $pageIds[] = $post->getData('page_id');
        }

        $searchCriteria = $this->searchCriteriaBuilder->addFilter('page_id', $pageIds, 'in')
            ->create();

        return $this->pageRepository->getList($searchCriteria);

    }

    /**
     * @param int $pageId
     * @return PostInterface|Post
     */
    public function getByPageId($pageId): PostInterface
    {
        $post = $this->postManagement->getEmptyObject();
        $this->resource->load($post, $pageId, 'post_id');

        return $post;
    }

}

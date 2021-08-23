<?php

namespace Inchoo\Blog\Service;

use Inchoo\Blog\Api\Data\PostInterface;
use Inchoo\Blog\Api\PostManagementInterface;
use Inchoo\Blog\Api\PostRepositoryInterface;
use Inchoo\Blog\Model\Post;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Inchoo\Blog\Model\ResourceModel\Post as PostResource;

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
     * @param PageRepositoryInterface $pageRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PostResource $resource
     * @param PostManagementInterface $postManagement
     */
    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PostResource $resource,
        PostManagementInterface $postManagement
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resource = $resource;
        $this->postManagement = $postManagement;
    }

    public function get()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

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

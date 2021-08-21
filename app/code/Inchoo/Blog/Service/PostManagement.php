<?php

namespace Inchoo\Blog\Service;

use Inchoo\Blog\Api\Data\PostInterface;
use Inchoo\Blog\Api\PostManagementInterface;
use Inchoo\Blog\Model\PostFactory;
use Inchoo\Blog\Model\ResourceModel\Post as PostResource;

/**
 * Class PostManagement
 */
class PostManagement implements PostManagementInterface
{
    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * @var PostResource
     */
    private $resource;

    /**
     * @param PostFactory $postFactory
     * @param PostResource $resource
     */
    public function __construct(
        PostFactory $postFactory,
        PostResource $resource
    )
    {
        $this->postFactory = $postFactory;
        $this->resource = $resource;
    }

    /**
     * @return PostInterface
     */
    public function getEmptyObject(): PostInterface
    {
        return $this->postFactory->create();
    }

    /**
     * @param PostInterface $post
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(PostInterface $post)
    {
        $this->resource->save($post);
    }
}

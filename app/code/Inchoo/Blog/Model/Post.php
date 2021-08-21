<?php

namespace Inchoo\Blog\Model;

use Inchoo\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;
use Inchoo\Blog\Model\ResourceModel\Post as PostResource;

/**
 * Class Post
 */
class Post extends AbstractModel implements PostInterface
{
    protected function _construct()
    {
        $this->_init(PostResource::class);
    }
}

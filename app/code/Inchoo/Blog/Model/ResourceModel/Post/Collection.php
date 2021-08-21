<?php

namespace Inchoo\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Inchoo\Blog\Model\Post;
use Inchoo\Blog\Model\ResourceModel\Post as PostResource;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Post::class, PostResource::class);
    }
}

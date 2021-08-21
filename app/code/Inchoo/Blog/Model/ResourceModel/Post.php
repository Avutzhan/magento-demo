<?php

namespace Inchoo\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Post
 */
class Post extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('inchoo_blog_page', 'post_id');
    }
}

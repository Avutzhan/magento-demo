<?php
declare(strict_types=1);

namespace Inchoo\Blog\ViewModel;

use Inchoo\Blog\Service\PostRepository;
use Magento\Cms\Model\Page;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\UrlInterface;

/**
 * Class Blog
 */
class Blog implements ArgumentInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @param SerializerInterface $serializer
     * @param PostRepository $postRepository
     * @param UrlInterface $url
     */
    public function __construct(
        SerializerInterface $serializer,
        PostRepository $postRepository,
        UrlInterface $url
    )
    {
        $this->serializer = $serializer;
        $this->postRepository = $postRepository;
        $this->url = $url;

    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getPosts(): string
    {
        $postsSearchResult = $this->postRepository->get();

        $result = [];

        /**
         * @var PageInterface|Page $post
         */
        foreach ($postsSearchResult->getItems() as $post) {
            $result[] = [
                "id" => $post->getId(),
                "title" => $post->getTitle(),
                "published_date" => $post->getData('publish_date'),
                "url" => $this->url->getUrl($post->getIdentifier()),
                "content" => $this->truncate(strip_tags($post->getContent()), 50),
                "author" => $post->getData('author')
            ];
        }

        return $this->serializer->serialize($result);

    }

    private function truncate($phrase, $max_words)
    {
        $phrase_array = explode(' ', $phrase);
        if (count($phrase_array) > $max_words && $max_words > 0) {
            $phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . '...';
        }
        return $phrase;
    }
}

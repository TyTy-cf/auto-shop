<?php


namespace App\Twig\Extension;


use App\Entity\Post;
use App\Service\PostImageManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FileExtension extends AbstractExtension
{
    private PostImageManager $postImageManager;

    /**
     * FileExtension constructor.
     * @param PostImageManager $postImageManager
     */
    public function __construct(PostImageManager $postImageManager)
    {
        $this->postImageManager = $postImageManager;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('post_image_path', [$this, 'getPostImagePath'])
        ];
    }

    /**
     * @param Post $post
     * @return string
     */
    public function getPostImagePath(Post $post): string
    {
        if(null !== $path = $this->postImageManager->getImagePath($post)) {
            return $path;
        }
        return '/build/images/perceval.jpg';
    }
}

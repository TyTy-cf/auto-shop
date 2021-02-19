<?php


namespace App\Service;


use App\Entity\Post;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostImageManager
{
    //Ajoute une image à un post
    public function addImage(?UploadedFile $file, Post $post)
    {
        (new Filesystem())->remove('uploads/post/' . $post->getThumbnail());
        if (null !== $file) {
            $fileName = uniqid() . '-' . $file->getClientOriginalName();
            $file->move('uploads/post', $fileName);
            $post->setThumbnail($fileName);
        }
    }

    //Retourne le path de l'image ex : /uploads/post/602f7a9737b97-thumb-1920-1014875.jpg
    public function getImagePath(Post $post): ?string
    {
        if ($post->getThumbnail() === null) {
            return null;
        }
        return '/uploads/post/' . $post->getThumbnail();
    }

    //Si une image existe déjà, supprimer l'ancienne
    private function deleteIfReplace(Post $post)
    {
        //$filesystem = new Filesystem();
        //$filesystem->remove('/uploads/post/'.$post->getThumbnail());
        // ou

        (new Filesystem())->remove('uploads/post/' . $post->getThumbnail());
    }
}

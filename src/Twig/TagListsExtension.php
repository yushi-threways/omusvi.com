<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;

class TagListsExtension extends AbstractExtension
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('tag_lists', [$this, 'buildTagLists']),
            
        ];
    }

    public function getTagRepository()
    {
        return $this->em->getRepository(Tag::class);
    }
    
    public function buildTagLists() 
    {
        $tagLists = [];
        $tagRepository = $this->getTagRepository();

        $tagLists = $tagRepository->findAll();

        if ($tagLists == null) {
            $tagLists = "";
        } 
        return $tagLists;
    }
}

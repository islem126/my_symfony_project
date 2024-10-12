<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/showAuthor/{name}', name: 'app_showuathor')]
    public function showauthor($name)
    {
        return $this->render ('author/show.html.twig', [
            'name' => $name
        ]);

    }

    #[Route('/showList', name: 'app_showList')]
    public function list (){
        $authors = array (
            array('id' => 1, 'picture' => '/images/téléchargement (1).jpeg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/téléchargement (2).jpeg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/téléchargement.jpeg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        return $this->render('author/list.html.twig', ["authors" => $authors]);
    }

    #[Route('/affiche', name: 'app_affiche')]
    public function affiche(AuthorRepository $authorRepository){
        $authors = $authorRepository->findAll();
        return $this->render('author/affiche.html.twig', ["list" => $authors]);

    }

    #[Route('/addStatic',name: 'app_static')]
    public function addStatic(ManagerRegistry $doctrine){
        $author = new Author();
        $author->setUsername('test');
        $author->setEmail('test@gmail.com');
        $em=$doctrine->getManager();
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute('app_affiche');    
    }
    
}

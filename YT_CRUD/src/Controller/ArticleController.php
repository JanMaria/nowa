<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class ArticleController extends AbstractController
{
  /**
  * @Route("/", name="article_list")
  * @Method({"GET"})
  */
  public function index()
  {
    $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

    return $this->render('articles/index.html.twig', ['articles' => $articles]);
  }

  /**
  * @Route("/article/new", name="new_article")
  * @Method({"GET", "POST"})
  */
  public function new(Request $request)
  {
    $article = new Article();

    $form = $this->createFormBuilder($article)
    ->add('title', TextType::class, [
      'attr' => [
        'class' => 'form-control'
        ]
      ])
    ->add('body', null, [
      'required' => false,
      'attr' => [
        'class' => 'form-control'
      ]
    ])
    ->add('save', SubmitType::class, [
      'label' => 'Create',
      'attr' => [
        'class' => 'btn btn-primary mt-3'
      ]
    ])
    ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $article = $form->getData();

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($article);
      $entityManager->flush();

      return $this->redirectToRoute('article_list');
    }

    return $this->render('articles/new.html.twig', ['form' => $form->createView()]);
  }

  /**
  * @Route("/article/edit/{id}", name="edit_article")
  * @Method({"GET", "POST"})
  */
  public function edit(Request $request, Article $article)
  {
    // $article = new Article();
    // $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

    $form = $this->createFormBuilder($article)
    ->add('title', TextType::class, [
      'attr' => [
        'class' => 'form-control'
        ]
      ])
    ->add('body', TextareaType::class, [
      'required' => false,
      'attr' => [
        'class' => 'form-control'
        ]
      ])
    ->add('save', SubmitType::class, [
      'label' => 'Update',
      'attr' => [
        'class' => 'btn btn-primary mt-3'
        ]
      ])
    ->getForm();

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->flush();

      return $this->redirectToRoute('article_list');
    }

    return $this->render('articles/edit.html.twig', ['form' => $form->createView()]);
  }

  // tutaj stara metoda bez użycia ParamConverter'a
  // /**
  // * @Route("/article/{id<\d+>}", name="article_show")
  // * @Method({"GET"})
  // */
  // public function show($id)
  // {
  //   $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
  //
  //   return $this->render('articles/show.html.twig', ['article' => $article]);
  // }

  // tutaj, o ile dobrze rozumiem, niejawnie używam ParamConverter'a
  // /**
  // * @Route("/article/{id<\d+>}", name="article_show")
  // * @Method({"GET"})
  // */
  // public function show(Article $article)
  // {
  //   return $this->render('articles/show.html.twig', ['article' => $article]);
  // }

  // a tutaj z jawnym użyciem ParamConverter'a
  /**
  * @Route("/article/{articleID<\d+>}", name="article_show")
  * @Method({"GET"})
  * @ParamConverter("article", options={"mapping"={"articleID"="id"}})
  */
  public function show(Article $article)
  {
    return $this->render('articles/show.html.twig', ['article' => $article]);
  }

  /**
  * @Route("/article/delete/{id}", name="delete_article")
  * @Method({"DELETE"})
  */
  public function delete(Request $request, Article $article)
  {
    // $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($article);
    $entityManager->flush();

    // $response = new Response();
    // $response->send();
    return $this->redirectToRoute('article_list');
  }

  // /**
  //  * @Route("/articles/save")
  //  */
  //  public function save() {
  //    $entityManager = $this->getDoctrine()->getManager();
  //
  //    $article = new Article();
  //
  //    $article
  //     ->setTitle('Article 999')
  //     ->setBody('This is the body for article 999');
  //    // $article->setTitle('Article 6');
  //    // $article->setBody('This is the body for article six');
  //
  //    $entityManager->persist($article);
  //
  //    $entityManager->flush();
  //
  //    return new Response('Saved an article with the id of '.$article->getId());
  //  }
}

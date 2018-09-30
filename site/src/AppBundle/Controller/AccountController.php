<?php

namespace App\Controller;
namespace AppBundle\Controller\AccountController;

use App\Entity\Account;
use App\Form\AccountCreateType;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{

    public function create(EntityManagerInterface $em, Request $request)
    {
        $account = new Account();

        $form = $this->createForm(AccountCreateType::class, $account);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $account = $form->getData();

            $em->persist($account);

            $em->flush();

            return $this->redirectToRoute('list_accounts');
        }

        return $this->render("account/create.html.twig", [
            'form' => $form->createView()
        ]);
    }

    public function modify(Account $account, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(AccountCreateType::class, $account);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $account = $form->getData();

            $em->flush();

            return $this->redirectToRoute('list_accounts');
        }

        return $this->render("account/modify.html.twig", [
            'form' => $form->createView()
        ]);
    }

    public function list(AccountRepository $repo)
    {
        $accounts = $repo->findAll();

        return $this->render("account/list.html.twig", [
            'accounts' => $accounts
        ]);
    }
    
    public function displayTransactions(Account $account, AccountRepository $repo)
    {
        return $this->render("account/displayTransactions.html.twig", [
            'account' => $account
        ]);
    }

    public function delete(Account $account, EntityManagerInterface $em)
    {
        $em->remove($account);
        $em->flush();
        return $this->redirectToRoute('list_accounts');
    }
}
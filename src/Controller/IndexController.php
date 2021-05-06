<?php
namespace App\Controller;


use App\Entity\Marque;
use App\Form\MarqueType;
use App\Entity\PriceSearch;
use App\Entity\MarqueSearch;
use App\Form\PriceSearchType;
use App\Entity\Electromenager;
use App\Entity\PropertySearch;
use App\Form\MarqueSearchType;
use App\Form\ElectromenagerType;
use App\Form\PropertySearchType;
use App\Repository\ElectromenagerRepository;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
/**
 *@Route("/",name="electro_list")
 */
public function home(Request $request)
{
$propertySearch = new PropertySearch();
$form = $this->createForm(PropertySearchType::class,$propertySearch);
$form->handleRequest($request);
$electros= [];

if($form->isSubmitted() && $form->isValid()) {
//on récupère le nom d'article tapé dans le formulaire
$nom = $propertySearch->getNom();
if ($nom!="")
//si on a fourni un nom d'article on affiche tous les articles ayant ce n
$electros= $this->getDoctrine()->getRepository(Electromenager::class)->findBy(['nom' => $nom] );
else
//si si aucun nom n'est fourni on affiche tous les articles
$electros= $this->getDoctrine()->getRepository(Electromenager::class)->findAll();
}
return $this->render('electros/index.html.twig',[ 'form' =>$form->createView(), 'electros' => $electros]);
}
/**
 * @Route("/electro/save")
 */
public function save() {
    $entityManager = $this->getDoctrine()->getManager();
    $electro = new Electromenager();
    $electro->setNom('Refregirateur');
    $electro->setPrix(1450);
   
    $entityManager->persist($electro);
    $entityManager->flush();
    return new Response('Electromrnager enregisté avec id '.$electro->getId());
    }
/**
 *@IsGranted("ROLE_EDITOR")
 * @Route("/electro/new", name="new_electro")
 * Method({"GET", "POST"})
 */
public function new(Request $request) {
    $electro = new Electromenager();
    $form = $this->createForm(ElectromenagerType::class,$electro);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    $electro = $form->getData();
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($electro);
    $entityManager->flush();
    return $this->redirectToRoute('electro_list');
    }
    return $this->render('electros/new.html.twig',['form' => $form->createView()]);
    }
/**
 * @Route("/electro/{id}", name="electro_show")
 */
 public function show($id) {
    $electro = $this->getDoctrine()->getRepository(Electromenager::class)
    ->find($id);
    return $this->render('electros/show.html.twig',array('electro' => $electro));
     }
/**
 * @IsGranted("ROLE_EDITOR")
 * @Route("/electro/edit/{id}", name="edit_electro")
 * Method({"GET", "POST"})
 */
public function edit(Request$request,$id)
{
$electro=new Electromenager();
$electro=$this->getDoctrine()->getRepository(Electromenager::class)
->find($id);
$form = $this->createForm(ElectromenagerType::class,$electro);

 $form->handleRequest($request);
 if($form->isSubmitted() && $form->isValid()) {

 $entityManager = $this->getDoctrine()->getManager();
 $entityManager->flush();

 return $this->redirectToRoute('electro_list');
 }

return$this->render('electros/edit.html.twig',['form'=>$form->createView()]);

}
/**
 * @IsGranted("ROLE_EDITOR")
 * @Route("/electro/delete/{id}",name="delete_electro")
 * @Method({"DELETE"})
 */
public function delete(Request $request, $id) {
    $electro = $this->getDoctrine()->getRepository(Electromenager::class)->find($id);
   
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($electro);
    $entityManager->flush();
   
    $response = new Response();
    $response->send();
    return $this->redirectToRoute('electro_list');
 }
/**
 * @Route("/marque/newM", name="new_marque")
 * Method({"GET", "POST"})
 */
public function newCategory(Request $request) {
    $marque = new Marque();
    $form = $this->createForm(MarqueType::class,$marque);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    $electro = $form->getData();
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($marque);
    $entityManager->flush();
    }
   return $this->render('electros/newMarque.html.twig',['form'=>
   $form->createView()]);
    }

/**
 * @Route("/electro_marq/", name="electro_par_marq")
 * Method({"GET", "POST"})
 */
 public function electrosParMarque(Request $request) {
    $MarqueSearch = new MarqueSearch();
    $form = $this->createForm(MarqueSearchType::class,$MarqueSearch);
    $form->handleRequest($request);
    $electros= [];
    if($form->isSubmitted() && $form->isValid()) {
        $marque = $MarqueSearch->getMarque();
       
        if ($marque!="")
       $electros= $marque->getElectros();
        else
        $electros= $this->getDoctrine()->getRepository(Electromenager::class)->findAll();
        }
       
        return $this->render('electros/electrosParMarque.html.twig',['form' => $form->createView(),'electros' => $electros]);

    }
    /**
 * @Route("/electro_prix/", name="electro_par_prix")
 * Method({"GET"})
 */
 public function electosParPrix(Request $request)
 {

 $priceSearch = new PriceSearch();
 $form = $this->createForm(PriceSearchType::class,$priceSearch);
 $form->handleRequest($request);
 $electros= [];
 if($form->isSubmitted() && $form->isValid()) {
 $minPrice = $priceSearch->getMinPrice();
 $maxPrice = $priceSearch->getMaxPrice();

 $electros= $this->getDoctrine()->getRepository(Electromenager::class)->findByPriceRange($minPrice,$maxPrice);
 }
 return $this->render('electros/electrosParPrix.html.twig',[ 'form' =>$form->createView(), 'electros' => $electros]);
 }

}                                                                                
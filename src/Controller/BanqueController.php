<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("admin/banque")
 */
class BanqueController extends Controller
{
    /**
     * @Route("/list", name="index_banque")
     * @Template()
     */
    public function index()
    {
        return [];
    }
}

<?php
namespace MapaComedoresSociales\FrontendBundle\Menu;

use Symfony\Component\HttpFoundation\Request;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class MenuBuilder extends AbstractNavbarMenuBuilder
{
    public function createMainMenu(Request $request)
    {
        $menu = $this->createNavbarMenuItem();
        $menu->addChild('Inicio', array('route' => '_welcome'));
        $menu->addChild('Login', array('route' => 'user_login'));
        $menu->addChild('Registro', array('route' => 'user_register'));

        return $menu;
    }

    public function createRightSideDropdownMenu(Request $request, ActiveTheme $activeTheme)
    {
    }

    public function createNavbarsSubnavMenu(Request $request)
    {
    }

    public function createComponentsSubnavMenu(Request $request)
    {
    }
}
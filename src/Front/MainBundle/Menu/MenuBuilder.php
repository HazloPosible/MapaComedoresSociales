<?php
namespace Front\MainBundle\Menu;

use Symfony\Component\HttpFoundation\Request;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class MenuBuilder extends AbstractNavbarMenuBuilder
{
    public function createMainMenu(Request $request)
    {
        $menu = $this->createNavbarMenuItem();
        $menu->addChild('Inicio', array('route' => '_welcome'));

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
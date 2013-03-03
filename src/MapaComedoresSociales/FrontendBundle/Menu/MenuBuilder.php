<?php
namespace MapaComedoresSociales\FrontendBundle\Menu;

use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpFoundation\Request;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class MenuBuilder extends AbstractNavbarMenuBuilder
{
    public function setSecurityContext(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->createNavbarMenuItem();
        if ($this->securityContext->isGranted('ROLE_USER')) {
            
            $menu->addChild('Añade un comedor', array('route' => 'pantry_new'));
            $menu->addChild('Salir', array('route' => 'user_logout'));

        } else {
            $menu->addChild('Login', array('route' => 'user_login'));
            $menu->addChild('Registro', array('route' => 'user_register'));    
        }
        
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
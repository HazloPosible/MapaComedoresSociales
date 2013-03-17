<?php 

namespace MapaComedoresSociales\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use MapaComedoresSociales\UserBundle\Entity\User;

class LoadUser implements FixtureInterface, ContainerAwareInterface	
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

	/**
     * {@inheritDoc}
     */
	public function load(ObjectManager $manager)
	{
        for ($i=1; $i<=300; $i++) 
        {
            $user = new User();

            // Personal information
            $user->setName($this->getDummyNames());
            $user->setLastname($this->getDummyLastnames());
            $user->setEmail('user'.$i.'@localhost');

            // 60% users actives
            $user->setActive((rand(1, 1000) % 10) < 6);
            // 60% users enables
            $user->setEnable((rand(1, 1000) % 10) < 6);

            // Password generation
            /** @var $userManager MapaComedoresSociales\UserBundle\Model\UserManager */
            $userManager = $this->get('user_manager');
            $user->setPlainPassword('user'.$i);
            $userManager->updatePassword($user);

            // Auditory dates
            $user->setCreatedAt(new \DateTime('now - '.rand(1, 150).' days'));

            $manager->persist($user);
        }

        $manager->flush();
	}

	/**
     * Generator of dummy Names
     *
     * @return string with ramdon names
     */
    private function getDummyNames()
    {
        $men = array(
            'Antonio', 'José', 'Manuel', 'Francisco', 'Juan', 'David',
            'José Antonio', 'José Luis', 'Jesús', 'Javier', 'Francisco Javier',
            'Carlos', 'Daniel', 'Miguel', 'Rafael', 'Pedro', 'José Manuel',
            'Ángel', 'Alejandro', 'Miguel Ángel', 'José María', 'Fernando',
            'Luis', 'Sergio', 'Pablo', 'Jorge', 'Alberto'
        );
        $women = array(
            'María Carmen', 'María', 'Carmen', 'Josefa', 'Isabel', 'Ana María',
            'María Dolores', 'María Pilar', 'María Teresa', 'Ana', 'Francisca',
            'Laura', 'Antonia', 'Dolores', 'María Angeles', 'Cristina', 'Marta',
            'María José', 'María Isabel', 'Pilar', 'María Luisa', 'Concepción',
            'Lucía', 'Mercedes', 'Manuela', 'Elena', 'Rosa María'
        );

        if (rand() % 2) {
            return $men[array_rand($men)];
        } else {
            return $women[array_rand($women)];
        }
    }

    /**
     * Generator of dummy lastnames
     *
     * @return string with a lastnames
     */
    private function getDummyLastnames()
    {
        $lastnames = array(
            'García', 'González', 'Rodríguez', 'Fernández', 'López', 'Martínez',
            'Sánchez', 'Pérez', 'Gómez', 'Martín', 'Jiménez', 'Ruiz',
            'Hernández', 'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero',
            'Alonso', 'Gutiérrez', 'Navarro', 'Torres', 'Domínguez', 'Vázquez',
            'Ramos', 'Gil', 'Ramírez', 'Serrano', 'Blanco', 'Suárez', 'Molina',
            'Morales', 'Ortega', 'Delgado', 'Castro', 'Ortíz', 'Rubio', 'Marín',
            'Sanz', 'Iglesias', 'Nuñez', 'Medina', 'Garrido'
        );

        return $lastnames[array_rand($lastnames)].' '.$lastnames[array_rand($lastnames)];
    }

}
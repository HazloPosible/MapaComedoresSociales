<?php 

namespace MapaComedoresSociales\PantryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use MapaComedoresSociales\PantryBundle\Entity\Pantry;
use MapaComedoresSociales\UserBundle\Entity\User;

class LoadPantry implements FixtureInterface, ContainerAwareInterface  
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

        $latitude = 41.386623;
        $longitude = 2.16934;

        $em = $this->container->get('doctrine.orm.entity_manager');

        for ($i=1; $i<=20; $i++)
        {
            $pantry = new Pantry();
            $user = $em->getReference('MapaComedoresSociales\UserBundle\Entity\User', rand(1, 100));
            $type = $em->getReference('MapaComedoresSociales\PantryBundle\Entity\Type', rand(1, 2));

            $pantry->setName($this->getDummyNames());
            $pantry->setAddress('Direccion Calle'.$i);
            $pantry->setEmail('user'.$i.'@localhost');
            $pantry->setDescription('Comedor muy útil'.$i);
            $pantry->setEnabled(true);
            $pantry->setLatitude($latitude + (rand(0,10) / rand(10000, 10100) ));
            $pantry->setLongitude($longitude + (rand(0,10) / rand(10000, 10100) ));

            $pantry->setUser($user);
            $pantry->setZip(rand(3000, 4000));
            $pantry->setType($type);

            // Auditory dates
            $pantry->setCreatedAt(new \DateTime('now - '.rand(1, 150).' days'));

            $manager->persist($pantry);
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
        $names = [];

        for ($i=1; $i<=1000; $i++) {
            array_push($names, 'Comedor '. $i);
        }

        return array_rand($names);
    }

}
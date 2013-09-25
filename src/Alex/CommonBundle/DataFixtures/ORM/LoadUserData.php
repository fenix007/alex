<?php
namespace Alex\CommonBundle\DataFixtures\ORM;

use Alex\CommonBundle\Entity\user;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LoadUserData extends AbstractFixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $file= fopen('users.txt', 'a+');
        $faker = Factory::create();
        for ($i = 0; $i < 10; ++$i) {
            $user = new user();
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setBirthday($faker->dateTimeThisCentury);
            $user->setUsername($faker->name);
            $user->setEmail($faker->email);
            $user->setPhone1($faker->phoneNumber);
            $user->setPlainPassword($faker->word);
            $user->setLocked(false);
            $user->setEnabled(true);
            $user->setExpired(true);
            $manager->persist($user);
            fwrite($file, $faker->name . ': ' . $faker->word . Chr(13));
        }
        fclose($file);
        $manager->flush();
    }
}
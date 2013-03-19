<?php
namespace EarlShort\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EarlShort\MainBundle\Entity\Link;
use DateTime;

class LoadLinkData implements FixtureInterface
{
/**
* {@inheritDoc}
*/
    public function load(ObjectManager $manager)
    {
        $link = new Link();
        $link->setPath('1234');
        $link->setDestination('5678');
        $link->setCreated(new DateTime());
        $link->setUpdated(new DateTime());
        $link->setVisitCount(5);

        $link2 = new Link();
        $link2->setPath('abcd');
        $link2->setDestination('efgh');
        $link2->setCreated(new DateTime());
        $link2->setUpdated(new DateTime());
        $link2->setVisitCount(2);

        $manager->persist($link);
        $manager->persist($link2);
        $manager->flush();
    }
}
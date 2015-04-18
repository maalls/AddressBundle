<?php

namespace OMedia\LeadsBundle\Tests\Entity;

//use OMedia\LeadsBundle\Lib\Submission;
use Maalls\AddressBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AddressTest extends KernelTestCase
{


    public function testDistance() {

        $address1 = new Address();
        $address2 = new Address();
        $address1->setLatLng(45.483526, -73.614718);
        $address2->setLatLng(45.599909, -73.780886);
        $distance = $address1->getDistance($address2);

        $this->assertEquals(18, round($distance));

    }

}


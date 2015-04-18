<?php

namespace Maalls\AddressBundle\Entity;

class Address {

    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $address_line1 = "";

    /**
     * @var string
     */
    private $address_line2 = "";

    /**
     * @var string
     */
    private $country = "";

    /**
     * @var string
     */
    private $city = "";

    /**
     * @var string
     */
    private $zip_code = "";

    /**
     * @var string
     */
    private $province = "";



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id) {

        $this->id = $id;

    }

    /**
     * Set address_line1
     *
     * @param string $addressLine1
     * @return Address
     */
    public function setAddressLine1($addressLine1)
    {
        $this->address_line1 = $addressLine1 ? $addressLine1 : '';

        return $this;
    }

    /**
     * Get address_line1
     *
     * @return string 
     */
    public function getAddressLine1()
    {
        return $this->address_line1;
    }

    /**
     * Set address_line2
     *
     * @param string $addressLine2
     * @return Address
     */
    public function setAddressLine2($addressLine2)
    {
        $this->address_line2 = $addressLine2 ? $addressLine2 : '';

        return $this;
    }

    /**
     * Get address_line2
     *
     * @return string 
     */
    public function getAddressLine2()
    {
        return $this->address_line2;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country ? $country : "";

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city ? $city : "";

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zip_code
     *
     * @param string $zipCode
     * @return Address
     */
    public function setZipCode($zipCode)
    {
        $this->zip_code = $zipCode ? mb_substr($zipCode, 0, 16, "utf8") : "";

        return $this;
    }

    /**
     * Get zip_code
     *
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }



    /**
     * Set province
     *
     * @param string $province
     * @return Address
     */
    public function setProvince($province)
    {
        $this->province = $province ? $province : "";

        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    public function __toString() {

        return $this->getAddressLine1() . " " . $this->getAddressLine2() . ", " . $this->getZipcode() . " " . $this->getCity() . ", " . $this->getCountry();

    }
    /**
     * @var string
     */
    private $lat = 0;

    /**
     * @var string
     */
    private $lng = 0;


    /**
     * Set lat
     *
     * @param string $lat
     * @return Address
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    public function setLatLng($lat, $lng) 
    {

        $this->setLat($lat);
        $this->setLng($lng);

    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     * @return Address
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string 
     */
    public function getLng()
    {
        return $this->lng;
    }

    public function getDistance($address, $unit = "km") 
    {

        $miles = 3959;
        $km = 6371;

        $factor = $unit == "km" ? $km : $miles;

        $lat1 = $address->getLat();
        $lng1 = $address->getLng();

        $lat2 = $this->getLat();
        $lng2 = $this->getLng();

        $distance = $factor * acos(cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lng2) - deg2rad($lng1)) + sin(deg2rad($lat1)) * sin(deg2rad( $lat2)));

        return $distance; 

    }

}

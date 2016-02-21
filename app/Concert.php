<?php

namespace App;

class Concert
{
    protected $id;
    protected $name;
    protected $startDate;
    protected $address;
    protected $city;
    protected $country;
    protected $location;
    protected $description;
    protected $url;
    protected $owner;
    protected $users;

    public function __construct($data) {
        if(array_key_exists('_source',$data)) {
            $this->id = $data['_id'];
            $data = $data['_source'];
        } else if(array_key_exists('id',$data)) {
            $this->id = $data['id'];
        }

        $this->name = $data['name'];
        $this->startDate = (array_key_exists('start_date', $data)) ? $data['start_date'] : $data['startDate'];
        $this->address = $data['address'];
        $this->city = $data['city'];
        $this->country = $data['country'];
        $this->location = $this->safeGet('location',$data);
        $this->description = $data['description'];
        $this->url = $this->safeGet('url',$data);
        $this->owner = $this->safeGet('owner',$data);
        $this->users = $this->safeGet('users',$data);
    }

    /**
     * Check before return optional parameters that might not be in the data array
     * @param  string $name
     * @param  array $array
     * @return mixed
     */
    private function safeGet($name,$array) {
        if(array_key_exists($name,$array)) {
            return $array[$name];
        } else {
            return NULL;
        }
    }

    public function hasId() {
        return ($this->id);
    }

    public function getId()          { return $this->id; }
    public function getName()        { return $this->name; }
    public function getStartDate()   { return $this->startDate; }
    public function getAddress()     { return $this->address; }
    public function getCity()        { return $this->city; }
    public function getCountry()     { return $this->country; }
    public function getLocation()    { return $this->location; }
    public function getDescription() { return $this->description; }
    public function getUrl()         { return $this->url; }
    public function getOwner()       { return $this->owner; }
    public function getUsers()       { return $this->users; }

    public function getDocument() {
        return [
            'name' => $this->name,
            'start_date' => $this->startDate,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'location' => $this->location,
            'description' => $this->description,
            'url' => $this->url,
            'owner' => $this->owner];
    }

    public function setLocation($latitude, $longitude) {
        $this->location = ['lat' => $latitude, 'lon' => $longitude];
    }

    public function hasLocation() {
        return ($this->location && array_key_exists('lat', $this->location) && array_key_exists('lon', $this->location));
    }

    public function getFormValue($name) {
        $funcname = 'get'.ucfirst($name);
        if(method_exists($this, $funcname)){
            return $this->$funcname();
        }
    }
}
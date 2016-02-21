<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable {

    protected $id;
    protected $systemUser;
    protected $name;
    protected $facebookUid;
    protected $lastOnline;
    protected $email;

    public function __construct($data) {
        if(is_array($data)) {
            $this->id = $data['_id'];
            $source = $data['_source'];
            $this->systemUser = $source['system_user'];
            $this->name = $source['name'];
            $this->facebookUid = array_key_exists('fb_uid', $source) ? $source['fb_uid'] : NULL;
            $this->lastOnline = array_key_exists('last_online', $source) ? $source['last_online'] : NULL;
            $this->email = array_key_exists('email', $source) ? $source['email'] : NULL;
        } else {
            // facebook data
            $this->systemUser = FALSE;
            $this->name = $data->name;//$data['name'];
            $this->facebookUid = $data->id;//$data['id'];
            $this->email = $data->email;
        }
    }

    public function hasId() {
        return ($this->id);
    }

    public function getId() {
        return $this->id;
    }

    public function update($id, $lastOnline) {
        $this->id = $id;
        $this->lastOnline = $lastOnline;
    }

    public function isSystemUser() {
        return $this->systemUser;
    }

    public function getName() {
        return $this->name;
    }

    public function getFacebookUid() {
        return $this->facebookUid;
    }

    public function getLastOnline() {
        return $this->lastOnline;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAvatar() {
        if($this->isSystemUser()) {
            return '/images/default.jpg';
        } else {
            return 'https://graph.facebook.com/v2.5/'.$this->facebookUid.'/picture?type=normal';
        }
    }

    public function getDocument() {
        return [
            'system_user' => $this->systemUser,
            'name' => $this->name,
            'fb_uid' => $this->facebookUid,
            'email' => $this->email
        ];
    }

    public function getData() {
        return [
            'name' => $this->name,
            'fb_uid' => $this->facebookUid,
        ];
    }


    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'facebookUid';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->facebookUid;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return 'not implemented';
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return 'do no use this';
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        return;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'oops_this_should_not_be_here';
    }
}

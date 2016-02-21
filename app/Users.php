<?php

namespace App;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;
use App\User;
use Carbon\Carbon;

class Users implements UserProvider
{
	/**
     * Client to communicate with elasticSearch
     * @var Client
     */
    protected $elasticClient;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->elasticClient = ClientBuilder::create()->build();
    }

    public function findByFacebookUid($facebookUid) {
        $result = $this->elasticClient->search([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_USER,
            'body' => [
                'size' => 1,
                'query' => ['match' => ['fb_uid' => $facebookUid]]
            ]
        ]);
        if($result['hits']['total'] > 0) {
            return new User($result['hits']['hits'][0]);
        } else {
            return NULL;
        }
    }

    /**
     * Save user data to elastic, does an update or create
     * @param  User $user User object from login
     * @return array
     */
    public function save(User $user) {
        $params = [
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_USER,
        ];
        $oldUser = $this->findByFacebookUid($user->getFacebookUid());
        $lastOnline = Carbon::now()->toIso8601String();
        $id = NULL;
        if($oldUser) {
            $params['id'] = $id = $oldUser->getId();
            $params['body']['doc'] = $user->getDocument();
            $params['body']['doc']['last_online'] = $lastOnline;
            $this->elasticClient->update($params);
        } else {
            $params['body'] = $user->getDocument();
            $params['body']['last_online'] = $lastOnline;
            $id = $this->elasticClient->index($params)['_id'];
        }
        $user->update($id, $lastOnline);
        return $user;
    }


    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  string $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier) {
        return $this->findByFacebookUid($identifier);
    }

    public function retrieveByToken($identifier, $token) { return NULL; }

    public function updateRememberToken(Authenticatable $user, $token) { return; }

    public function retrieveByCredentials(array $credentials) { return NULL; }

    public function validateCredentials(Authenticatable $user, array $credentials) { return false; }
}

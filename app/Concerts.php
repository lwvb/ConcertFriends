<?php

namespace App;

use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;

class Concerts
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

    public function add($body) {
		return $this->elasticClient->index([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_CONCERT,
            'body' => $body
        ]);
    }

    public function update($id, $body) {
        return $this->elasticClient->update([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_CONCERT,
            'id' => $id,
            'body' => $body
        ]);
    }

    public function all($offset = 0, $limit = 20) {
    	return $this->elasticClient->search([
    		'index' => ElasticNames::INDEX_NAME,
    		'type' => ElasticNames::TYPE_CONCERT,
    		'body' => [
    			'from' => $offset,
    			'size' => $limit,
    			'query' => ['match_all' => []]
    		]
    	]);
    }

    public function get($id) {
        return $this->elasticClient->get([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_CONCERT,
            'id' => $id
        ]);
    }

}

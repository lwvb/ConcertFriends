<?php

namespace App;

use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;
use App\Concert;

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

    public function save($concert) {
        $params = [
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_CONCERT,
        ];
        if($concert->hasId()) {
            $params['id'] = $concert->getId();
            $params['body']['doc'] = $concert->getDocument();
            return $this->elasticClient->update($params);
        } else {
            $params['body'] = $concert->getDocument();
            return $this->elasticClient->index($params);
        }
    }

    public function all($offset = 0, $limit = 20) {
    	$results = $this->elasticClient->search([
    		'index' => ElasticNames::INDEX_NAME,
    		'type' => ElasticNames::TYPE_CONCERT,
    		'body' => [
    			'from' => $offset,
    			'size' => $limit,
    			'query' => ['match_all' => []]
    		]
    	]);
        $concerts = [];
        foreach ($results['hits']['hits'] as $concertData) {
            $concerts[] = new Concert($concertData);
        }
        return ['total'=> $results['hits']['total'], 'concerts' => $concerts];
    }

    public function get($id) {
        $result = $this->elasticClient->get([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_CONCERT,
            'id' => $id
        ]);
        return new Concert($result);
    }

}

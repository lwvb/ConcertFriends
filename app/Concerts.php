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
            $params['version'] = $concert->getVersion();
            $params['body']['doc'] = $concert->getDocument();
            return $this->elasticClient->update($params);
        } else {
            $params['body'] = $concert->getDocument();
            return $this->elasticClient->index($params);
        }
    }

    public function all($offset = 0, $limit = 200) {
        $results = $this->elasticClient->search([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_CONCERT,
            'body' => [
                'from' => $offset,
                'size' => $limit,
                'query' => [
                    'filtered' => [
                        'query' =>['match_all' => []],
                        'filter' => $this->filters()
                    ]
                ]
            ]
        ]);
        $concerts = [];
        foreach ($results['hits']['hits'] as $concertData) {
            $concerts[] = new Concert($concertData);
        }
        return ['total'=> $results['hits']['total'], 'concerts' => $concerts];
    }

    public function search($search, $offset = 0, $limit = 20) {
        $results = $this->elasticClient->search([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_CONCERT,
            'body' => [
                'from' => $offset,
                'size' => $limit,
                'query' => [
                    'filtered' => [
                        'query' => [
                            'bool' => [
                                'minimum_should_match' => 1,
                                'should' => [
                                    ['match' => [
                                        'name' => [
                                            'query' => $search,
                                            'boost' => 1.8
                                        ],
                                    ]],
                                    ['match' => [
                                        'city' => [
                                            'query' => $search,
                                            'boost' => 1.6
                                        ],
                                    ]],
                                    ['match' => [
                                        'description' => [
                                            'query' => $search,
                                            'boost' => 1.2
                                        ]
                                    ]],
                                    ['fuzzy' => [
                                        'name' => [
                                            'value' => $search,
                                            'fuzziness' => 'AUTO',
                                            'boost' => 1.1
                                        ],
                                    ]],
                                    ['fuzzy' => [
                                        'city' => [
                                            'value' => $search,
                                            'fuzziness' => 'AUTO',
                                        ]
                                    ]],
                                    ['fuzzy' => [
                                        'description' => [
                                            'value' => $search,
                                            'fuzziness' => 'AUTO',
                                        ],
                                    ]],
                                ]
                            ]
                        ],
                        'filter' => $this->filters()
                    ]
                ]

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

    private function filters() {
        return [
            'range' => ['start_date' => ['gte' => 'now/d']]
        ];
    }

}

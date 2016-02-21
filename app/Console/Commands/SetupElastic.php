<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;
use App\ElasticNames;

class SetupElastic extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:elastic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates elastic indexes';

    /**
     * Client to communicate with elasticSearch
     * @var Client
     */
    protected $elasticClient;

    protected $indexParams = [
        'index' => ElasticNames::INDEX_NAME,
        'body' => [
            'mappings' => [
                ElasticNames::TYPE_CONCERT => [
                    '_source' => ['enabled' => true],
                    'properties' => [
                        'name' => ['type' => 'string'],
                        'start_date' => ['type' => 'date', 'format' => 'date_time_no_millis'],
                        'address' => ['type' => 'string'],
                        'city' => ['type' => 'string'],
                        'country' => ['type' => 'string'],
                        'location' => ['type' => 'geo_point'],
                        'description' => ['type' => 'string'],
                        'owner' => ['type' => 'string', 'index' => 'not_analyzed'],
                        'users' => ['type' => 'object', 'enabled' => 'false']
                    ]
                ],
                ElasticNames::TYPE_USER => [
                    '_source' => ['enabled' => true],
                    'properties' => [
                        'system_user' => ['type' => 'boolean'],
                        'name' => ['type' => 'string'],
                        'fb_uid' => ['type' => 'string',
                        'last_online' => ['type' => 'date', 'format' => 'date_time_no_millis'],
                        'email' => ['type' => 'string', 'index' => 'not_analyzed']]
                    ]
                ]
            ]
        ]
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->elasticClient = ClientBuilder::create()->build();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Creating Elasticsearch indexes');
        if($this->elasticClient->indices()->exists(['index' => ElasticNames::INDEX_NAME])) {
            if($this->confirm('Recreate elasticsearch index '. ElasticNames::INDEX_NAME .'? [y|N]')) {
                $this->elasticClient->indices()->delete(['index' => ElasticNames::INDEX_NAME]);
            } else {
                $this->warn('Keeping the old elasticsearch index, mapping might be outdated');
                return;
            }
        }
        $this->elasticClient->indices()->create($this->indexParams);
        $this->info('Elasticsearch setup complete.');
    }
}

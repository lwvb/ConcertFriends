<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;
use App\ElasticNames;
use App\Concerts;
use App\Concert;
use Carbon\Carbon;

class SetupDummydata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dummydata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert some dummy data into elastic';

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
        $this->info('Inserting dummydata into elasticsearch');
        $systemUserId = $this->elasticClient->index([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_USER,
            'body' => ['name' => 'Automatic', 'system_user' => true]
        ])['_id'];
        $this->info('Created a new system user with id '.$systemUserId);

        $this->elasticClient->index([
            'index' => ElasticNames::INDEX_NAME,
            'type' => ElasticNames::TYPE_USER,
            'body' => ['name' => 'Test gebruiker', 'system_user' => true, 'fb_uid' => '12345']
        ]);

        $concerts = new Concerts();
        $concerts->save(new Concert([
            'name' => 'Bruce Springsteen & The E Street Band',
            'start_date' => Carbon::create(2016, 06, 14, 20, 0, 0, 'Europe/Amsterdam')->toIso8601String(),
            'address' => 'Malieveld',
            'city' => 'Den Haag',
            'country' => 'The Netherlands',
            'location' => ['lat' => 52.0857695, 'lon' => 4.318614],
            'description' => 'Een echte verhalenverteller met een heerlijke rauwe stem en een ongekende energie. The Boss komt terug! Wat de setlist van de show in Den Haag zal zijn blijft nog even een verrassing, maar dat het massaal meeschreeuwen wordt dat weten we wel zeker!',
            'url' => 'http://www.mojo.nl/concerten/bruce-springsteen/',
            'owner' => $systemUserId]));

        $concerts->save(new Concert([
            'name' => 'K3',
            'start_date' => Carbon::create(2016, 02, 20, 17, 0, 0, 'Europe/Amsterdam')->toIso8601String(),
            'address' => 'Lardinoisstraat 8',
            'city' => 'Eindhoven',
            'country' => 'The Netherlands',
            'location' => ['lat' => 51.4432334, 'lon' => 5.4741154],
            'description' => 'Afscheidsconcert Karen, Kristel en Josje',
            'url' => 'http://tickets.studio100.nl/show/k3-k3-show-de-afscheidstour-van-karen-kristel-en-josje-nederland',
            'owner' => $systemUserId]));

        $concerts->save(new Concert([
            'name' => 'GRATIS LUNCHCONCERT',
            'start_date' => Carbon::create(2016, 02, 26, 12, 30, 0, 'Europe/Amsterdam')->toIso8601String(),
            'address' => 'Concertgebouwplein 10',
            'city' => 'Amsterdam',
            'country' => 'The Netherlands',
            'location' => ['lat' => 52.356319, 'lon' => 4.8769572],
            'description' => 'MUSICI
Rubens Kwartet
Mayu Konoe - viool
Takehiro Konoe - altviool

PROGRAMMA

Dvořák - Derde strijkkwintet in Es, op. 97, B 180',
            'url' => 'http://www.concertgebouw.nl/concerten/gratis-lunchconcert/26-02-2016',
            'owner' => $systemUserId]));

        $this->elasticClient->indices()->flush(['index' => ElasticNames::INDEX_NAME]);
    }

}

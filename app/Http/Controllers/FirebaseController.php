<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    //

    public function index(){    			
    	$database = $this->getDbRef();

		$reference = $database->getReference('products');

		echo "<pre>";
		print_r($reference->getValue()); // Fetches the data from the realtime database);
		echo "<br/>";
		exit;
	}

	// this will set all nocdes on bulk when database is in intial stage like dumping data
	public function setNodes(){	
		$database = $this->getDbRef();

		$reference = $database->getReference('products');
		
		// add nodes initial
		$reference = $reference->set([
			'sku-1' => [
		    	'name' => 'bottol',
		    	'price' => '20'   
		    ],
		    'sku-2' => [
		    	'name' => 'cup',   
		    	'price' => '30'
		    ]
		]);

		echo "<pre>";
		print_r($reference->getValue()); // Fetches the data from the realtime database);
		echo "<br/>";
		exit;
	}


	// push node when data already exists
	public function pushNode(){	
		$database = $this->getDbRef();

		// push nodes on already added 
		$postData = [
		    'name' => 'tea cup',   
		    'price' => '40'
		];

		// Create a key for a new post
		$newPostKey = $database->getReference('products')->push()->getKey();

		$updates = [
		    'products/sku-3' => $postData		  
		];

		$reference = $database->getReference() // this is the root reference
		   ->update($updates);

		echo "<pre>";
		print_r($reference->getValue()); // Fetches the data from the realtime database);
		echo "<br/>";
		exit;		
	}

	// set values on specific nodes
	public function updateNodeValue(){	
		$database = $this->getDbRef();

		$reference = $database
		        ->getReference('products/sku-1/price')            
		        ->set('35');
		        
		echo "<pre>";
		print_r($reference->getValue()); // Fetches the data from the realtime database);
		echo "<br/>";
		exit;	
	}

	// set values on specific nodes
	public function removeNode(){	
		$database = $this->getDbRef();

		$reference = $database->getReference('products/sku-1')->remove();

		echo "<pre>";
		print_r($reference->getValue()); // Fetches the data from the realtime database);
		echo "<br/>";
		exit;	
    }


    // get database reference globally from function
    private function getDbRef(){
    	$factory = (new Factory)
			->withServiceAccount('../config/google-service-account.json')
			// The following line is optional if the project id in your credentials file
			// is identical to the subdomain of your Firebase project. If you need it,
			// make sure to replace the URL with the URL of your project.
			->withDatabaseUri('https://lara-fire-88775.firebaseio.com');

		$database = $factory->createDatabase();

		return $database;
    }
}

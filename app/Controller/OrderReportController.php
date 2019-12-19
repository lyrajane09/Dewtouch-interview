<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
			// debug($portions);exit;

			$order_reports = array();

			// To Do - write your own array in this format
			// $order_reports = array('Order 1' => array(
			// 							'Ingredient A' => 1,
			// 							'Ingredient B' => 12,
			// 							'Ingredient C' => 3,
			// 							'Ingredient G' => 5,
			// 							'Ingredient H' => 24,
			// 							'Ingredient J' => 22,
			// 							'Ingredient F' => 9,
			// 						),
			// 					  'Order 2' => array(
			// 					  		'Ingredient A' => 13,
			// 					  		'Ingredient B' => 2,
			// 					  		'Ingredient G' => 14,
			// 					  		'Ingredient I' => 2,
			// 					  		'Ingredient D' => 6,
			// 					  	),
			// 					);

			// ...

			if($orders){
				foreach($orders as $or){

					$content = array();
					foreach($or['OrderDetail'] as $key => $or2){
						$content[] = array(
							$or2['Item']['name'] => $or2['quantity']
						);
						//$content[$key] = array($or2['Item']['name'] => $or2['quantity']);
						// array_merge( $content, array_flatten( array($or2['Item']['name'] => $or2['quantity']) ) );
						
						
					}

					$order_reports[$or['Order']['name']] =  $this->array_flatten($content);


					
				}
			}


			$this->set('order_reports',$order_reports);

			$this->set('title',__('Orders Report'));
		}


		/**
		 * return flatten
		 */
		public function array_flatten($multiDimArray){
		    $flatten = [];

		    $singleArray = array_map(function($arr) use (&$flatten) {
		        $flatten = array_merge($flatten, $arr);
		    }, $multiDimArray);

		    return $flatten;
		}


		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
				
			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}
<?php
	class FormatController extends AppController{
		
		public function q1(){
			
			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
			
			if ($this->request->is('post')) {
				// var_dump($this->request->data['Type']['type']); exit;
				
				$this->redirect(array(
				    'controller' => 'format',
				    'action' => 'result',
				    'result' => $this->request->data['Type']['type'])
				);
			}
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_detail(){

			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
					
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}

		public function result(){
			$result = $this->request->params['named']['result'];
			$this->set('result', compact('result'));
		}
		
	}
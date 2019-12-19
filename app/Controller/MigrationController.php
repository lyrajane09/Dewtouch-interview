<?php
	App::import('Vendor', 'php-excel-reader/excel_reader2');

	class MigrationController extends AppController{
		
		public function q1(){
			$this->loadModel('Members');
			$this->loadModel('Transactions');
			$this->loadModel('TransactionItems');
			$this->setFlash('Question: Migration of data to multiple DB table');
			

			if($this->request->is('post')) {

				#delete all 3 tables
				$this->Members->deleteAll(array('Members.id !=' => NULL), false);
				$this->Transactions->deleteAll(array('Transactions.id !=' => NULL), false);
				$this->TransactionItems->deleteAll(array('TransactionItems.id !=' => NULL), false);
 	
				$data = new Spreadsheet_Excel_Reader('files/migration_sample_1.xls', true);	
				$temp = $data->dumptoarray();
				$row = 0;

				if(count($temp)){
					foreach($temp as $t){
						$memberNo = explode(" ", $t[4]);
						if($row != 0 && is_numeric(end($memberNo)) && $row < 220){
							$members =  array(
							        		'type' => $memberNo[0],
							        		'no'   => end($memberNo),
							        		'name' => $t[3],
							        		'company' => $t[6],
							        		'valid' => 1,
							        		'created' => date("Y-m-d H:i:s"),
						        		);

					        $this->Members->clear();
					        $this->Members->create(false);
					        $this->Members->save($members);
					        
					        $memberNew = $this->Members->id;
					        $transactions = array(
					        				'member_id' => $memberNew,
					        				'member_name' => $t[3],
					        				'member_paytype' => $t[5],
					        				'member_company' => $t[6],
					        				'date' => date("Y-m-d", strtotime($t[1])),
					        				'year' => date("Y", strtotime($t[1])),
					        				'month' => date("m", strtotime($t[1])),
					        				'ref_no' => $t[2],
					        				'receipt_no' => $t[9],
					        				'payment_method' => $t[7],
					        				'batch_no' => $t[8],
					        				'cheque_no' => $t[10],
					        				'payment_type' => $t[11],
					        				'renewal_year' => $t[12],
					        				'remarks' => null,
					        				'subtotal' => $t[13],
					        				'tax' => $t[14],
					        				'total' => $t[15],
					        				'valid' => 1,
					        				'created' => date("Y-m-d H:i:s"),
					        			);

					        $this->Transactions->clear();
					        $this->Transactions->create(false);
					        $this->Transactions->save($transactions);

					 		$transacNew = $this->Transactions->id;
					 		$transacItem = array(
					 						'transaction_id' => $transacNew,
					 						'description' => 'Being payment for: '.$t[11],
					 						'quantity'   => 1,
					 						'unit_price' => $t[13],
					 						'uom' => null,
					 						'sum' => 1 * $t[13],
					 						'valid' => 1,
					 						'created' => date('Y-m-d H:i:s'),
					 						'table' => 'Member',
					 						'table_id' => 1
					 					);

					 		$this->TransactionItems->clear();
					        $this->TransactionItems->create(false);
					        $this->TransactionItems->save($transacItem);

						}

						$row++;
					}
				}


            	$this->Session->setFlash(__('File has been successfully migrated'),'flash_metronic', array('class' => 'alert-success'));

			}
			
			$members = $this->Members->find('all');

			$this->set('members', $members);
			$this->set('q1');


		}


		public function q1_instruction(){

			$this->setFlash('Question: Migration of data to multiple DB table');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
	}
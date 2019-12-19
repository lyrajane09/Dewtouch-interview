<?php
	class RecordController extends AppController{
		
		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);
			
			$this->setFlash('Listing Record page too slow, try to optimize it.');
			$this->setFlash('This page loads fast now !!! It is display by datatable ajax');
			
			
			// $records = $this->Record->find('all');
			
			$this->set('records');
			
			
			$this->set('title',__('List Record'));
		}
		

		/**
		 * @return ajax
		 */
		public function ajax() { 
		    ## Read value
		    
			$draw = (int) $this->request->query['sEcho'];
			$row = (int) $this->request->query['iDisplayStart'];
			$rowperpage = (int) $this->request->query['iDisplayLength']; // Rows display per page
			$columnIndex = (int) $this->request->query['iColumns']; // Column index
			$columnName = ($this->request->query['iSortCol_0'] == 1) ? '.name' : '.id' ;  // Column name
			$columnSortOrder = $this->request->query['sSortDir_0']; // asc or desc
			$searchValue = $this->request->query['sSearch']; // Search value
			$data = array();

			#filter
			$filter = array('offset' => $row, 
							'limit' => $rowperpage, 
							'fields' => array('Record.id', 'Record.name'),
							'order'  => ($columnName != '') ? array('Record'.$columnName => $columnSortOrder) : '',
						);
			
			#search
			if($searchValue){
				$filter['conditions'] =  array("OR" => array(
												    "Record.id LIKE" => $searchValue,
												    "Record.name LIKE" => $searchValue
												));
			}

			$query = $this->Record->find('all', $filter);
			$totalRecords = $this->Record->find('count');
			
			if(count($query)) {
				foreach($query as $q){
					$data[] = array( 
				      $q['Record']['id'],
				      $q['Record']['name'],
				    );
				}
			}


			## Response
			$response = array(
			  "draw" => $draw,
			  "iTotalRecords" => count($query),
			  "iTotalDisplayRecords" => $totalRecords,
			  "aaData" => $data
			);

			echo json_encode($response); exit;
		}

		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}
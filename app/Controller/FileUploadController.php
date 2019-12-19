<?php

class FileUploadController extends AppController {

	public function initialize(){
        parent::initialize();
        
        // Include the FlashComponent
        $this->loadComponent('Flash');
   
    }


	public function index() {
		$this->set('title', __('File Upload Answer'));

		$file_uploads = $this->FileUpload->find('all');

		$uploadData = '';
        if ($this->request->is('post')) {
        	
            if(!empty($this->request->data['FileUpload']['file']['name'])){
            		
            	#file validation
            	if($this->request->data['FileUpload']['file']['type'] == 'application/vnd.ms-excel'){
            		$fileName = date('Ymdhis').$this->request->data['FileUpload']['file']['name'];
	                $uploadPath = 'uploads/files/';
	                $uploadFile = $uploadPath.$fileName;
	                if(move_uploaded_file($this->request->data['FileUpload']['file']['tmp_name'],$uploadFile)){

	                	$csvFile = fopen($uploadFile, 'r');
	                	$row = 1;
	                	
	                	while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE){
	                		$num = count($data);
					        $row++;
					        $arr = [];

					        if($row != 2){
					        	for ($c=0; $c < $num; $c++) {
						            $arr[] = $data[$c];
						        }

						        $insert = array(
						        	'name' => $arr[0],
						        	'email' => $arr[1],
						        	'valid' => 1,
						        	'created' => date('Y-m-d H:i:s')
						        );

						        $this->FileUpload->clear();
						        $this->FileUpload->create(false);
						        $this->FileUpload->save($insert);
					        }
					        
	                	}	
	                	fclose($csvFile);

	                	$this->Session->setFlash(__('File has been uploaded and inserted successfully.'),'flash_metronic', array('class' => 'alert-success'));

	                   
	                }else{
	                    $this->Session->setFlash(__('Unable to upload file, please try again.'),'flash_metronic', array('class' => 'alert-danger'));
	                }
            	}else{
            		$this->Session->setFlash(__('Invalid File'),'flash_metronic', array('class' => 'alert-danger'));
            	}
               
            }else{
                $this->Session->setFlash(__('Please choose a file to upload.'),'flash_metronic', array('class' => 'alert-danger'));
            }
            
        }

		$this->set(compact('file_uploads', 'uploadData'));
	}


}

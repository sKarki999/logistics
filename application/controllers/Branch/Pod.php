 <?php
class Pod extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // load the models
        $this->load->model('PodModel');
        $this->load->model('InvoiceModel');
         // check if user is authorized
        if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in') == true) {
            return true;
        } else {
            redirect('Account');
        }
    }

    public function index() {
        $data['pod_number'] = $this->PodModel->getPodNumber();
        $this->load->view('System/branch/createPod_view',$data);
    }


    public function getRequiredCnn() {
        $branch_id  = $this->session->userdata('branch_id');
        $cnNo       = $this->input->post('cn');
        $result     = $this->PodModel->getCnn($branch_id, $cnNo);
        if($result){
            $data = json_encode($result);
            echo $data;
        }else{
            echo '0';
        }
    }

    public function savePod() {

        $pod_entry_date     = $this->input->post('pod_entry_date');
        $pod_number         = $this->input->post('pod_number');
        $branch             = $this->session->userdata('branch_id');
        $user_id            = $this->session->userdata('userId');

        $data = array (
            'pod_number'        => $pod_number,
            'pod_entry_date'    => $pod_entry_date,
            'user_id'           => $user_id,
            'branch_id'         => $branch
        );

        $result1 = $this->PodModel->savePod($data);

        // save to master runsheet details
        $cnNo           = $this->input->post('cnno');
        $receiver_name  = $this->input->post('receiver_name');
        $address        = $this->input->post('address');
        $contact        = $this->input->post('contact');
        $handedTo       = $this->input->post('handedTo');
        $csig           = $this->input->post('csig');
        $status         = 'Pending';
        $total          = count($cnNo);

        for ($i=0; $i<$total; $i++) {

            if($cnNo[$i]) {
                $PodData = array(
                    'pod_master_id'     => $result1,
                    'master_pod_number' => $pod_number,
                    'cnno'              => $cnNo[$i],
                    'receiver_name'     => $receiver_name[$i],
                    'address'           => $address[$i],
                    'contact'           => $contact[$i],
                    'handedTo'          => $handedTo[$i],
                    'csig'              => $csig[$i],
                    'branch'            => $branch,
                    'user'              => $user_id,
                    'pod_created_date'  => $pod_entry_date
                );
                $data = array (
                    'pod_no' => $pod_number
                );
            }
            // print_r($manifestData);
            $result2 = $this->PodModel->savePodDetails($PodData);
            $result3 = $this->InvoiceModel->updateOneFieldInInvoice($data, $cnNo[$i]);
        }

        if($result1 && $result2 && $result3) {
            $message = "Delivery Runsheet created Succesfully...";
            $this->session->set_flashdata('msg', $message);
        }
        redirect("Branch/Pod");

    }


    public function masterRecord() {
        $branch_id    = $this->session->userData('branch_id');
        $data['pods'] = $this->PodModel->getAllPod($branch_id);
        // print_r($data);
        $this->load->view('System/Branch/podDetail_view', $data);
    }

}

?>
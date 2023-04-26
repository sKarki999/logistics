<?php

class Api extends CI_Controller {

    // public function index() {
    //     $this->load->view('welcome_message');
    // }

    // method to create data in JSON format
    public function Version1($cnn) {
        $this->load->model('ApiModel');
        $data           = [];
        $cnDetails      = [];
        $sender         = [];
        $receiver       = [];
        $travelHistory  = [];

        $data['title']          = "Tracking Result for Consignment Number #".$cnn;
        $cnData                 = $this->ApiModel->getCnDetails($cnn);
        $data['dispatched']     = $this->ApiModel->getManifestCreatedDate($cnn);
        $data['arrived']        = $this->ApiModel->getManifestReceivedDate($cnn);
        $data['deliveryDate']   = $this->ApiModel->podDate($cnn);

        // print_r($cnData);
        // print_r($data['dispatched']);

        if($cnData) {
            // consignment details
            $cnDetails['cnn']               = $cnData['0']['bill_number'];
            $cnDetails['booking_date']      = $cnData['0']['booking_date'];
            $cnDetails['mailing_mode']      = $cnData['0']['mailing_mode'];
            $cnDetails['weight']            = $cnData['0']['weight'];
            $cnDetails['qty']               = $cnData['0']['qty'];
            $cnDetails['item_type']         = $cnData['0']['item_type'];
            $cnDetails['item_price']        = $cnData['0']['item_price'];
            $cnDetails['payment_mode']      = $cnData['0']['payment_mode'];
            $data['cnDetails']              = $cnDetails;

            // sender details
            if ($cnData['0']['one_time_customer'] != null) {
                $sender['name'] = $cnData['0']['one_time_customer'];
            } else {
                $sender['name'] = $this->ApiModel->getCustomerName($cnData['0']['customer_id']);
            }
            $sender['address']      = $cnData['0']['customer_address'];
            $sender['contact']      = $cnData['0']['customer_number'];
            $data['senderDetails']  = $sender;

            // receiver details
            $receiver['name']              = $cnData['0']['one_time_receiver'];
            $receiver['dropOff_address']   = $cnData['0']['dropOff_address'];
            $receiver['receiver_number']   = $cnData['0']['receiver_number'];
            $data['receiverDetails']  = $receiver;

            // Travel History
            $travelHistory['scheduleLocation']      = $cnData['0']['branch_name']. ',' . $cnData['0']['branch_address'];
            $travelHistory['scheduleBranchAddress'] = $cnData['0']['branch_address'];
            $travelHistory['branchName']            = $cnData['0']['branch_name'];
            $travelHistory['booked_date']           = $cnData['0']['booking_date'];

            if(isset($data['deliveryDate']['pod_created_date'])) {
                $travelHistory['currentStatus'] = 'Shipment Delivered';
            } else if(isset($data['arrived']['manifest_received_date'])) {
                $travelHistory['currentStatus'] = "Shipment Arrived";
            } else {
                $travelHistory['CurrentStatus'] = "Shipment In Transit";
            }

            $travelHistory['shippedDate'] = isset($data['dispatched']['shipped_date']);
			$travelHistory['receivedDate'] = isset($data['arrived']['manifest_received_date']);
			$travelHistory['deliveredDate'] = isset($data['deliveryDate']['pod_created_date']);
			$data["travelHistory"] = $travelHistory;

        } else {
            $data['error'] = 'Sorry.. Record Not Found !!!';
        }

        header('Content-Type: application/json');
        $result = json_encode($data, JSON_PRETTY_PRINT);
        echo $result;

    }

}
?>
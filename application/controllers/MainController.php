<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MainController extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Searching");
        $this->load->helper("airline");
        
    }

    public function index()
    {
        require_once './vendor/autoload.php';
        // echo "CodeIgniter 3.1.11 with Sabre API";
        // die();
        // init configuration
        $clientID = GKEY;
        $clientSecret = GSALT;
        $redirectUri = 'http://localhost:8082/cheapofare-us/index.php/MainController/google';

        // create Client Request to access Google API
        $google = new Google_Client();
        $google->setClientId($clientID);
        $google->setClientSecret($clientSecret);
        $google->setRedirectUri($redirectUri);
        $google->addScope("email");
        $google->addScope("profile");
        $gurl = "";
        if (!isset($_GET['code'])) {
            $gurl = $google->createAuthUrl();
        }

        $data = get_data("index.php")[0];
        // echo "<pre>";
        // print_r($data);
        // die;
        $airlines = $this->db->get("tbl_airlines")->result();

        $this->load->view("includes/front_header", compact("data", "airlines"));

        $this->load->view("home");
        $this->load->view("includes/front_footer", ["google" => $gurl]);
    }


    public function read()
    {
        
        // header('Access-Control-Allow-Origin: *');
        // header("Access-Control-Allow-Methods: GET, OPTIONS");
        $q = $this->input->get("q");
        
        $my_data = $this->security->xss_clean($q);
        
        // $con = mysqli_connect("localhost", "soulfulv_root", "Hello@123#", "soulfulv_sabre");

        // $sql = "SELECT `code`,`airline` FROM tbl_airline_search WHERE MATCH (`code`,`airline`) AGAINST ('+$my_data*' IN Boolean MODE)";
        // $sql = "SELECT `code`,`airline` FROM tbl_airline_search WHERE `code =` '$my_data'";
        
        // $results = $this->db->query($sql)->result();
        $results = $this->db->select('code,airline')->from('tbl_airline_search')->where('code',$my_data)->get()->result();
        
        if (count($results) > 0) {
            
            foreach ($results as $key => $result) {
                
                $IATAcode = strtoupper(trim($result->code));
                $Airport = str_ireplace(["// "], "", strtoupper(trim($result->airline)));
                echo "$Airport, $IATAcode\n";
            }
        }
    }


    public function contact()
    {
        $data = get_data("index.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("contact");
        $this->load->view("includes/front_footer");
    }
    
    public function flights()
    {
        $data = get_data("index.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flights");
        $this->load->view("includes/front_footer");
    } 


    public function about()
    { 
        $data = get_data("index.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("about");
        $this->load->view("includes/front_footer");
    }

   

    public function privacy()
    {
        $data = get_data("index.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("privacy");
        $this->load->view("includes/front_footer");
    }
    
     public function terms()
    {
        $data = get_data("index.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("term");
        $this->load->view("includes/front_footer");
    }
 public function refund()
    {
        $data = get_data("index.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("refund");
        $this->load->view("includes/front_footer");
    } 
    
 public function first_cls_reservation()
    {
        $data = get_data("first-class-reservation.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("first-class-reservation");
        $this->load->view("includes/front_footer");
    } 

public function business_cls_reservation()
    {
        $data = get_data("business-class-reservation.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("business-class-reservation");
        $this->load->view("includes/front_footer");
    } 
    
    public function group_tvl_reservation()
    {
        $data = get_data("group-travel-reservation.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("group-travel-reservation");
        $this->load->view("includes/front_footer");
    }
    
    public function flight_to_orlando()
    {
        $data = get_data("flight-ticket-orlando.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flight-ticket-orlando");
        $this->load->view("includes/front_footer");
    }
    
    public function flight_to_las_vegas()
    {
        $data = get_data("flight-ticket-las-vegas.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flight-ticket-las-vegas");
        $this->load->view("includes/front_footer");
    }
    
    public function flight_to_new_york()
    {
        $data = get_data("flight-ticket-new-york.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flight-ticket-new-york");
        $this->load->view("includes/front_footer");
    }
    
    
     public function cheap_flight_chicago()
    {
        $data = get_data("cheap-flight-chicago.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-chicago");
        $this->load->view("includes/front_footer");
    }
    
    public function cheap_flight_dallas()
    {
        $data = get_data("cheap-flight-dallas.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-dallas");
        $this->load->view("includes/front_footer");
    }
    
    public function cheap_flight_denver()
    {
        $data = get_data("cheap-flight-denver.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-denver");
        $this->load->view("includes/front_footer");
    }
    
    public function cheap_flight_los_angeles()
    {
        $data = get_data("cheap-flight-los-angeles.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-los-angeles");
        $this->load->view("includes/front_footer");
    }
    
    public function cheap_flight_miami()
    {
        $data = get_data("cheap-flight-miami.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-miami");
        $this->load->view("includes/front_footer");
    }
    
    
    public function landing_page1()
    {
        $data = get_data("spirit-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("spirit-airlines");
        $this->load->view("includes/front_footer");
      
    }
    
    public function landing_page2()
    {
        $data = get_data("frontier-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("frontier-airlines");
        $this->load->view("includes/front_footer");
      
    }
    
    public function hawaiian_airlines()
    {
        $data = get_data("hawaiian-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("hawaiian-airlines");
        $this->load->view("includes/front_footer");
      
    }
    
    public function landing_California()
    {
        $data = get_data("cheap-flight-to-california.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-to-california");
        $this->load->view("includes/front_footer");
      
    }
    
    public function landing_alaska()
    {
       
        $data = get_data("cheap-flight-to-alaska.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-to-alaska");
        $this->load->view("includes/front_footer");
     
    }
    
    public function site_map()
    {
        $data = get_data("site-map.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("site-map");
        $this->load->view("includes/front_footer");
      
    }
    
    public function success_msg()
    {
        $data = get_data("success.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("success");
        $this->load->view("includes/front_footer");
      
    }
    
    public function user_inquiry()
    {
        
        $data = get_data("user-inquiry.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("user-inquiry");
        $this->load->view("includes/front_footer");
      
    }
    
    public function lp_page()
    {
        
        $data = get_data("lp-page.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("lp-page");
        $this->load->view("includes/front_footer");
      
    }
    
    public function flight_under49()
    {
        
        $data = get_data("book-airline-tickets-under-49.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("book-airline-tickets-under-49");
        $this->load->view("includes/front_footer");
      
    }
    
    public function flight_under39()
    {
        
        $data = get_data("flight-tickets-under-39.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flight-tickets-under-39");
        $this->load->view("includes/front_footer");
      
    }
    
   
    
    public function flight_search()
    {
        
        $data = get_data("flight-search.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flight-search");
        $this->load->view("includes/front_footer");
      
    }
    
    public function hawaiian_flights()
    {
        
        $data = get_data("hawaiian-flights.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("hawaiian-flights");
        $this->load->view("includes/front_footer");
      
    }
    
    public function jetblue_flights()
    {
        $data = get_data("jetblue-airways.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("jetblue-airways");
        $this->load->view("includes/front_footer");
    }
    
    public function united_flights()
    {
        $data = get_data("flights-to-united-states.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flights-to-united-states");
        $this->load->view("includes/front_footer");
    }
    
    public function allegiant_airlines()
    {
        $data = get_data("allegiant-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("allegiant-airlines");
        $this->load->view("includes/front_footer");
    }
    
    public function flights_southwest()
    {
        $data = get_data("flights-to-southwest.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flights-to-southwest");
        $this->load->view("includes/front_footer");
    }
    public function air_canada()
    {
        $data = get_data("air-canada.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("air-canada");
        $this->load->view("includes/front_footer");
    }
    
    public function air_france()
    {
        $data = get_data("air-france.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("air-france");
        $this->load->view("includes/front_footer");
    }
    
    public function discount_claim()
    {
        $data = get_data("discount-and-savings-claim.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("discount-and-savings-claim");
        $this->load->view("includes/front_footer");
    }
    public function top_destination()
    {
        $data = get_data("top-destination.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("top-destination");
        $this->load->view("includes/front_footer");
    }
    public function cheap_ft()
    {
        $data = get_data("cheap-flight-tickets.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-tickets");
        $this->load->view("includes/front_footer");
    }
    
    public function spirit_airlines()
    {
        $data = get_data("spirit-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("spirit-airlines");
        $this->load->view("includes/front_footer");
    }
    
    public function alaska_airlines()
    {
        $data = get_data("alaska-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("alaska-airlines");
        $this->load->view("includes/front_footer");
    }
    
    public function jetblue_airways()
    {
        $data = get_data("jetblue-airways.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("jetblue-airways");
        $this->load->view("includes/front_footer");
    }
    
    public function cheap_flight()
    {
        $data = get_data("cheap-flight.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight");
        $this->load->view("includes/front_footer");
    }
    
    public function aeromexico_airlines()
    {
        $data = get_data("aeromexico-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("aeromexico-airlines");
        $this->load->view("includes/front_footer");
    }
    
    public function flair_airlines()
    {
        $data = get_data("flair-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flair-airlines");
        $this->load->view("includes/front_footer");
    }
    
    public function test_front_page()
    {
        $data = get_data("test-front-page.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("test-front-page");
        $this->load->view("includes/front_footer");
    }
    
    public function southwest_airlines()
    {
        $data = get_data("southwest-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("southwest-airlines");
        $this->load->view("includes/front_footer");
    }
    
     public function disclaimer_page()
    {
        $data = get_data("disclaimer.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("disclaimer");
        $this->load->view("includes/front_footer");
    }
    
    public function front_page()
    {
        $data = get_data("front-page.php")[0];
        $this->load->view("includes/front_header_test", compact("data"));
        $this->load->view("front-page");
        $this->load->view("includes/front_footer_test");
    }
     public function about_usx()
    {
        $data = get_data("about-usx.php")[0];
        $this->load->view("includes/front_header_test", compact("data"));
        $this->load->view("about-usx");
        $this->load->view("includes/front_footer_test");
    }
    
    public function contact_usx()
    {
        $data = get_data("contact-us2.php")[0];
        $this->load->view("includes/front_header_test", compact("data"));
        $this->load->view("contact-usx");
        $this->load->view("includes/front_footer_test");
    }
    
    public function british_airways()
    {
        $data = get_data("british-airways.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("british-airways");
        $this->load->view("includes/front_footer");
    }
    public function canadian_north()
    {
        $data = get_data("canadian-north.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("canadian-north");
        $this->load->view("includes/front_footer");
    }
    public function qatar_airways()
    {
        $data = get_data("qatar-airways.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("qatar-airways");
        $this->load->view("includes/front_footer");
    }
    
    public function emirates_airlines()
    {
        $data = get_data("emirates-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("emirates-airlines");
        $this->load->view("includes/front_footer");
    }
    
    public function klm_airlines()
    {
        $data = get_data("klm-airlines.php")[0];
        $this->load->view("includes/front_header_test", compact("data"));
        $this->load->view("klm-airlines");
        $this->load->view("includes/front_footer_test");
    }
    
    public function united_airlines()
    {
        $data = get_data("united-airlines.php")[0];
        $this->load->view("includes/front_header_test", compact("data"));
        $this->load->view("united-airlines");
        $this->load->view("includes/front_footer_test");
    }
    
    public function lufthansa_airlines()
    {
        $data = get_data("lufthansa-airlines.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("lufthansa-airlines");
        $this->load->view("includes/front_footer");
    }
    
    public function cheap_flights()
    {
        $data = get_data("cheap-flight-booking.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-booking");
        $this->load->view("includes/front_footer");
    }
    
    public function cheap_flight_tickets()
    {
        $data = get_data("cheap-flight-tickets.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("cheap-flight-tickets");
        $this->load->view("includes/front_footer");
    }
    
    public function flights_under_49()
    {
        $data = get_data("flights-under-49.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flights-under-49");
        $this->load->view("includes/front_footer");
    }
    
    public function flights_under_69()
    {
        $data = get_data("flights-under-69.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flights-under-69");
        $this->load->view("includes/front_footer");
    }
    
    public function flights_under_99()
    {
        $data = get_data("flights-under-99.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flights-under-99");
        $this->load->view("includes/front_footer");
    }
    
    public function flights_under_199()
    {
        $data = get_data("flights-under-199.php")[0];
        $this->load->view("includes/front_header", compact("data"));
        $this->load->view("flights-under-199");
        $this->load->view("includes/front_footer");
    }
    
    
   
    
   

    

    public function session()
    {


        $this->load->view("session");
    }

    public function dashboard()
    {

        if ($this->session->userdata("email") != '') {
            $data = $this->db->get_where("tbl_booking", ["email" => $this->session->userdata("email")])->result();
            $hotel = $this->db->get_where("tbl_hotel_booking", ["first_email" => $this->session->userdata("email")])->result();
            $this->load->view("dashboard", compact("data", 'hotel'));
        } else {
            show_404();
        }
    }

    public function getIATA()
    {
        $term = $this->input->get("term");
        $term = strtolower($this->security->xss_clean($term));
        $data = $this->Searching->getIATA($term);
        echo json_encode($data);
    }

    public function google()
    {
        require_once 'vendor/autoload.php';

        // init configuration
        $clientID = '224481998806-brhkf9d2u658s8ndjmi571v3mkrhmb7m.apps.googleusercontent.com';
        $clientSecret = 'NI0bnZHer3ioqZ0piQ9fJAHJ';
        $redirectUri = 'http://localhost:8082/cheapofare-us/index.php/MainController/google';


        // create Client Request to access Google API
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        // authenticate code from Google OAuth Flow
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);

            // get profile info
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();



            // now you can use this profile info to create account in your website and make user logged in.
        } else {
            echo "<script>window.location.href='{$client->createAuthUrl()}'</script>";
        }
    }

   

    public function payment()
    {
        //  $data = $this->getpayment($this->security->xss_clean($this->input->post()));


        $passenger_count = array_count_values($this->input->post('ptype'));
        // echo "<pre>";
        // print_r($passenger_count);
        // die;
        $passenger_count = intval($passenger_count['ADT']) + (isset($passenger_count['CNN']) ? intval($passenger_count['CNN']) : 0) + (isset($passenger_count['SRC']) ? intval($passenger_count['SRC']) : 0);

        $data = $this->setPaymentAmadeus($this->security->xss_clean($this->input->post()));
        if ($this->config->item("onlineBooking") == true) {
            return redirect("ticket/" . $data);
        } else {
            return redirect("gticket/" . $data);
        }
    }

    public function gticket()
    {
        $data = $this->db->get_where("tbl_booking", ["pnr" => $this->uri->segment("2")])->result()[0];
        // echo "<pre>";
        // print_r($data);
        // die;
        $post = json_decode($data->request);
        $this->load->view("airticketOffline", ["data" => $data]);
        $this->offlineMail($data);
        $this->db->delete("tbl_abandon_booking", ["email" => $data->email, "datentime" => date("Y-m-d")]);
    }


    private function offlineMail($data)
    {
        $innerdata = "";
        $html =   $this->load->view("airticketOffline", ["data" => $data], TRUE);
        $post = json_decode($data->request);
        $subject = WEBSITE . "–  ({$post->fname[0]}) – Booking Confirmation # ( {$data->pnr} )";
        $config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->reply_to(EMAIL_B, WEBSITE);
        $this->email->from(EMAIL_B, WEBSITE);
        $to = $data->email;

        $this->email->to($to);
        $this->email->bcc([EMAIL_B, "dkmahtog@gmail.com"]);
        $this->email->subject($subject);
        $this->email->message($html);




        // $config2 = array(
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8',
        // );

        // $this->load->library('email', $config2);
        // $this->email->set_newline("\r\n");
        // $this->email->reply_to(EMAIL_B, WEBSITE);
        // $this->email->from(EMAIL_B, WEBSITE);

        // $this->email->bcc([EMAIL_B]);

        // $this->email->subject($subject);
        // $this->email->message($html2);

        $query = $this->db->get_where("tbl_booking", ["pnr" => $this->uri->segment("2")])->result();

        if (count($query) > 0) {
            if ($query[0]->mail != 1 && $this->email->send()) {
                $this->db->update("tbl_booking", ["mail" => 1], ["pnr" => $this->uri->segment("2")]);
                $html = "";
                $html2 = "";
            }
        }
    }

    // public function getPaymentOffilineInsert($offlineData, $postData, $total, $markup = 0)
    // {

    //     $pnr = "CH" . mt_rand(100, 9999);

    //     $this->db->insert("tbl_booking", ["pnr" => $pnr, 'device_type' => $this->getAgentType(), 'ip_address' => $this->input->ip_address(), "email" => json_decode($postData)->email[0], "datentime" => date("Y-m-d H:i:s"), "mail" => 0, "request" => ($postData), 'trip_type' => json_decode($postData)->tripType, "markup_value" => $markup, "offline_booking_data" => $offlineData, "price" => $total]);
    //     return $pnr;
    // }


    public function ResultBargain()
    {
        $trip = $this->input->get("trip");
        $depart = $this->input->get("depart");
        $arrival = $this->input->get("arrival");
        $departOn = date("Y-m-d", strtotime($this->input->get("departOn")));
        $returnOn = $this->input->get("returnOn") ? date("Y-m-d", strtotime($this->input->get("returnOn"))) : "";
        $adult = $this->input->get("adult");
        $child = $this->input->get("child");
        $total = intval($adult) + intval($child);
        $page = $this->input->get("page") ? $this->input->get("page") : 1;
        $offset = (intval($page) * 10 - 10) + 1;
        if ($departOn != '' && $returnOn != '') {
            $result = $this->getFareResult("/v2/shop/flights?origin=$depart&destination=$arrival&departuredate=$departOn&returndate=$returnOn&passengercount=$total&enabletagging=true&limit=30&offset=$offset&pointofsalecountry=US");
            $this->load->view("result", compact("result"));
        } else {
            $result = $this->getFareResult("/v2/shop/flights?origin=$depart&destination=$arrival&departuredate=$departOn&passengercount=$total&enabletagging=true&limit=30&offset=$offset&pointofsalecountry=US");
            $this->load->view("result", compact("result"));
        }
    }

    public function ticket()
    {

        $data = $this->db->get_where("tbl_booking", ["pnr" => $this->uri->segment("2")])->result()[0];
        $post = json_decode($data->request);
        $this->load->view("airticket", ["ticket" => json_decode($data->booking_data), "post" => json_decode($data->request)]);
        $ticket = json_decode($data->booking_data);

        if ($data->mail == 0) {
            $innerdata = "";
            $calculate_mark = 0;
            $markup_value = $this->session->userdata("markupdata") ? json_decode(json_encode(json_decode($this->session->userdata("markupdata"))), TRUE) : null;

            if (count($markup_value) > 0) {

                if ($markup_value["type"] == 0) {
                    $calculate_mark = round($markup_value["price"]);
                } else {
                    if (isset($ticket->CreatePassengerNameRecordRS->AirPrice)) {
                        $calculate_mark = round(floatval($ticket->CreatePassengerNameRecordRS->AirPrice[0]->PriceQuote->PricedItinerary->TotalAmount) * (floatval($markup_value["price"])) / 100);
                    } else {
                        $calculate_mark = 0;
                    }
                }
            }


            foreach ($ticket->CreatePassengerNameRecordRS->AirBook->OriginDestinationOption->FlightSegment as $FlightSegment) {

                $airlinename = getAirlineName($FlightSegment->MarketingAirline->Code);
                $innerdata .= <<<EOD
<tr>
            <td> <img src="https://www.gstatic.com/flights/airline_logos/70px/{$FlightSegment->MarketingAirline->Code}.png" alt="" />
            $airlinename
            </td>
            <td>{$FlightSegment->MarketingAirline->FlightNumber}</td>
            <td>{$FlightSegment->OriginLocation->LocationCode} </td>
            <td>{$FlightSegment->DepartureDateTime} </td>
            <td>{$FlightSegment->DestinationLocation->LocationCode} </td>
            <td>{$FlightSegment->ArrivalDateTime} </td>
            <td>{$FlightSegment->ResBookDesigCode} </td>
            <td>{$FlightSegment->NumberInParty} </td>

        </tr>
      
EOD;
            }
            $passengerdata = "";
            foreach ($ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->CustomerInfo->PersonName as $key => $PersonName) {
                $keyt = $key + 1;

                $passengerdata .= <<<EOD
   <tr>
        <td>{$keyt} </td>
        <td>{$PersonName->GivenName} </td>
        <td>{$PersonName->Surname} </td>
    </tr>

EOD;
            }

            $adate = date(" M d, Y", strtotime($ticket->CreatePassengerNameRecordRS->ApplicationResults->Success[0]->timeStamp));
            $html = <<<EOD

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket:autralia travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>        body {
    background-color: fff;
}

table {
    border-collapse: collapse;
}

table,
td,
th {
    border: 1px solid #d8d5d5;
}

.table-head {}

.table-head thead {
    background-color: #1692b7;
    color: #fff;
}

.table-head th a {
    color: #fff
}

.table-head .info {
    background-color: rgba(167, 167, 167, 0);
    /* border: #000 1px solid; */
    color: #7c7c7c;
}

.table-head .details {
    background-color: #ffffff;
}

.table-head .date {
    color: #ffffff;
    font-size: 22px !important;
    font-weight: 500;
    background-color: #1692b7;
}

.table-head .flight {
    color: #555555;
    font-weight: 600;
    font-size: 18px;
}

.table-head .details tr {
    color: #636363;
    font-size: 14px;
    font-weight: 500;
}

.table-head .details tr td {
    border-top: none;
    font-size: 16px;
}

.table-head .info tr th {
    border-bottom: none;
}

.table-head .details tr .dep {
    font-weight: 600;
}

.table-head .details tr .arr {
    font-weight: 600;
}

.table-head .info tr th td {
    border-top: none;
}
.table>thead>tr>td {}

.table-head h1 {
    font-size: 24px;
    color: #2196f3;
    font-weight: 500;
    margin: 0;
    padding: 7px 0px;
}

.table-head .details .refund {
    color: #ff4c4c;
    font-size: 14px;
}

.table-head .travl {
    padding: 15px 16px;
}

.table-head .trip {
    font-size: 21px;
}

.table-head .policy {}

.table-head .policy h1 {
    font-size: 18px;
    font-weight: 500;
}

.table-head .policy p {
    font-size: 10px;
    font-weight: 100;
    color: #868686;
}
</style>
</head>
<body>
<div class="container">
<div class="table-responsive">
    <table class="table table-head">
        <thead>
            <tr>
                <th colspan="5" class="trip">Your Trip Details</th>
            </tr>
        </thead>
        <thead class="info">
            <tr>
                <th colspan="3" class="travl">Traveler</th>

                <th>Booking Refrence Number</th>
                <th>Booking Date<br></th>

            </tr>
            <tr class="del">
                <td colspan="3"> 
EOD;
            $name_passenger = $ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->CustomerInfo->PersonName[0]->Surname . "/" . $ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->CustomerInfo->PersonName[0]->GivenName;
            foreach ($ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->CustomerInfo->PersonName as $key => $PersonName) {

                $html .= <<<EOD

                        {$PersonName->Surname}  {$PersonName->GivenName}   <br>
EOD;
            }
            $date = date("D,d-M-Y", strtotime($ticket->CreatePassengerNameRecordRS->ApplicationResults->Success[0]->timeStamp));
            $html .= <<<EOD
                    </td>

                <td>{$ticket->CreatePassengerNameRecordRS->ItineraryRef->ID}</td>
                <td>{$date}</td>


            </tr>

        </thead>

        <tbody class="details">
EOD;

            foreach ($ticket->CreatePassengerNameRecordRS->AirBook->OriginDestinationOption->FlightSegment as $fkey => $FlightSegment) {


                $airlinename = getAirlineName($FlightSegment->MarketingAirline->Code);
                $arrivaldate = ((explode("T", $FlightSegment->ArrivalDateTime)[0] . "-" . date("Y"))) . " " . explode("T", $FlightSegment->ArrivalDateTime)[1];
                $departdate = ((explode("T", $FlightSegment->DepartureDateTime)[0] . "-" . date("Y"))) . " " . explode("T", $FlightSegment->DepartureDateTime)[1];
                $cabin = isset($ticket->CreatePassengerNameRecordRS->AirPrice) ? getCabinType($ticket->CreatePassengerNameRecordRS->AirPrice[0]->PriceQuote->PricedItinerary->AirItineraryPricingInfo[0]->FareCalculationBreakdown[$fkey]->FareBasis->Cabin) : "";
                $html .= <<<EOD

                <tr>

                    <td colspan="5" class="date">{$departdate}</td>
                </tr>
                <tr>
                    <td><img src="https://www.gstatic.com/flights/airline_logos/70px/{$FlightSegment->MarketingAirline->Code}.png" alt="" /> $airlinename </td>
                    <td class="flight"> {$FlightSegment->MarketingAirline->Code}   {$FlightSegment->MarketingAirline->FlightNumber}</td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td></td>
                    <td class="dep">Departure</td>
                    <td>{$departdate}</td>
                    <td>{$FlightSegment->OriginLocation->LocationCode}</td>
                    <td></td>

                </tr>
                <tr>
                <td></td>
                <td class="dep">Arrival (m-d-y) </td>
                <td>$arrivaldate</td>
                <td>{$FlightSegment->DestinationLocation->LocationCode}</td>
                <td></td>

            </tr>
                <tr>
                    <td> </td>
                    <td>Duration</td>
                    <td></td>
                    <td>{$ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->ItineraryInfo->ReservationItems->Item[$fkey]->FlightSegment[0]->ElapsedTime}</td>
                    <td></td>

                </tr>
                <tr>
                    <td> </td>
                    <td>Distance</td>
                    <td></td>
                    <td>{$ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->ItineraryInfo->ReservationItems->Item[$fkey]->FlightSegment[0]->AirMilesFlown} Miles</td>
                    <td></td>

                </tr>
                <tr>
                    <td> </td>
                    <td>Equipment</td>
                    <td></td>
                    <td> {$ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->ItineraryInfo->ReservationItems->Item[$fkey]->FlightSegment[0]->Equipment->AirEquipType}   <br>   Stop(s):{$ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->ItineraryInfo->ReservationItems->Item[$fkey]->FlightSegment[0]->StopQuantity} </td>
                    <td></td>

                </tr>

                <tr>
                    <td> </td>
                    <td>Class</td>
                    <td></td>
                    <td>{$cabin}</td>
                    <td></td>

                </tr>
            
EOD;
            }

            if (isset($ticket->CreatePassengerNameRecordRS->AirPrice)) {
                $ticket_amt = isset($ticket->CreatePassengerNameRecordRS->AirPrice) ? $ticket->CreatePassengerNameRecordRS->AirPrice[0]->PriceQuote->PricedItinerary->TotalAmount + $calculate_mark : "---";
                $currency = isset($ticket->CreatePassengerNameRecordRS->AirPrice) ? $ticket->CreatePassengerNameRecordRS->AirPrice[0]->PriceQuote->PricedItinerary->CurrencyCode : "---";
                $html .= <<<EOD

            <tr>
                <td> </td>
                <td>Booking status</td>
                <td></td>
                <td> {$ticket->CreatePassengerNameRecordRS->ApplicationResults->status}</td>
                <td></td>

            </tr>
            <tr>
                <td> </td>
                <td>Booking Price</td>
                <td></td>
                <td></td>
                <td> {$currency}  {$ticket_amt} </td>

            </tr>
EOD;
            }


            $html .= <<<EOD
 
             <tr>
                <td colspan="5" class="refund">1. This is non-refundable unless otherwise stated*<br>
                    2. All fares are not guaranteed until ticketed*<br>
                    3. Tickets are Non – refundable until specified*<br>
                    4. Confirmed tickets can be voided if within 24 hours of booking, post 24 hours, standard airlines rules apply*


                </td>
            </tr>



        </tbody>

        <thead class="info">
            <tr>
                <th colspan="3" class="travl">Agency Name</th>
                <th>Email Id</th>
                <th>Customer Care<br></th>

            </tr>
            <tr class="del">
                <td colspan="3">Airefaremoss </td>
                <td>services@airfaremoss.com</td>
                <td>123-456-7890  </td>

            </tr>

        </thead>
        <tfoot>
            <tr>
                <th colspan="4">
                    &nbsp;
                </th>
                <th>
                    <img style="width:120px" src="http://146.66.68.148/~flightfa/demo/australia/frontend/img/logo.png" alt="">
                </th>
            </tr>
            <tr>
                <th colspan="5" class="policy">
                    <h1>Payment Policy:</h1>
                    <p> We accept credit cards and debit cards issued in US, Canada and several other countries as listed in the billings section. We also accept AE/AP billing addresses.</p>

                    <p> 1. Please note: your credit/debit card may be billed in multiple charges totaling the final total price. If your credit/debit card or other form of payment is not processed or accepted for any reason, we will notify you within 24 hours (it may take longer than 24 hours for non credit/debit card payment methods). Prior to your form of payment being processed and accepted successfully, if there is a change in the price of air fare or any other change, you may be notified of this change and only upon such notification you have the right to either accept or decline this transaction. If you elect to decline this transaction, you will not be charged.</p>

                    <p>
                        2. Our Post Payment Price Guarantee: Upon successful acceptance and processing of your payment (credit/debit card), we guarantee that we will honor the total final quoted price of the airline tickets regardless of any changes or fluctuation in the price of air fare.

                        Please note: all hotel, car rental and tour/activity bookings are only confirmed upon delivery of complete confirmation details to the email you provided with your reservation. In some cases, pre-payment may be required to receive confirmation.
                    </p>

                    <p>
                        In order to provide you with further protection, when certain transactions are determined to be high-risk by our systems, we will not process such transactions unless our credit card verification team has determined that it's safe to process them. In order to establish validity of such transactions, we may contact you or your bank.
                    </p>

                </th>

            </tr>
        </tfoot>
    </table>
</div>
</div>
</body>
</html>
EOD;


            $html2 = <<<EOD

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket:airfaremoss.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<style> 
 body {
    background-color: fff;
}
table {
    border-collapse: collapse;
}

table,
td,
th {
    border: 1px solid #d8d5d5;
}

.table-head {}

.table-head thead {
    background-color: #1692b7;
    color: #fff;
}

.table-head th a {
    color: #fff
}

.table-head .info {
    background-color: rgba(167, 167, 167, 0);
    /* border: #000 1px solid; */
    color: #7c7c7c;
}

.table-head .details {
    background-color: #ffffff;
}

.table-head .date {
    color: #ffffff;
    font-size: 22px !important;
    font-weight: 500;
    background-color: #1692b7;
}

.table-head .flight {
    color: #555555;
    font-weight: 600;
    font-size: 18px;
}

.table-head .details tr {
    color: #636363;
    font-size: 14px;
    font-weight: 500;
}

.table-head .details tr td {
    border-top: none;
    font-size: 16px;
}

.table-head .info tr th {
    border-bottom: none;
}

.table-head .details tr .dep {
    font-weight: 600;
}

.table-head .details tr .arr {
    font-weight: 600;
}

.table-head .info tr th td {
    border-top: none;
}

.table>thead>tr>td {}

.table-head h1 {
    font-size: 24px;
    color: #2196f3;
    font-weight: 500;
    margin: 0;
    padding: 7px 0px;
}

.table-head .details .refund {
    color: #ff4c4c;
    font-size: 14px;
}

.table-head .travl {
    padding: 15px 16px;
}

.table-head .trip {
    font-size: 21px;
}

.table-head .policy {}

.table-head .policy h1 {
    font-size: 18px;
    font-weight: 500;
}

.table-head .policy p {
    font-size: 10px;
    font-weight: 100;
    color: #868686;
}
</style>
</head>
<body>
<div class="container">
<div class="table-responsive">
    <table class="table table-head">
        <thead>
            <tr>
                <th colspan="5" class="trip">Your Trip Details</th>


            </tr>
        </thead>
        <thead class="info">
            <tr>
                <th colspan="3" class="travl">Traveler</th>

                <th>Booking Reference Number</th>
                <th>Booking Date<br></th>

            </tr>
            <tr class="del">
                <td colspan="3"> 
EOD;
            $name_passenger = $ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->CustomerInfo->PersonName[0]->Surname . "/" . $ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->CustomerInfo->PersonName[0]->GivenName;
            foreach ($ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->CustomerInfo->PersonName as $key => $PersonName) {

                $html2 .= <<<EOD

                        {$PersonName->Surname}  {$PersonName->GivenName}   <br>
EOD;
            }
            $date = date("D,d-M-Y", strtotime($ticket->CreatePassengerNameRecordRS->ApplicationResults->Success[0]->timeStamp));
            $html2 .= <<<EOD
                    </td>

                <td>{$ticket->CreatePassengerNameRecordRS->ItineraryRef->ID}</td>
                <td>{$date}</td>


            </tr>

        </thead>

        <tbody class="details">
EOD;

            foreach ($ticket->CreatePassengerNameRecordRS->AirBook->OriginDestinationOption->FlightSegment as $fkey => $FlightSegment) {
                $airlinename = getAirlineName($FlightSegment->MarketingAirline->Code);
                $arrivaldate = ((explode("T", $FlightSegment->ArrivalDateTime)[0] . "-" . date("Y"))) . " " . explode("T", $FlightSegment->ArrivalDateTime)[1];
                $departdate = ((explode("T", $FlightSegment->DepartureDateTime)[0] . "-" . date("Y"))) . " " . explode("T", $FlightSegment->DepartureDateTime)[1];
                $cabin = isset($ticket->CreatePassengerNameRecordRS->AirPrice) ? getCabinType($ticket->CreatePassengerNameRecordRS->AirPrice[0]->PriceQuote->PricedItinerary->AirItineraryPricingInfo[0]->FareCalculationBreakdown[$fkey]->FareBasis->Cabin) : "";
                $html2 .= <<<EOD

                <tr>

                    <td colspan="5" class="date">{$departdate}</td>
                </tr>
                <tr>
                    <td><img src="https://www.gstatic.com/flights/airline_logos/70px/{$FlightSegment->MarketingAirline->Code}.png" alt="" /> $airlinename </td>
                    <td class="flight"> {$FlightSegment->MarketingAirline->Code}   {$FlightSegment->MarketingAirline->FlightNumber}</td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td></td>
                    <td class="dep">Departure</td>
                    <td>{$departdate}</td>
                    <td>{$FlightSegment->OriginLocation->LocationCode}</td>
                    <td></td>

                </tr>
                <tr>
                <td></td>
                <td class="dep">Arrival (m-d-y) </td>
                <td>$arrivaldate</td>
                <td>{$FlightSegment->DestinationLocation->LocationCode}</td>
                <td></td>

            </tr>
                <tr>
                    <td> </td>
                    <td>Duration</td>
                    <td></td>
                    <td>{$ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->ItineraryInfo->ReservationItems->Item[$fkey]->FlightSegment[0]->ElapsedTime}</td>
                    <td></td>

                </tr>
                <tr>
                    <td> </td>
                    <td>Distance</td>
                    <td></td>
                    <td>{$ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->ItineraryInfo->ReservationItems->Item[$fkey]->FlightSegment[0]->AirMilesFlown} Miles</td>
                    <td></td>

                </tr>
                <tr>
                    <td> </td>
                    <td>Equipment</td>
                    <td></td>
                    <td> {$ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->ItineraryInfo->ReservationItems->Item[$fkey]->FlightSegment[0]->Equipment->AirEquipType}   <br>   Stop(s):{$ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->ItineraryInfo->ReservationItems->Item[$fkey]->FlightSegment[0]->StopQuantity} </td>
                    <td></td>

                </tr>

                <tr>
                    <td> </td>
                    <td>Class</td>
                    <td></td>
                    <td>{$cabin}</td>
                    <td></td>

                </tr>
            
EOD;
            }

            if (isset($ticket->CreatePassengerNameRecordRS->AirPrice)) {
                $ticket_amt = $ticket->CreatePassengerNameRecordRS->AirPrice[0]->PriceQuote->PricedItinerary->TotalAmount + $calculate_mark;

                $html2 .= <<<EOD

            <tr>
                <td> </td>
                <td>Booking status</td>
                <td></td>
                <td> {$ticket->CreatePassengerNameRecordRS->ApplicationResults->status}</td>
                <td></td>

            </tr>
            <tr>
                <td> </td>
                <td>Booking Price</td>
                <td></td>
                <td></td>
                <td> {$ticket->CreatePassengerNameRecordRS->AirPrice[0]->PriceQuote->PricedItinerary->CurrencyCode}  {$ticket_amt} </td>

            </tr>
EOD;
            }
            $html2 .= <<<EOD
                <tr>
            <td>Card holder Name :  </td>
            <td>card holder email / Contact </td>
            <td> card_number </td>
            <td> exp_month/exp_year</td>
            <td> cvv2</td>

        </tr>
        <tr>
        <td> {$post->cardholderfname} {$post->cardholderlname} </td>
        <td> {$post->cardholderemail} / {$post->contact[0]} </td>
        <td>  {$post->card_number}   </td>
        <td> {$post->exp_month}/{$post->exp_year} </td>
        <td> {$post->cvv2}  </td>

    </tr>
    <tr>
    <td> Billing address (city/state/country/zip):  </td>
    
      <td colspan="2">{$post->city} / {$post->state}/  {$post->country}/ {$post->zip}</td>      
</tr>





            <tr>
                <td colspan="5" class="refund">1. This is non-refundable unless otherwise stated*<br>
                    2. All fares are not guaranteed until ticketed*<br>
                    3. Tickets are Non – refundable until specified*<br>
                    4. Confirmed tickets can be voided if within 24 hours of booking, post 24 hours, standard airlines rules apply*
                </td>
            </tr>



        </tbody>

        <thead class="info">
            <tr>
                <th colspan="3" class="travl">Agency Name</th>
                <th>Email Id</th>
                <th>Customer Care<br></th>

            </tr>
            <tr class="del">
                <td colspan="3">Airfaremoss</td>
                <td>services@airfaremoss.com</td>
                <td>123-456-7890  </td>

            </tr>

        </thead>
        <tfoot>
            <tr>
                <th colspan="4">
                    &nbsp;
                </th>
                <th>
                    <img style="width:120px" src="http://146.66.68.148/~flightfa/demo/australia/frontend/img/logo.png" alt="">
                </th>
            </tr>
            <tr>
                <th colspan="5" class="policy">
                    <h1>Payment Policy:</h1>
                    <p> We accept credit cards and debit cards issued in US, Canada and several other countries as listed in the billings section. We also accept AE/AP billing addresses.</p>

                    <p> 1. Please note: your credit/debit card may be billed in multiple charges totaling the final total price. If your credit/debit card or other form of payment is not processed or accepted for any reason, we will notify you within 24 hours (it may take longer than 24 hours for non credit/debit card payment methods). Prior to your form of payment being processed and accepted successfully, if there is a change in the price of air fare or any other change, you may be notified of this change and only upon such notification you have the right to either accept or decline this transaction. If you elect to decline this transaction, you will not be charged.</p>

                    <p>
                        2. Our Post Payment Price Guarantee: Upon successful acceptance and processing of your payment (credit/debit card), we guarantee that we will honor the total final quoted price of the airline tickets regardless of any changes or fluctuation in the price of air fare.

                        Please note: all hotel, car rental and tour/activity bookings are only confirmed upon delivery of complete confirmation details to the email you provided with your reservation. In some cases, pre-payment may be required to receive confirmation.
                    </p>

                    <p>
                        In order to provide you with further protection, when certain transactions are determined to be high-risk by our systems, we will not process such transactions unless our credit card verification team has determined that it's safe to process them. In order to establish validity of such transactions, we may contact you or your bank.
                    </p>

                </th>

            </tr>
        </tfoot>
    </table>
</div>
</div>
</body>
</html>
EOD;


            $subject = "airefaremoss.com–  ($name_passenger) – Booking Confirmation # ( {$ticket->CreatePassengerNameRecordRS->ItineraryRef->ID} )";

            $config = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',
            );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->reply_to('oscar@airfarebuzz.com', 'Airfaremoss');
            $this->email->from('oscar@airfarebuzz.com', 'Airfaremoss');
            $to = $ticket->CreatePassengerNameRecordRS->TravelItineraryRead->TravelItinerary->CustomerInfo->PersonName[0]->Email[0]->content;
            $this->email->to($to);
            $this->email->bcc(["oscar@airfarebuzz.com, flightreservations@airfarebuzz.com, stevewalker@airfarebuzz.com"]);
            $this->email->subject($subject);
            $this->email->message($html);
            $this->email->send();
            $html = "";


            $config2 = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',
            );

            $this->load->library('email', $config2);
            $this->email->set_newline("\r\n");
            $this->email->reply_to('oscar@airfarebuzz.com', 'Airfaremoss.com');
            $this->email->from('oscar@airfarebuzz.com', 'Airfaremoss.com');

            $this->email->bcc(["oscar@airfarebuzz.com, flightreservations@airfarebuzz.com, stevewalker@airfarebuzz.com"]);

            $this->email->subject($subject);
            $this->email->message($html2);
            $this->db->update("tbl_booking", ["markup_value" => $calculate_mark], ["pnr" => $this->uri->segment("2")]);
            if ($this->email->send()) {
                $this->db->update("tbl_booking", ["mail" => 1], ["pnr" => $this->uri->segment("2")]);
                $html = "";
                $html2 = "";
            }
        }
    }
}

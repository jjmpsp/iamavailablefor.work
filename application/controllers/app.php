<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("Aauth");

        if( $this->aauth->is_loggedin() )
        {
            $this->aauth->update_activity(FALSE);
        }
    }

    public function test(){
        echo random_string('alnum', 32);

        $im = imagecreatefromjpeg(base_url().'uploads/test.jpg');

        if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
        {
            echo 'Image converted to grayscale.';

            imagejpeg($im, 'uploads/test_result.jpeg');
        }
        else
        {
            echo 'Conversion to grayscale failed.';
        }

        imagedestroy($im);
    }

    public function test2()
    {
        $this->load->helper('image_helper');
        echo randomPastelColor();

        // Use this to make a check that a username doesn't mach up to one of our defined routes...
        print_r(array_keys($this->router->routes));
    }

    public function test3()
    {   
        echo '<select>';
        $files = glob('themes/*.{json}', GLOB_BRACE);
        foreach($files as $file) {
            $json = json_decode(file_get_contents($file), true);
            //print_r($json);

            if (json_last_error() === JSON_ERROR_NONE) {
                // JSON is valid
                echo '<option>'.$json['name'].'</option>';
            }
        }
        echo '</select>';

        echo '<br>';
        echo '<br>';
        echo '-----------';
        echo '<br>';
        echo '<br>';

        foreach ($json['customSettings'] as $key => $setting) {
            switch ($setting['type']) {
                case 'textbox':
                    echo '<input type="text" name="textbox1">';
                    echo '<br>';
                    echo '<br>';
                    break;
                case 'dropdown':
                    echo '<select><option></option></select>';
                    echo '<br>';
                    echo '<br>';
                    break;
                case 'number':
                    echo '<input type="number" name="number1" min="1" max="5">';
                    echo '<br>';
                    echo '<br>';
                case 'colour':
                    echo '<input type="colour" name="colour1" value="colour">';
                    echo '<br>';
                    echo '<br>';
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }

    public function index() {
        $this->load->helper('form');
        $this->data['userdata'] = $this->aauth->get_user();
        $this->load->view('home', $this->data);
    }

    public function register($username="") {
        $this->load->helper('form');

        if( $this->aauth->is_loggedin() )
        {
            redirect('account/');
            exit;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('email_confirm', 'email confirmation', 'trim|required|valid_email|matches[email]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('password_confirm', 'password confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('username', 'username', 'trim|required|callback_username_check');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('register');
        }
        else
        {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            $username = $this->input->post('username', TRUE);

            $id = $this->aauth->create_user($email, $password, $username);
            $this->aauth->set_user_var("api_key",random_string('alnum', 32), $id);
            $this->aauth->login_fast($id);
            redirect('account/');
            exit;
        }


    }

    public function login() {
        $this->load->helper('form');

        if( $this->aauth->is_loggedin() )
        {
            redirect('account/');
            exit;
        }


        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
        }
        else
        {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);

            if ($this->aauth->login($email, $password, TRUE))
            {
                // Redirect to account panel
                redirect(base_url().'account/', 'refresh');
            }
            else
            {
                $this->data['errors'] = $this->aauth->get_errors();
                $this->load->view('login');
            }
        }
    }

    public function logout(){
        $this->aauth->logout();
        redirect(base_url());
    }

    public function account() {
        $this->load->helper('form');

        if( !$this->aauth->is_loggedin() )
        {
            redirect('login/');
            exit;
        }

        //$this->aauth->set_user_var("firstname","Joel");
        //$this->aauth->set_user_var("lastname","Murphy");
        //$this->aauth->set_user_var("api_key",random_string('alnum', 32));

        $keys = $this->aauth->list_user_var_keys();
        $values = array();
        for ($i=0; $i < count($keys); $i++) { 
            $values[$keys[$i]->key] = $this->aauth->get_user_var($keys[$i]->key);
        }

        $this->data['customUserdata'] = $values;
        $this->data['userdata'] = $this->aauth->get_user();
        //$this->data['errors'] = $this->aauth->get_errors();

        $this->data['genders'] = array(
            "1" => "Male",
            "2" => "Female"
        );

        $this->data['socialMedias'] = array(
            "twitter" => "Twitter",
            "facebook" => "Facebook",
            "google" => "Google+",
            "instagram" => "Instagram",
        );

        //List of countries
        $this->data['countries'] = array(
            "AF" => "Afghanistan",
            "AX" => "Åland Islands",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, The Democratic Republic of The",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GG" => "Guernsey",
            "GN" => "Guinea",
            "GW" => "Guinea-bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and Mcdonald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran, Islamic Republic of",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IM" => "Isle of Man",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JE" => "Jersey",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic of",
            "KR" => "Korea, Republic of",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MK" => "Macedonia, The Former Yugoslav Republic of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States of",
            "MD" => "Moldova, Republic of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestinian Territory, Occupied",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "SH" => "Saint Helena",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and The Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and The South Sandwich Islands",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan, Province of China",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands, British",
            "VI" => "Virgin Islands, U.S.",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe"
        );

        $this->data['workStatus'] = array(
            "1" => "Available for work",
            "-1" => "Unavailable for work",
        );

        // Load themes
        $themes = array();

        $json = json_decode(file_get_contents("themes/_index.json"));
        foreach ($json->themes as $theme)
        {
            $themes[] = $theme;
        }
        $this->data['themes'] = $themes;
        
        $this->load->view('account', $this->data);

        //redirect(base_url().'404/', 'refresh');
        //echo "This user hasn't configured their profile yet. If this profile belongs to you, please <a href=\"\">Login</a> and configure it.";
    }

    public function handleProfile($username) {

        if(! $this->aauth->user_exsist_by_name($username) )
        {   
            redirect('404');
            exit();
        }else{
            $this->load->helper('image_helper');
            $this->data['userdata'] = $this->aauth->get_user_by_name($username);
            $keys = $this->aauth->list_user_var_keys($this->data['userdata']->id);
            $values = array();
            for ($i=0; $i < count($keys); $i++) { 
                $values[$keys[$i]->key] = $this->aauth->get_user_var($keys[$i]->key, $this->data['userdata']->id);
            }

            $this->data['customUserdata'] = $values;

            if( $this->data['customUserdata']['UseCustomUrlValue'] )
            {
                redirect($this->data['customUserdata']['customUrlValue']);
            }else{
                $this->load->view('portfolio', $this->data);
            }
        }

    }

    public function profiles() {
        $this->load->view('profiles');
    }

    public function api() {
            
        $this->data = null;

        if( $this->aauth->is_loggedin() )
        {
            $this->data['api_key'] = $this->aauth->get_user_var('api_key');
        }

        $this->load->view('api', $this->data);
    }

    public function contact() {
        $this->load->view('contact');
    }

    function generateCss()
    {
        header("Content-type: text/css");
        echo "body,html{background-color:silver; height:100%;color:white}";
    }

    public function _404() {
        $this->output->set_status_header('404'); 
        $this->load->view('404'); 
    }


    // Validation callbacks
    public function email_check($email)
    {
        if( $this->aauth->user_exsist_by_email($email) )
        {
            $this->form_validation->set_message('email_check', 'This email is already in use. Please login if you already have an account.');
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function username_check($username)
    {   
        if( $this->aauth->user_exsist_by_name($username) )
        {
            $this->form_validation->set_message('username_check', 'This username is taken. Please choose another.');
            return FALSE;
        }else{
            return TRUE;
        }
        
    }
}

?>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Ajax extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->library("Aauth");
    }

    public function checkUsername_post(){

        $response = array(); 
        $errors = array();

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );
        
        if( $this->input->post("username") ){
            if( strrpos($this->input->post("username"), base_url()) === false)
            {
                $errors["invalidFormat"] = "Your web address is in an invalid format!";
            }else{
                $username = str_replace(base_url(), "", $this->input->post("username"));
                if( $this->aauth->user_exsist_by_name( $username ) ){
                    $response["usernameAvailable"] = false;
                }else{
                    $response["usernameAvailable"] = true;
                }
            }
        }else{
            $errors[] = "Invalid request";
        }

        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function editAccountSettings_post(){
        echo 'editAccountSettings';
        echo $this->security->get_csrf_hash();
        echo $this->security->get_csrf_token_name();
    }

    public function editProfileSettings_post(){
        $response = array(); 
        $errors = array();

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        if( $this->aauth->is_loggedin() )
        {
            if( $this->input->post('redirectWebAddressToggle') )
            {
                if( $this->input->post('redirectWebAddressToggle') == 'On')
                {
                    if( $this->input->post('customUrlValue') )
                    {   
                        $this->aauth->set_user_var('UseCustomUrlValue', true);
                        $this->aauth->set_user_var('customUrlValue', $this->input->post('customUrlValue'));
                        $response["message"] = "Custom URL setting turned on.";
                    }else{
                        $errors[] = array(
                            'field' => 'customUrlValue',
                            'message' => 'Custom URL field cannot be empty!'
                        );
                    }
                }else{
                    $this->aauth->set_user_var('UseCustomUrlValue', false);
                    $this->aauth->set_user_var('customUrlValue', $this->input->post('customUrlValue'));
                    $response["message"] = "Custom URL setting turned off.";
                }
            }
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function editProfileInformation_post(){
        //echo 'editProfileInformation';

        $response = array(); 
        $errors = array();

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        if( $this->aauth->is_loggedin() )
        {   
            if( $this->input->post('firstName') )
            {
                $firstname = $this->input->post('firstName');
                $this->aauth->set_user_var('firstName', $firstname);
            }
            if( $this->input->post('lastName') )
            {
                $lastname = $this->input->post('lastName');
                $this->aauth->set_user_var('lastName', $lastname);
            }
            if( $this->input->post('gender') )
            {
                $gender = $this->input->post('gender');
                $this->aauth->set_user_var('gender', $gender);
            }
            if( $this->input->post('country') )
            {
                $country = $this->input->post('country');
                $this->aauth->set_user_var('country', $country);
            }
            if( $this->input->post('occupation') )
            {
                $occupation = $this->input->post('occupation');
                $this->aauth->set_user_var('occupation', $occupation);
            }       
            if( $this->input->post('workStatus') )
            {
                $workstatus = $this->input->post('workStatus');
                $this->aauth->set_user_var('workStatus', $workstatus);
            }              
            if( $this->input->post('about') )
            {
                $about = $this->input->post('about');
                $this->aauth->set_user_var('about', $about);
            }
            if( $_FILES AND $_FILES['profilePicture']['name'] )
            {
                $profilepicture = $this->input->post('profilePicture');

                $this->load->library('image_lib');

                // Image upload configs - change this stuff later
                $config['upload_path'] = FCPATH.'_tmp-folder/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 1024 * 5; // 5MB
                $config['max_width']  = '2048';
                $config['max_height']  = '2048';
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("profilePicture"))
                {
                    $errors[] = array("message" => "Upload failed.");
                }
                else
                {   
                    // Variables used later when resizing an image
                    $originalFileUploadPath = $this->upload->data()['full_path'];
                    $originalFileUploadFilePath = $this->upload->data()['file_path'];
                    $originalFileRawName = $this->upload->data()['raw_name'];
                    $originalFileExt = $this->upload->data()['file_ext'];
                    
                    // resize the original image to various sizes
                    $config['image_library'] = 'GD2';
                    $config['source_image'] = $originalFileUploadPath;
                    $sizes = array(
                        array(
                            'width'     => 16,
                            'height'    => 16
                        ),
                        array(
                            'width'     => 250,
                            'height'    => 250
                        )
                    );
                    $fileNameForResizedImage = md5(microtime()).'.jpg';
                    foreach ($sizes as $size) {
                        $config['width']    = $size['width'];
                        $config['height']   = $size['height'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        $config['thumb_marker'] = '_'.$size['width'];
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        if ( $this->image_lib->resize())
                        {   
                            if( $size['width'] == 16 && $size['height'] == 16)
                            {
                                rename($originalFileUploadFilePath.$originalFileRawName.'_'.$size['width'].$originalFileExt, FCPATH.'uploads/favicon/'.$size['width'].'x'.$size['height'].'/'.$fileNameForResizedImage);
                            }else{
                                rename($originalFileUploadFilePath.$originalFileRawName.'_'.$size['width'].$originalFileExt, FCPATH.'uploads/profile_pictures/'.$size['width'].'x'.$size['height'].'/'.$fileNameForResizedImage);
                            }
                        }
                    }
                    $this->aauth->set_user_var('profilePicture', $fileNameForResizedImage);
                } 
            }
            if( $_FILES AND $_FILES['profileHeaderImage']['name'] )
            {
                $profileheaderimage = $this->input->post('profileHeaderImage');

                $this->load->library('image_lib');

                // Image upload configs - change this stuff later
                $config['upload_path'] = FCPATH.'_tmp-folder/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 1024 * 5; // 5MB
                $config['max_width']  = '2048';
                $config['max_height']  = '2048';
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("profileHeaderImage"))
                {
                    $errors[] = array("message" => "Upload failed.");
                }
                else
                {   
                    // Variables used later when resizing an image
                    $originalFileUploadPath = $this->upload->data()['full_path'];
                    $originalFileUploadFilePath = $this->upload->data()['file_path'];
                    $originalFileRawName = $this->upload->data()['raw_name'];
                    $originalFileExt = $this->upload->data()['file_ext'];
                    
                    // Convert the image to a grayscaled version
                    $this->load->helper('image_helper');
                    $im = imagecreatefromfile($originalFileUploadPath);
                    if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
                    {
                        $response["message"] = "Profile information saved.";
                        imagejpeg($im, $originalFileUploadPath);
                    }
                    else
                    {
                        $errors[] = array("message" => "Conversion to grayscale failed.");
                    }
                    imagedestroy($im);

                    // resize the original image to various sizes
                    $config['image_library'] = 'GD2';
                    $config['source_image'] = $originalFileUploadPath;
                    $sizes = array(
                        array(
                            'width'     => 1170,
                            'height'    => 500
                        )
                    );
                    $fileNameForResizedImage = md5(microtime()).'.jpg';
                    foreach ($sizes as $size) {
                        $config['width']    = $size['width'];
                        $config['height']   = $size['height'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = FALSE;
                        $config['thumb_marker'] = '_'.$size['width'];
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        if ( $this->image_lib->resize())
                        {   
                            rename($originalFileUploadFilePath.$originalFileRawName.'_'.$size['width'].$originalFileExt, FCPATH.'uploads/header_images/'.$size['width'].'x'.$size['height'].'/'.$fileNameForResizedImage);
                        }
                    }
                    $this->aauth->set_user_var('headerImage', $fileNameForResizedImage);
                }
            }
            if( $this->input->post('profileTextColour') )
            {
                $profiletextcolour = $this->input->post('profileTextColour');
                $this->aauth->set_user_var('profileTextColour', $profiletextcolour);
            }   
            if( $this->input->post('profileForecolor') )
            {
                $profileforecolor = $this->input->post('profileForecolor');
                $this->aauth->set_user_var('profileForecolor', $profileforecolor);
            }                   
                            
            $response["message"] = "Profile information saved.";
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function addEducation_post(){
        //echo 'addEducation';

        $response = array(); 
        $errors = array();

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        $educationList = json_decode($this->aauth->get_user_var('educationList'), true);

        if( $this->aauth->is_loggedin() )
        {   
            $placename = null;
            $startYear = null;
            $endyear = null;

            if( $this->input->post('placeName') )
            {
                $placename = $this->input->post('placeName');
            }
            if( $this->input->post('startYear') )
            {
                $startyear = $this->input->post('startYear');
            }
            if( $this->input->post('endYear') )
            {
                $endyear = $this->input->post('endYear');
            }

            if(!$educationList){ $educationList = array(); }

            if(count($educationList) <= 20)
            {
                $educationList[] = array(
                    'id' => md5(microtime()),
                    'placeName' => $placename,
                    'startYear' => $startyear,
                    'endYear' => $endyear
                );

                usort(
                    $educationList, 
                    function($a, $b) {
                        if ($a['startYear'] == $b['startYear']) return 0;
                        return ($a['startYear'] < $b['startYear']) ? -1 : 1;
                    }
                );

                $this->aauth->set_user_var('educationList', json_encode($educationList));
                $response["message"] = "Education place added.";
            }else{
                $errors[] = array("message" => "You can only add up to 20 places of education. Please go back and delete some.");
            }   
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["educationList"] = $educationList;
        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function deleteEducation_post()
    {
        //echo 'deleteEducation';

        $response = array(); 
        $errors = array();

        $educationList = json_decode($this->aauth->get_user_var('educationList'), true);

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        if( $this->aauth->is_loggedin() )
        {   
            $educationid = null;

            if( $this->input->post('educationId') )
            {
                $educationid = $this->input->post('educationId');
            }

            for ($i=0; $i < count($educationList); $i++) { 
                if($educationList[$i]['id'] == $educationid){
                    unset($educationList[$i]);
                    break;
                }
            }
            $educationList = array_values($educationList);

            $count = count($educationList);
            $this->aauth->set_user_var('educationList', json_encode($educationList));
            $response["message"] = "Education place removed. You can add ".(20 - count($educationList))." more education place(s)."; 
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["educationList"] = $educationList;
        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function addSkill_post(){
        //echo 'addSkill';

        $response = array(); 
        $errors = array();

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        $skillsList = json_decode($this->aauth->get_user_var('skillsList'), true);

        if( $this->aauth->is_loggedin() )
        {   
            $skillname = null;
            $skillpercentage = null;

            if( $this->input->post('skillName') )
            {
                $skillname = $this->input->post('skillName');
            }
            if( $this->input->post('skillPercentage') )
            {
                $skillpercentage = $this->input->post('skillPercentage');
            }

            if(!$skillsList){ $skillsList = array(); }

            if(count($skillsList) <= 50)
            {
                $skillsList[] = array(
                    'id' => md5(microtime()),
                    'skillName' => $skillname,
                    'skillPercentage' => $skillpercentage
                );

                usort(
                    $skillsList, 
                    function($a, $b) {
                        if ($a['skillPercentage'] == $b['skillPercentage']) return 0;
                        return ($a['skillPercentage'] < $b['skillPercentage']) ? -1 : 1;
                    }
                );

                $this->aauth->set_user_var('skillsList', json_encode($skillsList));
                $response["message"] = "Skill added. You have ".(50 - count($skillsList))." slot(s) left.";
            }else{
                $errors[] = array("message" => "You can only add up to 50 skills. Please go back and delete some.");
            }   
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["skillsList"] = $skillsList;
        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function deleteSkill_post()
    {
        //echo 'deleteSkill';

        $response = array(); 
        $errors = array();

        $skillsList = json_decode($this->aauth->get_user_var('skillsList'), true);

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        if( $this->aauth->is_loggedin() )
        {   
            $skillid = null;

            if( $this->input->post('skillId') )
            {
                $skillid = $this->input->post('skillId');
            }

            for ($i=0; $i < count($skillsList); $i++) { 
                if($skillsList[$i]['id'] == $skillid){
                    unset($skillsList[$i]);
                    break;
                }
            }
            $skillsList = array_values($skillsList);

            $count = count($skillsList);
            $this->aauth->set_user_var('skillsList', json_encode($skillsList));
            $response["message"] = "Skill removed. You can add ".(50 - count($skillsList))." more skill(s)."; 
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["skillsList"] = $skillsList;
        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function addPortfolioItem_post(){
        //echo 'addPortfolioItem';

        $response = array(); 
        $errors = array();

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        $portfolioList = json_decode($this->aauth->get_user_var('portfolioList'), true);

        if( $this->aauth->is_loggedin() )
        {   
            $itemname = null;
            $itemurl = null;
            $itemimage = null;
            $itemdescription = null;

            $fileNameForResizedImage = null;

            if( $this->input->post('itemName') )
            {
                $itemname = $this->input->post('itemName');
            }
            if( $this->input->post('itemUrl') )
            {
                $itemurl = $this->input->post('itemUrl');
            }
            if( $this->input->post('itemImage') )
            {
                $itemimage = $this->input->post('itemImage');
            }
            $this->load->library('image_lib');

            // Image upload configs - change this stuff later
            $config['upload_path'] = FCPATH.'_tmp-folder/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 1024 * 5; // 5MB
            $config['max_width']  = '2048';
            $config['max_height']  = '2048';
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("itemImage"))
            {
                $errors[] = array("message" => "Upload failed.");
            }
            else
            {   
                // Variables used later when resizing an image
                $originalFileUploadPath = $this->upload->data()['full_path'];
                $originalFileUploadFilePath = $this->upload->data()['file_path'];
                $originalFileRawName = $this->upload->data()['raw_name'];
                $originalFileExt = $this->upload->data()['file_ext'];
                
                // resize the original image to various sizes
                $config['image_library'] = 'GD2';
                $config['source_image'] = $originalFileUploadPath;
                $sizes = array(
                    array(
                        'width'     => 540,
                        'height'    => 340
                    )
                );
                $fileNameForResizedImage = md5(microtime()).'.jpg';
                foreach ($sizes as $size) {
                    $config['width']    = $size['width'];
                    $config['height']   = $size['height'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = FALSE;
                    $config['thumb_marker'] = '_'.$size['width'];
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    if ( $this->image_lib->resize())
                    {   
                        rename($originalFileUploadFilePath.$originalFileRawName.'_'.$size['width'].$originalFileExt, FCPATH.'uploads/portfolio/'.$size['width'].'x'.$size['height'].'/'.$fileNameForResizedImage);
                    }
                }
            }
            if( $this->input->post('itemDescription') )
            {
                $itemdescription = $this->input->post('itemDescription');
            }

            if(!$portfolioList){ $portfolioList = array(); }

            if(count($portfolioList) <= 50)
            {
                $portfolioList[] = array(
                    'id' => md5(microtime()),
                    'itemName' => $itemname,
                    'itemUrl' => $itemurl,
                    'itemImage' => $fileNameForResizedImage,
                    'itemDescription' => $itemdescription
                );

                usort(
                    $portfolioList, 
                    function($a, $b) {
                        if ($a['itemName'] == $b['itemName']) return 0;
                        return ($a['itemName'] < $b['itemName']) ? -1 : 1;
                    }
                );

                $this->aauth->set_user_var('portfolioList', json_encode($portfolioList));
                $response["message"] = "Portfolio item added.";
            }else{
                $errors[] = array("message" => "You can only add up to 50 portfolio items.  Please go back and delete some.");
            }   
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["portfolioList"] = $portfolioList;
        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function addSocialMedia_post(){
        //echo 'addPortfolioItem';

        $response = array(); 
        $errors = array();

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        $socialMediaList = json_decode($this->aauth->get_user_var('socialMediaList'), true);

        if( $this->aauth->is_loggedin() )
        {   
            $socialmedianame = null;
            $socialmediaid = null;

            if( $this->input->post('socialMediaName') )
            {
                $socialmedianame = $this->input->post('socialMediaName');
            }
            if( $this->input->post('socialMediaID') )
            {
                $socialmediaid = $this->input->post('socialMediaID');
            }

            if(!$socialMediaList){ $socialMediaList = array(); }

            if(count($socialMediaList) <= 20)
            {
                $socialMediaList[] = array(
                    'id' => md5(microtime()),
                    'socialMediaName' => $socialmedianame,
                    'socialMediaID' => $socialmediaid,
                );

                /*
                usort(
                    $socialMediaList, 
                    function($a, $b) {
                        if ($a['itemName'] == $b['itemName']) return 0;
                        return ($a['itemName'] < $b['itemName']) ? -1 : 1;
                    }
                );
                */

                $this->aauth->set_user_var('socialMediaList', json_encode($socialMediaList));
                $response["message"] = "Social Media added.";
            }else{
                $errors[] = array("message" => "You can only add up to 50 Social Media profile. Please go back and delete some.");
            }   
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["socialMediaList"] = $socialMediaList;
        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function deletePortfolioItem_post()
    {
        //echo 'deletePortfolioItem';

        $response = array(); 
        $errors = array();

        $portfolioList = json_decode($this->aauth->get_user_var('portfolioList'), true);

        $response["meta"] = array(
            'newToken' => array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            )
        );

        if( $this->aauth->is_loggedin() )
        {   
            $portfolioitemid = null;

            if( $this->input->post('portfolioItemId') )
            {
                $portfolioitemid = $this->input->post('portfolioItemId');
            }

            for ($i=0; $i < count($portfolioList); $i++) { 
                if($portfolioList[$i]['id'] == $portfolioitemid){
                    unset($portfolioList[$i]);
                    break;
                }
            }
            $portfolioList = array_values($portfolioList);

            $count = count($portfolioList);
            $this->aauth->set_user_var('portfolioList', json_encode($portfolioList));
            $response["message"] = "Portfolio Item removed. You can add ".(50 - count($portfolioList))." more portfolio item(s)."; 
        }else{
            $this->response(
                "Not authorised",
                REST_Controller::HTTP_UNAUTHORIZED
            );
            return false;
        }

        $response["portfolioList"] = $portfolioList;
        $response["errors"] = $errors;
        $this->response(
            json_encode($response),
            REST_Controller::HTTP_OK
        );
    }

    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
        ];

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retreival.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $user = $value;
                }
            }
        }

        if (!empty($user))
        {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function users_post()
    {
        // $this->some_model->update_user( ... );
        $message = [
            'id' => 100, // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class MY_Form_validation extends CI_Form_validation {

        public function __construct() {
            parent::__construct();
        }

        /**
         * Return all validation errors
         *
         * @access  public
         * @return  array
         */
         function get_all_errors() {

            $error_array = array();

            if (count($this->_error_array) > 0) {

                foreach ($this->_error_array as $k => $v) {

                    $error_array[$k] = $v;

                }

                return $error_array;

            }

            return false;

        }


        /** Custom rules defined, instead of using callbacks in the form validator. */
        /**
         * Colour Hex
         *
         * #ffffff
         *
         * @access    public
         * @param    string
         * @return    bool
         */
        function hex_colour($hex) {
            return (bool)preg_match("/#[a-fA-F0-9]{6}/", $hex);
        }
    }

?>
<?php
/**
 * Class Api Whm
 * PHP Version >5.6
 *
 * @see https://github.com/ngocminhvn/class-api-whm The GitHub project
 *
 * @author    Trinh Ngoc Minh <trinhngocminhads@gmail.com>
 * @copyright 2022 - Minh
 * @note      This program is distributed in the hope that it will be useful
 * GOOD LUCK
 */
    class cpanel {
        public $username_whm;
        public $password_whm;
        public $ipaddress_whm;

        function __construct($username_whm,$password_whm,$ipaddress_whm)
        {
            $this->username = $username_whm;
            $this->password = $password_whm;
            $this->ipaddress = $ipaddress_whm;
        }
        // Curl
        function cURL($query)
        {
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $header[0] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password) . "\n\r";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
            curl_setopt($curl, CURLOPT_URL, 'https://'.$this->ipaddress.':2087/json-api/'.$query); 
            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }
        // Khóa acc
        // https://api.docs.cpanel.net/openapi/whm/operation/suspendacct/
        function suspendacc($suspendacct)
        {
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $header[0] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password) . "\n\r";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
            curl_setopt($curl, CURLOPT_URL, 'https://'.$this->ipaddress.':2087/json-api/suspendacct?api.version=1&user='.$suspendacct.'&reason=Nonpayment&leave-ftp-accts-enabled=0'); 
            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }
        // Unlock acc
        // https://api.docs.cpanel.net/openapi/whm/operation/unsuspendacct/
        function unsuspendacc($unsuspendacct)
        {
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $header[0] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password) . "\n\r";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
            curl_setopt($curl, CURLOPT_URL, 'https://'.$this->ipaddress.':2087/json-api/unsuspendacct?api.version=1&user='.$unsuspendacct.''); 
            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }
        // Tạo acc 
        // https://api.docs.cpanel.net/openapi/whm/operation/createacct/
        function createacc($username,$domain,$password,$plan)
        {
            $data = [
                'username'     => $username,
                'domain'       => $domain,
                'password'     => $password,
                'plan'         => $plan,
                'contactemail' => 'trinhngocminhads@gmail.com',
                'reseller'     => 0,
            ];
            $query = "https://".$this->ipaddress.":2087/json-api/createacct?api.version=1";
            foreach ($data as $k => $v) {
                $query .= '&' . $k . '=' . $v;
            }
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $header[0] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password) . "\n\r";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_URL, $query);
            $result = curl_exec($curl);
            curl_close($curl);    
            return $result;
        }
        // Xóa acc
        // https://api.docs.cpanel.net/openapi/whm/operation/removeacct/
        function removeacc($removeacct)
        {
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $header[0] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password) . "\n\r";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
            curl_setopt($curl, CURLOPT_URL, 'https://'.$this->ipaddress.':2087/json-api/removeacct?api.version=1&username='.$removeacct.''); 
            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }
        // Lấy danh sách plan
        // https://api.docs.cpanel.net/openapi/whm/operation/listpkgs/
        function listpkgs()
        {
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $header[0] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password) . "\n\r";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
            curl_setopt($curl, CURLOPT_URL, 'https://'.$this->ipaddress.':2087/json-api/listpkgs?api.version=1&want=viewable'); 
            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
        }
    }
        function changepass($acc,$new_password)
        {
            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $header[0] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password) . "\n\r";
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
            curl_setopt($curl, CURLOPT_URL, 'https://'.$this->ipaddress.':2087/json-api/passwd?api.version=1&user='.$acc.'&password='.$new_password); 
            $result = curl_exec($curl);
            curl_close($curl);
            return $result;
       }          
    }
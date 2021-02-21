<?php

class Role  {

        private $role_id;
        private $role_type;

        public function getRole_id()
        {
                return $this->role_id;
        }

        public function getRole_type()
        {
                return $this->role_type;
        }

        /**
         * Set the value of role_id
         *
         * @return  self
         */ 
        public function setRole_id($role_id)
        {
                $this->role_id = $role_id;

                return $this;
        }

        /**
         * Set the value of role_type
         *
         * @return  self
         */ 
        public function setRole_type($role_type)
        {
                $this->role_type = $role_type;

                return $this;
        }

}

?>
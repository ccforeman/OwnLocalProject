<?php

	class Business {
		private $id;
		private $uuid;
		private $name;
		private $address;
		private $address2;
		private $city;
		private $state;
		private $zip;
		private $country;
		private $phone;
		private $website;
		private $created_at;
		
		
		public function getId() {
			return $this->id;
		}
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function getUuid() {
			return $this->uuid;
		}
		
		public function setUuid($uuid) {
			$this->uuid = $uuid;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function setName($name) {
			$this->name = $name;
		}
		
		public function getAddress() {
			return $this->address;
		}
		
		public function setAddress($address) {
			$this->address = $address;
		}
		
		public function getAddress2() {
			return $this->address2;
		}
		
		public function setAddress2($address2) {
			$this->address2 = $address2;
		}
		
		public function getCity() {
			return $this->city;
		}
		
		public function setCity($city) {
			$this->city = $city;
		}
		
		public function getState() {
			return $this->state;
		}
		
		public function setState($state) {
			$this->state = $state;
		}
		
		public function getZip() {
			return $this->zip;
		}
		
		public function setZip($zip) {
			$this->zip = $zip;
		}
		
		public function getCountry() {
			return $this->country;
		}
		
		public function setCountry($country) {
			$this->country = $country;
		}
		
		public function getPhone() {
			return $this->phone;
		}
		
		public function setPhone($phone) {
			$this->phone = $phone;
		}
		
		public function getWebsite() {
			return $this->website;
		}
		
		public function setWebsite($website) {
			$this->website = $website;
		}
		
		public function getCreated_at() {
			return $this->created_at;
		}
		
		public function setCreated_at($created_at) {
			$this->created_at = $created_at;
		}
		
	}
?>
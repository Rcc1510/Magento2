<?php 
namespace Kitchen\CustomApi\Api;
 
 
interface PostManagementInterface {
    
	
	// public function getPost();
	/**
     * POST for Post api
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $birthdate
     * @param string $address
     * @return array
     */
    public function saveData($firstname, $lastname, $email, $birthdate, $address);

    /**
     * @return string
     */
    public function getUserData();

    /**
     * @param int $id
     * @return bool true on success
     */
    public function getDelete($id);
    /**
     * POST for Post api
     * @param int $id
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $birthdate
     * @param string $address
     * @return array
     */
    public function updateData($id, $firstname, $lastname, $email, $birthdate, $address);

}
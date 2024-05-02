<?php 
namespace Kitchen\CustomApi\Model;


use Kitchen\CustomApi\Api\PostManagementInterface;
use Kitchen\Category\Model\CustomerFactory;


class PostManagement implements PostManagementInterface
{
    private $CustomerFactory;
    private $quote;
    // protected $response = ['success' => false];

    public function __construct(
		CustomerFactory $CustomerFactory
		)
    {
        $this->CustomerFactory = $CustomerFactory;
    }

    /** * POST for Post api *  * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $birthdate
     * @param string $address* 
     * @return array 
     * */
    public function saveData($firstname, $lastname, $email, $birthdate, $address)
    {
        $insertData = $this->CustomerFactory->create();
        try {
            $insertData->setFirstName($firstname)
            ->setLastName($lastname)
            ->setEmail($email)
            ->setBirthDate($birthdate)
            ->setAddress($address);
            $insertData->save();
            $response = ['success' => true, 'message' => 'Data saved successfully'];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    /** * @return string */
    public function getUserData()
    {
        try {
            $data = $this->CustomerFactory->create()->getCollection()->getData();
            // return $data;
			return ['success' => true, 'data' => $data];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /** * @param int $id * @return bool true on success */
    public function getDelete($id)
    {
        try {
            if ($id) {
                $data = $this->CustomerFactory->create()->load($id);
                $data->delete();
                return "success";
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return "false";
    }
    public function updateData($id, $firstname, $lastname, $email, $birthdate, $address)
    {
        try {
            if ($id) {
                $data = $this->CustomerFactory->create()->load($id);
                $data->setFirstName($firstname)
                ->setLastName($lastname)
                ->setEmail($email)
                ->setBirthDate($birthdate)
                ->setAddress($address);
                $data->save();
                $response = ['success' => true, 'data' => 'successfully updated'];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'data' => $e->getMessage()];
        }
        return $response;
    }
}
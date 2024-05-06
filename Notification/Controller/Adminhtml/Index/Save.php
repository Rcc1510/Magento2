<?php

namespace Kitchen\Notification\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Kitchen\Notification\Model\NoticeFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var noticeFactory
     */ 
    private $noticeFactory;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @param Action\Context $context
     * @param NoticeFactory $noticeFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */

    public function __construct(
        Action\Context $context,
        NoticeFactory $noticeFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->noticeFactory = $noticeFactory;
        $this->filesystem = $filesystem;
        $this->storeManager = $storeManager;
    }
    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        // echo "<pre>";
        // print_r($data);
        // die;
        
        if ($data) {

            try {
               
                if (!empty($data['notification_id'])) {
                   
                    $model = $this->noticeFactory->create()->load($data['notification_id']);
                } else {
                   
                    $model = $this->noticeFactory->create();
                }

                $model->setTitle($data['title']);
                $model->setDescription($data['description']);
                $model->setStatus($data['status']);
                $model->setCustomerGroup($data['customer_group'][0]);

                $model->save();
                $this->messageManager->addSuccessMessage(__('data has been saved.'));
            }
            
            catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the user data.'));
            }
     
            // Redirect back to the customer page
            return $resultRedirect->setPath('notice1/index/index');
        }
     
        // If no data is available, redirect back to the customer page
        return $resultRedirect->setPath('notice1/index/index');
    }
} 

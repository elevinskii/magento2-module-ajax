<?php
namespace IdealCode\Ajax\Plugin\Controller;

class AjaxRequest
{
    /** @var \Magento\Framework\Message\ManagerInterface */
    protected $_messageManager;

    /** @var \Magento\Framework\Controller\Result\JsonFactory */
    protected $_jsonFactory;

    /**
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        $this->_messageManager = $messageManager;
        $this->_jsonFactory = $jsonFactory;
    }

    /**
     * @param \Magento\Framework\App\Action\Action $subject
     * @param mixed $result
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function afterExecute(
        \Magento\Framework\App\Action\Action $subject,
        $result
    ) {
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $subject->getRequest();
        if($request->isAjax()) {
            // Clear messages
            $this->_messageManager->getMessages(true);

            return $this->_jsonFactory->create()->setData([
                'success' => true
            ]);
        }

        return $result;
    }
}

<?php
/**
 * SAML Extension for Magento2 which adds support to prevent Replay Attacks
 *
 * @package     Pitbulk_Antireplay
 * @copyright   Copyright (c) 2023 Sixto Martin Garcia (http://saml.info)
 * @license     Commercial
 */

namespace Pitbulk\Antireplay\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\ManagerInterface;

use Pitbulk\Antireplay\Model\AssertionFactory;
use Pitbulk\Antireplay\Model\AssertionRepository;
use Pitbulk\SAML2\Helper\Data;

use OneLogin\Saml2\Utils;

use Psr\Log\LoggerInterface;


class PreventReplayAttacksObserver implements ObserverInterface
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @var AssertionFactory
     */
    private $_assertionFactory;

    /**
     * @var AssertionRepository
     */
    private $_assertionRepository;

    /**
     * Constructor to inject objects
     *
     * @param Data $helper;
     * @param LoggerInterface $logger
     * @param ManagerInterface $messageManager
     * @param AssertionFactory $assertionFactory
     * @param AssertionRepository $assertionRepository
     */
    public function __construct(
        Data $helper,
        LoggerInterface $logger,
        ManagerInterface $messageManager,
        AssertionFactory $assertionFactory,
        AssertionRepository $assertionRepository
    ) {
        $this->helper = $helper;
        $this->logger = $logger;
        $this->messageManager = $messageManager;
        $this->_assertionFactory = $assertionFactory;
        $this->_assertionRepository = $assertionRepository;
    }

    /**
     * Override execute method
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        $assertionId = $event->getData('assertion_id');

        if (!empty($assertionId)) {
            // If the Assertion ID already exists, raise an Exception
            if ($this->_assertionRepository->checkAssertionId($assertionId)) {
                $errorMsg = "The Assertion ID: ".$assertionId. " was already processed, rejecting to avoid replay attacks";
                $this->messageManager->addError($errorMsg);
                $this->logger->error($errorMsg);
                $redirectTo = $this->helper->getUrl('/');
                Utils::redirect($redirectTo);
            } else {
                // Register the Assertion ID to prevent reuse
                $assertion = $this->_assertionFactory->create();
                $assertion->setAssertionId($assertionId);
                $this->_assertionRepository->save($assertion);
                $this->logger->debug("Assertion ". $assertionId ." validated and processed.");
            }
        }
    }
}

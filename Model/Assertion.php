<?php

namespace Pitbulk\Antireplay\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \Pitbulk\Antireplay\Api\Data\AssertionInterface;

/**
 * Class File
 * @package Pitbulk\Antireplay\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Assertion extends AbstractModel implements AssertionInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'saml2_assertion';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Pitbulk\Antireplay\Model\ResourceModel\Assertion');
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get Assertion Id
     *
     * @return string|null
     */
    public function getAssertionId()
    {
        return $this->getData(self::ASSERTION_ID);
    }

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Return identities
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set Assertion ID
     *
     * @param string $assertionId
     * @return $this
     */
    public function setAssertionId($assertionId)
    {
        return $this->setData(self::ASSERTION_ID, $assertionId);
    }

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}

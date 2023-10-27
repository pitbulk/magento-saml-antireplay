<?php

namespace Pitbulk\Antireplay\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Assertion extends AbstractDb
{
    /**
     * Assertion Abstract Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('saml2_assertion', 'id');
    }

    /**
     * Get assertion by AssertionId
     *
     * @param Pitbulk\Antireplay\Model\Assertion $assertion
     * @param string $assertionId
     * @return int
     */
    public function loadByAssertionId(\Pitbulk\Antireplay\Model\Assertion $assertion, $assertionId)
    {
        $connection = $this->getConnection();
        $bind = ['assertion_id' => $assertionId];
        $select = $connection->select()->from(
            $this->getTable('saml2_assertion'),
            ['id']
        )->where(
            'assertion_id = :assertion_id'
        );
        $assertionInternalId = $connection->fetchOne($select, $bind);

        if ($assertionInternalId) {
            $this->load($assertion, $assertionInternalId);
        } else {
            $assertion->setData([]);
        }

        return $this;
    }

    /**
     * @return int Number of entries removed
     */
    public function deleteExpired()
    {
        $connection = $this->getConnection();
        $bind = ['assertion_id' => $assertionId];
        $select = $connection->select()->from(
            $this->getTable('saml2_assertion'),
            ['id']
        )->where(
            'assertion_id = :assertion_id'
        );
        $assertionInternalId = $connection->fetchOne($select, $bind);

        if ($assertionInternalId) {
            $this->load($assertion, $assertionInternalId);
        } else {
            $assertion->setData([]);
        }

        return $this;
    }
}

<?php

namespace Pitbulk\Antireplay\Model\ResourceModel\Assertion;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    /**
     * Define Collection
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
          'Pitbulk\Antireplay\Model\Assertion',
          'Pitbulk\Antireplay\Model\ResourceModel\Assertion'
        );
    }
}

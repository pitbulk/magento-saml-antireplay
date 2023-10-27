<?php

namespace Pitbulk\Antireplay\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Pitbulk\Antireplay\Api\Data\AssertionInterface;

interface AssertionRepositoryInterface
{
  /**
       * @param AssertionInterface $assertion
       * @return AssertionInterface
       */
      public function save(AssertionInterface $assertion);

      /**
       * @param AssertionInterface $assertion
       * @return AssertionInterface
       */
      public function delete(AssertionInterface $assertion);

      /**
       * @param $id
       * @return mixed
       */
      public function getById($id);

      /**
       * @param $assertionId
       * @return mixed
       */
      public function getByAssertionId($assertionId);

      /**
       * @param $id
       * @return mixed
       */
      public function deleteById($id);

      /**
       * @param $assertionId
       * @return mixed
       */
      public function deleteByAssertionId($assertionId);


      /**
       * @return int Number of entries removed
       */
      public function deleteExpired();
}

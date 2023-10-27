<?php

namespace Pitbulk\Antireplay\Model;

use Pitbulk\Antireplay\Api\AssertionRepositoryInterface;
use Pitbulk\Antireplay\Api\Data\AssertionInterface;
use Pitbulk\Antireplay\Model\ResourceModel\Assertion;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;


class AssertionRepository implements AssertionRepositoryInterface
{
    /**
    * @var AssertionFactory
    */
    private $assertionFactory;

   /**
    * @var Assertion
    */
    private $assertionResource;

    public function __construct(
        AssertionFactory $assertionFactory,
        Assertion $assertionResource
    )
    {
        $this->assertionFactory = $assertionFactory;
        $this->assertionResource = $assertionResource;
    }

    /**
     * @param AssertionInterface $assertion
     * @return AssertionInterface
     */
    public function save(AssertionInterface $assertion)
    {
        $this->assertionResource->save($assertion);
        return $assertion;
    }

    /**
     * @param AssertionInterface $assertion
     * @return AssertionInterface
     */
    public function delete(AssertionInterface $assertion)
    {
      try {
          $this->assertionResource->delete($assertion);
      } catch (\Exception $exception) {
          throw new CouldNotDeleteException(
              __('Could not delete the entry: %1', $exception->getMessage())
          );
      }

      return true;
    }

    /**
     * @param int $id
     * @return Assertionnterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $assertion = $this->assertionFactory->create();
        $this->assertionResource->load($assertion, $id);
        if (! $assertion->getId()) {
            throw new NoSuchEntityException(__('Unable to find Assertion with internal ID "%1"', $id));
        }
        return $assertion;
    }

    /**
     * @param string $assertion_id
     * @return Assertionnterface
     * @throws NoSuchEntityException
     */
    public function getByAssertionId($assertion_id)
    {
      $assertion = $this->assertionFactory->create();
      $this->assertionResource->loadByAssertionId($assertion, $assertion_id);
      if (! $assertion->getId()) {
          throw new NoSuchEntityException(__('Unable to find Assertion ID "%1"', $id));
      }
      return $assertion;
    }

    /**
     * @param string $assertion_id
     * @return Assertionnterface
     * @throws NoSuchEntityException
     */
    public function checkAssertionId($assertion_id)
    {
      $assertion = $this->assertionFactory->create();
      $this->assertionResource->loadByAssertionId($assertion, $assertion_id);
      if (! $assertion->getId()) {
          return false;
      }
      return true;
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteById($id)
    {
        $assertion = $this->getById($id);
        $assertion->delete();
    }

    /**
     * @param string $assertionId
     * @return void
     */
    public function deleteByAssertionId($assertionId)
    {
        $assertion = $this->getByAssertionId($assertionId);
        $assertion->delete();
    }

    /**
     * @return int Number of entries removed
     */
    public function deleteExpired()
    {
        return $this->assertionResource->deleteExpired();
    }
}

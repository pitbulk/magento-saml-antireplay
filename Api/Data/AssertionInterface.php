<?php

namespace Pitbulk\Antireplay\Api\Data;

interface AssertionInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID                  	= 'id';
    const ASSERTION_ID          = 'assertion_id';
    const CREATED_AT            = 'created_at';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();
    /**
     * Get Assertion ID
     *
     * @return string|null
     */
    public function getAssertionId();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set ID
     *
     * @param int|null $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set Assertion ID
     *
     * @param string $assertion_id
     * @return $this
     */
    public function setAssertionId($assertionId);

    /**
     * Set Crated At
     *
     * @param int $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);
}

<?php
/**
 * SAML Extension for Magento2 which adds support to prevent Replay Attacks
 *
 * @package     Pitbulk_Antireplay
 * @copyright   Copyright (c) 2023 Sixto Martin Garcia (http://saml.info)
 * @license     Commercial
 */

use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Pitbulk_Antireplay',
    __DIR__
);


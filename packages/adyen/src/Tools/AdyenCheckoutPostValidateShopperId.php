<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Validates shopper Id.
 *
 * Executes the official Adyen checkout API operation post-validateShopperId.
 */
class AdyenCheckoutPostValidateShopperId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_validate_shopper_id';
}

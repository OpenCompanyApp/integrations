<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create originKey values for domains.
 *
 * Executes the official Adyen checkout API operation post-originKeys.
 */
class AdyenCheckoutPostOriginKeys extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_origin_keys';
}

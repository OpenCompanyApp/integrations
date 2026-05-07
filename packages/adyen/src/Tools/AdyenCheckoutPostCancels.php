<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Cancel an authorised payment.
 *
 * Executes the official Adyen checkout API operation post-cancels.
 */
class AdyenCheckoutPostCancels extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_cancels';
}

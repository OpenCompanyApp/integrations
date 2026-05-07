<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Forward stored payment details.
 *
 * Executes the official Adyen checkout API operation post-forward.
 */
class AdyenCheckoutPostForward extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_forward';
}

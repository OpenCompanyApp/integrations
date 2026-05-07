<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a token to store payment details.
 *
 * Executes the official Adyen checkout API operation post-storedPaymentMethods.
 */
class AdyenCheckoutPostStoredPaymentMethods extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_stored_payment_methods';
}

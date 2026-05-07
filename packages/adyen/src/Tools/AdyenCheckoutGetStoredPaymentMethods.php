<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get tokens for stored payment details.
 *
 * Executes the official Adyen checkout API operation get-storedPaymentMethods.
 */
class AdyenCheckoutGetStoredPaymentMethods extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_get_stored_payment_methods';
}

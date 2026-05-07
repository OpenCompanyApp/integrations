<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of available payment methods.
 *
 * Executes the official Adyen checkout API operation post-paymentMethods.
 */
class AdyenCheckoutPostPaymentMethods extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payment_methods';
}

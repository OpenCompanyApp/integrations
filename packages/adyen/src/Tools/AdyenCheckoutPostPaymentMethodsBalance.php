<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get the balance of a gift card.
 *
 * Executes the official Adyen checkout API operation post-paymentMethods-balance.
 */
class AdyenCheckoutPostPaymentMethodsBalance extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payment_methods_balance';
}

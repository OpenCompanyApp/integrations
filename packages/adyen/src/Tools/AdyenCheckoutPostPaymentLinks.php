<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a payment link.
 *
 * Executes the official Adyen checkout API operation post-paymentLinks.
 */
class AdyenCheckoutPostPaymentLinks extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_payment_links';
}

<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Updates the order for PayPal Express Checkout.
 *
 * Executes the official Adyen checkout API operation post-paypal-updateOrder.
 */
class AdyenCheckoutPostPaypalUpdateOrder extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_paypal_update_order';
}

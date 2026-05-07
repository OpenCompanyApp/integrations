<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create an order.
 *
 * Executes the official Adyen checkout API operation post-orders.
 */
class AdyenCheckoutPostOrders extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_orders';
}

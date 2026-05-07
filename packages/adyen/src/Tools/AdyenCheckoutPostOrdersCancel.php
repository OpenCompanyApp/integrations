<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Cancel an order.
 *
 * Executes the official Adyen checkout API operation post-orders-cancel.
 */
class AdyenCheckoutPostOrdersCancel extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_checkout_post_orders_cancel';
}

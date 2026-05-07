<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Cancel an order.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-terminalOrders-orderId-cancel.
 */
class AdyenManagementPostMerchantsMerchantIdTerminalOrdersOrderIdCancel extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_terminal_orders_order_id_cancel';
}

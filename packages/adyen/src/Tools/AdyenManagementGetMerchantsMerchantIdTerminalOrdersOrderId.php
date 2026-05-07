<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get an order.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-terminalOrders-orderId.
 */
class AdyenManagementGetMerchantsMerchantIdTerminalOrdersOrderId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_terminal_orders_order_id';
}

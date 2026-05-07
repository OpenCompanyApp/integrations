<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update an order.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-terminalOrders-orderId.
 */
class AdyenManagementPatchMerchantsMerchantIdTerminalOrdersOrderId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_terminal_orders_order_id';
}

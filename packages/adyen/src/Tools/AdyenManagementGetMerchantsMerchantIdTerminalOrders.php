<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of orders.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-terminalOrders.
 */
class AdyenManagementGetMerchantsMerchantIdTerminalOrders extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_terminal_orders';
}

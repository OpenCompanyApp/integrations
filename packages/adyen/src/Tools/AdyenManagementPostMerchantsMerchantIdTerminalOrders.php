<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create an order.
 *
 * Executes the official Adyen management API operation post-merchants-merchantId-terminalOrders.
 */
class AdyenManagementPostMerchantsMerchantIdTerminalOrders extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_merchants_merchant_id_terminal_orders';
}

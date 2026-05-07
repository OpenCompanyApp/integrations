<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of terminal products.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-terminalProducts.
 */
class AdyenManagementGetMerchantsMerchantIdTerminalProducts extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_terminal_products';
}

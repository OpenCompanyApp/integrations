<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of terminal models.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-terminalModels.
 */
class AdyenManagementGetMerchantsMerchantIdTerminalModels extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_terminal_models';
}

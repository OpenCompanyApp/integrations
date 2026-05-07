<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get terminal settings.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-terminalSettings.
 */
class AdyenManagementGetMerchantsMerchantIdTerminalSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_terminal_settings';
}

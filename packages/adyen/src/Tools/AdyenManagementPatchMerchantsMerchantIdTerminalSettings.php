<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update terminal settings.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-terminalSettings.
 */
class AdyenManagementPatchMerchantsMerchantIdTerminalSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_terminal_settings';
}

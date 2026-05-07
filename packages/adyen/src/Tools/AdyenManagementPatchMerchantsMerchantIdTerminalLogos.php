<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update the terminal logo.
 *
 * Executes the official Adyen management API operation patch-merchants-merchantId-terminalLogos.
 */
class AdyenManagementPatchMerchantsMerchantIdTerminalLogos extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_merchants_merchant_id_terminal_logos';
}

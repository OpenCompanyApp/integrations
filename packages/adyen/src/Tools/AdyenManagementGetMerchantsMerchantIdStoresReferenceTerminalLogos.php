<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get the terminal logo.
 *
 * Executes the official Adyen management API operation get-merchants-merchantId-stores-reference-terminalLogos.
 */
class AdyenManagementGetMerchantsMerchantIdStoresReferenceTerminalLogos extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_merchants_merchant_id_stores_reference_terminal_logos';
}

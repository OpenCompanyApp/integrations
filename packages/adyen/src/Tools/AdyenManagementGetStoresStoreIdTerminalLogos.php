<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get the terminal logo.
 *
 * Executes the official Adyen management API operation get-stores-storeId-terminalLogos.
 */
class AdyenManagementGetStoresStoreIdTerminalLogos extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_stores_store_id_terminal_logos';
}

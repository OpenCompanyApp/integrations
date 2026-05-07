<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get terminal settings.
 *
 * Executes the official Adyen management API operation get-stores-storeId-terminalSettings.
 */
class AdyenManagementGetStoresStoreIdTerminalSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_stores_store_id_terminal_settings';
}

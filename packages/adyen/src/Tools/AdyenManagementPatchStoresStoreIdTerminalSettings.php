<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update terminal settings.
 *
 * Executes the official Adyen management API operation patch-stores-storeId-terminalSettings.
 */
class AdyenManagementPatchStoresStoreIdTerminalSettings extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_stores_store_id_terminal_settings';
}

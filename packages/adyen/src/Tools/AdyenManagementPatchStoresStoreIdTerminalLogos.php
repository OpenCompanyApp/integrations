<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update the terminal logo.
 *
 * Executes the official Adyen management API operation patch-stores-storeId-terminalLogos.
 */
class AdyenManagementPatchStoresStoreIdTerminalLogos extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_stores_store_id_terminal_logos';
}

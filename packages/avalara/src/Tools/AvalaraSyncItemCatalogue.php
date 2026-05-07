<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create or update items from a product catalog..
 *
 * Executes the official Avalara AvaTax REST API operation SyncItemCatalogue.
 */
class AvalaraSyncItemCatalogue extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_sync_item_catalogue';
}
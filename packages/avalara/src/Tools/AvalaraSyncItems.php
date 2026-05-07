<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Sync items from a product catalog.
 *
 * Executes the official Avalara AvaTax REST API operation SyncItems.
 */
class AvalaraSyncItems extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_sync_items';
}
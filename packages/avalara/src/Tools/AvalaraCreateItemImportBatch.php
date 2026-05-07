<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create item import batch..
 *
 * Executes the official Avalara AvaTax REST API operation CreateItemImportBatch.
 */
class AvalaraCreateItemImportBatch extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_item_import_batch';
}
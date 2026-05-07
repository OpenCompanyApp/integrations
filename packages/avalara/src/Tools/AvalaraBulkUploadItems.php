<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Bulk upload items from a product catalog.
 *
 * Executes the official Avalara AvaTax REST API operation BulkUploadItems.
 */
class AvalaraBulkUploadItems extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_bulk_upload_items';
}
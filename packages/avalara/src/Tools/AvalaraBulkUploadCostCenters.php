<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Bulk upload cost centers.
 *
 * Executes the official Avalara AvaTax REST API operation BulkUploadCostCenters.
 */
class AvalaraBulkUploadCostCenters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_bulk_upload_cost_centers';
}
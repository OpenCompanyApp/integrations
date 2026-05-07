<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single UPC.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteUPC.
 */
class AvalaraDeleteUPC extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_upc';
}
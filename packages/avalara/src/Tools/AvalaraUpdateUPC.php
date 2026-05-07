<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single UPC.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateUPC.
 */
class AvalaraUpdateUPC extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_upc';
}
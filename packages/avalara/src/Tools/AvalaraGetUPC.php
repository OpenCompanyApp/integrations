<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single UPC.
 *
 * Executes the official Avalara AvaTax REST API operation GetUPC.
 */
class AvalaraGetUPC extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_upc';
}
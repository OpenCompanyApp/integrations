<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new tax code.
 *
 * Executes the official Avalara AvaTax REST API operation CreateTaxCodes.
 */
class AvalaraCreateTaxCodes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_tax_codes';
}
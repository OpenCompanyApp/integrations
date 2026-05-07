<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single tax code.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateTaxCode.
 */
class AvalaraUpdateTaxCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_tax_code';
}
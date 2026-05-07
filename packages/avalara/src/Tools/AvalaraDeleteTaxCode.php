<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single tax code.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteTaxCode.
 */
class AvalaraDeleteTaxCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_tax_code';
}
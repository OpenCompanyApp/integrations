<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single tax code.
 *
 * Executes the official Avalara AvaTax REST API operation GetTaxCode.
 */
class AvalaraGetTaxCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_tax_code';
}
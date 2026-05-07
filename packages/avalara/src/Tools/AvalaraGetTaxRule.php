<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single tax rule.
 *
 * Executes the official Avalara AvaTax REST API operation GetTaxRule.
 */
class AvalaraGetTaxRule extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_tax_rule';
}
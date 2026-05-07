<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single tax rule.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteTaxRule.
 */
class AvalaraDeleteTaxRule extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_tax_rule';
}
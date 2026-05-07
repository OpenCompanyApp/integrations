<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single tax rule.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateTaxRule.
 */
class AvalaraUpdateTaxRule extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_tax_rule';
}
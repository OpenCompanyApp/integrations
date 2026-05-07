<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new tax rule.
 *
 * Executes the official Avalara AvaTax REST API operation CreateTaxRules.
 */
class AvalaraCreateTaxRules extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_tax_rules';
}
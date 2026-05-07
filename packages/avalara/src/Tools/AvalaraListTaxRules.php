<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve tax rules for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxRules.
 */
class AvalaraListTaxRules extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_rules';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all tax rules.
 *
 * Executes the official Avalara AvaTax REST API operation QueryTaxRules.
 */
class AvalaraQueryTaxRules extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_tax_rules';
}
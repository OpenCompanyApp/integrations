<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all tax type mappings based on filter..
 *
 * Executes the official Avalara AvaTax REST API operation QueryTaxTypeMappings.
 */
class AvalaraQueryTaxTypeMappings extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_tax_type_mappings';
}
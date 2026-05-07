<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all tax codes.
 *
 * Executes the official Avalara AvaTax REST API operation QueryTaxCodes.
 */
class AvalaraQueryTaxCodes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_tax_codes';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all vendors for this company.
 *
 * Executes the official Avalara AvaTax REST API operation QueryVendors.
 */
class AvalaraQueryVendors extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_vendors';
}
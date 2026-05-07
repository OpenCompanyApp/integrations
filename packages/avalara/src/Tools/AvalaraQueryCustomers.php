<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all customers for this company.
 *
 * Executes the official Avalara AvaTax REST API operation QueryCustomers.
 */
class AvalaraQueryCustomers extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_customers';
}
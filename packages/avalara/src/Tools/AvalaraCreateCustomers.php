<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create customers for this company.
 *
 * Executes the official Avalara AvaTax REST API operation CreateCustomers.
 */
class AvalaraCreateCustomers extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_customers';
}
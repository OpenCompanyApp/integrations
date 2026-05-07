<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single customer.
 *
 * Executes the official Avalara AvaTax REST API operation GetCustomer.
 */
class AvalaraGetCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_customer';
}
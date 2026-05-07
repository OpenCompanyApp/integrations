<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single customer.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateCustomer.
 */
class AvalaraUpdateCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_customer';
}
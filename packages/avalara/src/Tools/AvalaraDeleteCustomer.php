<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a customer record.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteCustomer.
 */
class AvalaraDeleteCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_customer';
}
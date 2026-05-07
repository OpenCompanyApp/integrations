<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Delete Customer.
 *
 * Executes the official Braintree GraphQL field deleteCustomer.
 */
class BraintreeDeleteCustomer extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_delete_customer';
}

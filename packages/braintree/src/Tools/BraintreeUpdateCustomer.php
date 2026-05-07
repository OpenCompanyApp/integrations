<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Customer.
 *
 * Executes the official Braintree GraphQL field updateCustomer.
 */
class BraintreeUpdateCustomer extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_customer';
}

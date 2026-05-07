<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Customer.
 *
 * Executes the official Braintree GraphQL field createCustomer.
 */
class BraintreeCreateCustomer extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_customer';
}

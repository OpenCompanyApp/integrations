<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search Customers.
 *
 * Executes the official Braintree GraphQL field customers.
 */
class BraintreeSearchCustomers extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_customers';
}

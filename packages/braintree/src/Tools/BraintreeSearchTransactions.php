<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search Transactions.
 *
 * Executes the official Braintree GraphQL field transactions.
 */
class BraintreeSearchTransactions extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_transactions';
}

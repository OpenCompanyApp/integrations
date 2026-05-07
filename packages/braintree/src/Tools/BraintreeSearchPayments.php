<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search Payments.
 *
 * Executes the official Braintree GraphQL field payments.
 */
class BraintreeSearchPayments extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_payments';
}

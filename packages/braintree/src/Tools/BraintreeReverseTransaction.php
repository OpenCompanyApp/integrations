<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Reverse Transaction.
 *
 * Executes the official Braintree GraphQL field reverseTransaction.
 */
class BraintreeReverseTransaction extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_reverse_transaction';
}

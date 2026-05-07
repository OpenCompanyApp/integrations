<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Void Transaction.
 *
 * Executes the official Braintree GraphQL field voidTransaction.
 */
class BraintreeVoidTransaction extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_void_transaction';
}

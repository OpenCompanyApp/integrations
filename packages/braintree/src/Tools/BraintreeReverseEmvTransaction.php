<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Reverse Emv Transaction.
 *
 * Executes the official Braintree GraphQL field reverseEmvTransaction.
 */
class BraintreeReverseEmvTransaction extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_reverse_emv_transaction';
}

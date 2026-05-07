<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Refund Transaction.
 *
 * Executes the official Braintree GraphQL field refundTransaction.
 */
class BraintreeRefundTransaction extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_refund_transaction';
}

<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Transaction Amount.
 *
 * Executes the official Braintree GraphQL field updateTransactionAmount.
 */
class BraintreeUpdateTransactionAmount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_transaction_amount';
}

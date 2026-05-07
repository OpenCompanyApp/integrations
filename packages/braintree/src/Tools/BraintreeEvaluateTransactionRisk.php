<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Evaluate Transaction Risk.
 *
 * Executes the official Braintree GraphQL field evaluateTransactionRisk.
 */
class BraintreeEvaluateTransactionRisk extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_evaluate_transaction_risk';
}

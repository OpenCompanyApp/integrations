<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Transaction Risk Context.
 *
 * Executes the official Braintree GraphQL field createTransactionRiskContext.
 */
class BraintreeCreateTransactionRiskContext extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_transaction_risk_context';
}

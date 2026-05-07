<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Sandbox Settle Transaction.
 *
 * Executes the official Braintree GraphQL field sandboxSettleTransaction.
 */
class BraintreeSandboxSettleTransaction extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_sandbox_settle_transaction';
}

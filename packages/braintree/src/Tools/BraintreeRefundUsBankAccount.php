<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Refund Us Bank Account.
 *
 * Executes the official Braintree GraphQL field refundUsBankAccount.
 */
class BraintreeRefundUsBankAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_refund_us_bank_account';
}

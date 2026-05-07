<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Verify Us Bank Account.
 *
 * Executes the official Braintree GraphQL field verifyUsBankAccount.
 */
class BraintreeVerifyUsBankAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_verify_us_bank_account';
}

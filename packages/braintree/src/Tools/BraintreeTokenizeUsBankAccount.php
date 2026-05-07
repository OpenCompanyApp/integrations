<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Us Bank Account.
 *
 * Executes the official Braintree GraphQL field tokenizeUsBankAccount.
 */
class BraintreeTokenizeUsBankAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_us_bank_account';
}

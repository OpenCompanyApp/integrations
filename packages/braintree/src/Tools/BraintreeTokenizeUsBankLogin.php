<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Us Bank Login.
 *
 * Executes the official Braintree GraphQL field tokenizeUsBankLogin.
 */
class BraintreeTokenizeUsBankLogin extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_us_bank_login';
}

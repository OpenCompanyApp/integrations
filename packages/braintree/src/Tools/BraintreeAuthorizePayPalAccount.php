<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Authorize Pay Pal Account.
 *
 * Executes the official Braintree GraphQL field authorizePayPalAccount.
 */
class BraintreeAuthorizePayPalAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_authorize_pay_pal_account';
}

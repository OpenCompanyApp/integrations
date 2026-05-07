<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Authorize Venmo Account.
 *
 * Executes the official Braintree GraphQL field authorizeVenmoAccount.
 */
class BraintreeAuthorizeVenmoAccount extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_authorize_venmo_account';
}

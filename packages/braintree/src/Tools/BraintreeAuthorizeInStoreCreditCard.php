<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Authorize In Store Credit Card.
 *
 * Executes the official Braintree GraphQL field authorizeInStoreCreditCard.
 */
class BraintreeAuthorizeInStoreCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_authorize_in_store_credit_card';
}

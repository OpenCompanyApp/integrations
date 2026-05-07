<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Authorize Credit Card.
 *
 * Executes the official Braintree GraphQL field authorizeCreditCard.
 */
class BraintreeAuthorizeCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_authorize_credit_card';
}

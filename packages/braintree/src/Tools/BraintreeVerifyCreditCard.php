<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Verify Credit Card.
 *
 * Executes the official Braintree GraphQL field verifyCreditCard.
 */
class BraintreeVerifyCreditCard extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_verify_credit_card';
}

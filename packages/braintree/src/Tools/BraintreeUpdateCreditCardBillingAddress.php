<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Credit Card Billing Address.
 *
 * Executes the official Braintree GraphQL field updateCreditCardBillingAddress.
 */
class BraintreeUpdateCreditCardBillingAddress extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_credit_card_billing_address';
}

<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Credit Card Cardholder Name.
 *
 * Executes the official Braintree GraphQL field updateCreditCardCardholderName.
 */
class BraintreeUpdateCreditCardCardholderName extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_credit_card_cardholder_name';
}

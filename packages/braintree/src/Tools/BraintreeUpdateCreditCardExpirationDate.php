<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Credit Card Expiration Date.
 *
 * Executes the official Braintree GraphQL field updateCreditCardExpirationDate.
 */
class BraintreeUpdateCreditCardExpirationDate extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_credit_card_expiration_date';
}

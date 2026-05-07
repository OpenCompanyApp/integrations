<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Tokenize Pay Pal Billing Agreement.
 *
 * Executes the official Braintree GraphQL field tokenizePayPalBillingAgreement.
 */
class BraintreeTokenizePayPalBillingAgreement extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_tokenize_pay_pal_billing_agreement';
}

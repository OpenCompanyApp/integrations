<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Pay Pal Billing Agreement.
 *
 * Executes the official Braintree GraphQL field createPayPalBillingAgreement.
 */
class BraintreeCreatePayPalBillingAgreement extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_pay_pal_billing_agreement';
}

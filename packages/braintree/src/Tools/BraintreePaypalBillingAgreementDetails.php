<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Paypal Billing Agreement Details.
 *
 * Executes the official Braintree GraphQL field paypalBillingAgreementDetails.
 */
class BraintreePaypalBillingAgreementDetails extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_paypal_billing_agreement_details';
}

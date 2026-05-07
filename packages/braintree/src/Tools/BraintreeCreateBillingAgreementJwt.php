<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Billing Agreement Jwt.
 *
 * Executes the official Braintree GraphQL field createBillingAgreementJwt.
 */
class BraintreeCreateBillingAgreementJwt extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_billing_agreement_jwt';
}

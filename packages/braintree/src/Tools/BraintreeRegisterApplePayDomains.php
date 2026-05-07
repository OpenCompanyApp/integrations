<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Register Apple Pay Domains.
 *
 * Executes the official Braintree GraphQL field registerApplePayDomains.
 */
class BraintreeRegisterApplePayDomains extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_register_apple_pay_domains';
}

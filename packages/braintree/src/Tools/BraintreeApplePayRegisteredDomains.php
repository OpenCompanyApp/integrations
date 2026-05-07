<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Apple Pay Registered Domains.
 *
 * Executes the official Braintree GraphQL field applePayRegisteredDomains.
 */
class BraintreeApplePayRegisteredDomains extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_apple_pay_registered_domains';
}

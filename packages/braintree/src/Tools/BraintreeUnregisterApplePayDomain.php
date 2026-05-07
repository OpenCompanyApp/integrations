<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Unregister Apple Pay Domain.
 *
 * Executes the official Braintree GraphQL field unregisterApplePayDomain.
 */
class BraintreeUnregisterApplePayDomain extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_unregister_apple_pay_domain';
}

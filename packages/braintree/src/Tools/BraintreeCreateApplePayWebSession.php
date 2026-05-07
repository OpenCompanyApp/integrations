<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Apple Pay Web Session.
 *
 * Executes the official Braintree GraphQL field createApplePayWebSession.
 */
class BraintreeCreateApplePayWebSession extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_apple_pay_web_session';
}

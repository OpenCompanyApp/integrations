<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Local Payment Context.
 *
 * Executes the official Braintree GraphQL field createLocalPaymentContext.
 */
class BraintreeCreateLocalPaymentContext extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_local_payment_context';
}

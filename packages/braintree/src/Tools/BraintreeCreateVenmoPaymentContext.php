<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Venmo Payment Context.
 *
 * Executes the official Braintree GraphQL field createVenmoPaymentContext.
 */
class BraintreeCreateVenmoPaymentContext extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_venmo_payment_context';
}

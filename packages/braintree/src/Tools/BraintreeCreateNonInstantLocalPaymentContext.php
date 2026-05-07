<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Non Instant Local Payment Context.
 *
 * Executes the official Braintree GraphQL field createNonInstantLocalPaymentContext.
 */
class BraintreeCreateNonInstantLocalPaymentContext extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_non_instant_local_payment_context';
}

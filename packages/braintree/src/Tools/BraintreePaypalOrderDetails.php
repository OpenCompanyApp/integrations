<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Paypal Order Details.
 *
 * Executes the official Braintree GraphQL field paypalOrderDetails.
 */
class BraintreePaypalOrderDetails extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_paypal_order_details';
}

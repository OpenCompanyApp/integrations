<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Reverse Refund.
 *
 * Executes the official Braintree GraphQL field reverseRefund.
 */
class BraintreeReverseRefund extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_reverse_refund';
}

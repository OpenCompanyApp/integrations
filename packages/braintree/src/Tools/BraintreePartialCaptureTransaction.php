<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Partial Capture Transaction.
 *
 * Executes the official Braintree GraphQL field partialCaptureTransaction.
 */
class BraintreePartialCaptureTransaction extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_partial_capture_transaction';
}

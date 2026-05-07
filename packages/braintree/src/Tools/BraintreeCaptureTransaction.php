<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Capture Transaction.
 *
 * Executes the official Braintree GraphQL field captureTransaction.
 */
class BraintreeCaptureTransaction extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_capture_transaction';
}

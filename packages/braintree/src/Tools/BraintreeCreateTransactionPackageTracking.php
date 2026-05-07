<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Transaction Package Tracking.
 *
 * Executes the official Braintree GraphQL field createTransactionPackageTracking.
 */
class BraintreeCreateTransactionPackageTracking extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_transaction_package_tracking';
}

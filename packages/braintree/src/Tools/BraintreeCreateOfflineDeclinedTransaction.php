<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Offline Declined Transaction.
 *
 * Executes the official Braintree GraphQL field createOfflineDeclinedTransaction.
 */
class BraintreeCreateOfflineDeclinedTransaction extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_offline_declined_transaction';
}

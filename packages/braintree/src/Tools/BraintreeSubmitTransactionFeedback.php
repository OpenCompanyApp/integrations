<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Submit Transaction Feedback.
 *
 * Executes the official Braintree GraphQL field submitTransactionFeedback.
 */
class BraintreeSubmitTransactionFeedback extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_submit_transaction_feedback';
}

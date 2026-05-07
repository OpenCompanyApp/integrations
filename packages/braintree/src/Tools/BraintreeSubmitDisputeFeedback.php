<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Submit Dispute Feedback.
 *
 * Executes the official Braintree GraphQL field submitDisputeFeedback.
 */
class BraintreeSubmitDisputeFeedback extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_submit_dispute_feedback';
}

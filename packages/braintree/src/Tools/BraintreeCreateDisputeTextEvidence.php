<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Dispute Text Evidence.
 *
 * Executes the official Braintree GraphQL field createDisputeTextEvidence.
 */
class BraintreeCreateDisputeTextEvidence extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_dispute_text_evidence';
}

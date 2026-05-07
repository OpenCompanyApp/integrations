<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Create Dispute File Evidence.
 *
 * Executes the official Braintree GraphQL field createDisputeFileEvidence.
 */
class BraintreeCreateDisputeFileEvidence extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_create_dispute_file_evidence';
}

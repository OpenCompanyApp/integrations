<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Delete Dispute Evidence.
 *
 * Executes the official Braintree GraphQL field deleteDisputeEvidence.
 */
class BraintreeDeleteDisputeEvidence extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_delete_dispute_evidence';
}

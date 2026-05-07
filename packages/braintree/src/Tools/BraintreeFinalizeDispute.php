<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Finalize Dispute.
 *
 * Executes the official Braintree GraphQL field finalizeDispute.
 */
class BraintreeFinalizeDispute extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_finalize_dispute';
}

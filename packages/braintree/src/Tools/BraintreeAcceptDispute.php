<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Accept Dispute.
 *
 * Executes the official Braintree GraphQL field acceptDispute.
 */
class BraintreeAcceptDispute extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_accept_dispute';
}

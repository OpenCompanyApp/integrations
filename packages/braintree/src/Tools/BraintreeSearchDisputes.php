<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search Disputes.
 *
 * Executes the official Braintree GraphQL field disputes.
 */
class BraintreeSearchDisputes extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_disputes';
}

<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search Refunds.
 *
 * Executes the official Braintree GraphQL field refunds.
 */
class BraintreeSearchRefunds extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_refunds';
}

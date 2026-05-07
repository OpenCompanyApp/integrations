<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search Business Account Creation Requests.
 *
 * Executes the official Braintree GraphQL field businessAccountCreationRequests.
 */
class BraintreeSearchBusinessAccountCreationRequests extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_business_account_creation_requests';
}

<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search Roles.
 *
 * Executes the official Braintree GraphQL field roles.
 */
class BraintreeSearchRoles extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_roles';
}

<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Search Verifications.
 *
 * Executes the official Braintree GraphQL field verifications.
 */
class BraintreeSearchVerifications extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_search_verifications';
}

<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Perform Three Dsecure Lookup.
 *
 * Executes the official Braintree GraphQL field performThreeDSecureLookup.
 */
class BraintreePerformThreeDSecureLookup extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_perform_three_dsecure_lookup';
}

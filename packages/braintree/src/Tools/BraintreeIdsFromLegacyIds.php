<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Ids From Legacy Ids.
 *
 * Executes the official Braintree GraphQL field idsFromLegacyIds.
 */
class BraintreeIdsFromLegacyIds extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_ids_from_legacy_ids';
}

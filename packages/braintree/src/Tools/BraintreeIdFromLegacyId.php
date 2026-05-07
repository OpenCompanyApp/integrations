<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Id From Legacy Id.
 *
 * Executes the official Braintree GraphQL field idFromLegacyId.
 */
class BraintreeIdFromLegacyId extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_id_from_legacy_id';
}

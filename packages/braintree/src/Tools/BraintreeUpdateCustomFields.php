<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Custom Fields.
 *
 * Executes the official Braintree GraphQL field updateCustomFields.
 */
class BraintreeUpdateCustomFields extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_custom_fields';
}

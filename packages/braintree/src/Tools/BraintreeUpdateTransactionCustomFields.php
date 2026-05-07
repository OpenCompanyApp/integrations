<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Update Transaction Custom Fields.
 *
 * Executes the official Braintree GraphQL field updateTransactionCustomFields.
 */
class BraintreeUpdateTransactionCustomFields extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_update_transaction_custom_fields';
}

<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Confirm Micro Transfer Amounts.
 *
 * Executes the official Braintree GraphQL field confirmMicroTransferAmounts.
 */
class BraintreeConfirmMicroTransferAmounts extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_confirm_micro_transfer_amounts';
}

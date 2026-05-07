<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Report Transaction Level Fees.
 *
 * Executes the official Braintree GraphQL field transactionLevelFees.
 */
class BraintreeReportTransactionLevelFees extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_report_transaction_level_fees';
}

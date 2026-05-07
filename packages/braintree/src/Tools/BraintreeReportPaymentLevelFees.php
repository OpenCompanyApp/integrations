<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Report Payment Level Fees.
 *
 * Executes the official Braintree GraphQL field paymentLevelFees.
 */
class BraintreeReportPaymentLevelFees extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_report_payment_level_fees';
}

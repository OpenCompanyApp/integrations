<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a refund for a transaction.
 *
 * Executes the official Avalara AvaTax REST API operation RefundTransaction.
 */
class AvalaraRefundTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_refund_transaction';
}
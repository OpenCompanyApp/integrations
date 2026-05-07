<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a refund for a MultiDocument transaction.
 *
 * Executes the official Avalara AvaTax REST API operation RefundMultiDocumentTransaction.
 */
class AvalaraRefundMultiDocumentTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_refund_multi_document_transaction';
}
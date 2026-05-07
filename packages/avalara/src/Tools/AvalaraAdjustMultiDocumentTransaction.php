<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Adjust a MultiDocument transaction.
 *
 * Executes the official Avalara AvaTax REST API operation AdjustMultiDocumentTransaction.
 */
class AvalaraAdjustMultiDocumentTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_adjust_multi_document_transaction';
}
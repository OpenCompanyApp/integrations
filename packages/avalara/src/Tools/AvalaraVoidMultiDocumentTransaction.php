<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Void a MultiDocument transaction.
 *
 * Executes the official Avalara AvaTax REST API operation VoidMultiDocumentTransaction.
 */
class AvalaraVoidMultiDocumentTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_void_multi_document_transaction';
}
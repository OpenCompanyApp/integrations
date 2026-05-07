<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new MultiDocument transaction.
 *
 * Executes the official Avalara AvaTax REST API operation CreateMultiDocumentTransaction.
 */
class AvalaraCreateMultiDocumentTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_multi_document_transaction';
}
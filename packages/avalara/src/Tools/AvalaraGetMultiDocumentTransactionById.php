<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a MultiDocument transaction by ID.
 *
 * Executes the official Avalara AvaTax REST API operation GetMultiDocumentTransactionById.
 */
class AvalaraGetMultiDocumentTransactionById extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_multi_document_transaction_by_id';
}
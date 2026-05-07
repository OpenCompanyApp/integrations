<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a MultiDocument transaction.
 *
 * Executes the official Avalara AvaTax REST API operation GetMultiDocumentTransactionByCodeAndType.
 */
class AvalaraGetMultiDocumentTransactionByCodeAndType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_multi_document_transaction_by_code_and_type';
}
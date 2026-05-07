<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Commit a MultiDocument transaction.
 *
 * Executes the official Avalara AvaTax REST API operation CommitMultiDocumentTransaction.
 */
class AvalaraCommitMultiDocumentTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_commit_multi_document_transaction';
}
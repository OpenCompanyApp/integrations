<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all MultiDocument transactions.
 *
 * Executes the official Avalara AvaTax REST API operation ListMultiDocumentTransactions.
 */
class AvalaraListMultiDocumentTransactions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_multi_document_transactions';
}
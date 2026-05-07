<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Commit a transaction for reporting.
 *
 * Executes the official Avalara AvaTax REST API operation CommitTransaction.
 */
class AvalaraCommitTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_commit_transaction';
}
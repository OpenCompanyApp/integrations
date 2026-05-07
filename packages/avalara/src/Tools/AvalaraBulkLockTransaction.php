<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Lock a set of documents.
 *
 * Executes the official Avalara AvaTax REST API operation BulkLockTransaction.
 */
class AvalaraBulkLockTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_bulk_lock_transaction';
}
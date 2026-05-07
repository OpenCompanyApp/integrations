<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new transaction batch.
 *
 * Executes the official Avalara AvaTax REST API operation CreateTransactionBatch.
 */
class AvalaraCreateTransactionBatch extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_transaction_batch';
}
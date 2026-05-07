<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single transaction by ID.
 *
 * Executes the official Avalara AvaTax REST API operation GetTransactionById.
 */
class AvalaraGetTransactionById extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_transaction_by_id';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single transaction by code.
 *
 * Executes the official Avalara AvaTax REST API operation GetTransactionByCodeAndType.
 */
class AvalaraGetTransactionByCodeAndType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_transaction_by_code_and_type';
}
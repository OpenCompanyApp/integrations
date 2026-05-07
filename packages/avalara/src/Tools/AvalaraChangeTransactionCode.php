<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Change a transaction's code.
 *
 * Executes the official Avalara AvaTax REST API operation ChangeTransactionCode.
 */
class AvalaraChangeTransactionCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_change_transaction_code';
}
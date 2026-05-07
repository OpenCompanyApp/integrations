<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new transaction.
 *
 * Executes the official Avalara AvaTax REST API operation CreateTransaction.
 */
class AvalaraCreateTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_transaction';
}
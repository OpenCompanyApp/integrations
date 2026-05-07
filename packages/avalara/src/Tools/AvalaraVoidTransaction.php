<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Void a transaction.
 *
 * Executes the official Avalara AvaTax REST API operation VoidTransaction.
 */
class AvalaraVoidTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_void_transaction';
}
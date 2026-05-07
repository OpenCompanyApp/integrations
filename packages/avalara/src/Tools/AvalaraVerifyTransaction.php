<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Verify a transaction.
 *
 * Executes the official Avalara AvaTax REST API operation VerifyTransaction.
 */
class AvalaraVerifyTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_verify_transaction';
}
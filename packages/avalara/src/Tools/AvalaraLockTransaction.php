<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Lock a single transaction.
 *
 * Executes the official Avalara AvaTax REST API operation LockTransaction.
 */
class AvalaraLockTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_lock_transaction';
}
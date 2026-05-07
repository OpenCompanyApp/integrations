<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Uncommit a transaction for reporting.
 *
 * Executes the official Avalara AvaTax REST API operation UncommitTransaction.
 */
class AvalaraUncommitTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_uncommit_transaction';
}
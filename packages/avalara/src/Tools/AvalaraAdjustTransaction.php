<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Correct a previously created transaction.
 *
 * Executes the official Avalara AvaTax REST API operation AdjustTransaction.
 */
class AvalaraAdjustTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_adjust_transaction';
}
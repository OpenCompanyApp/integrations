<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create or adjust a transaction.
 *
 * Executes the official Avalara AvaTax REST API operation CreateOrAdjustTransaction.
 */
class AvalaraCreateOrAdjustTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_or_adjust_transaction';
}
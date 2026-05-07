<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Perform multiple actions on a transaction.
 *
 * Executes the official Avalara AvaTax REST API operation SettleTransaction.
 */
class AvalaraSettleTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_settle_transaction';
}
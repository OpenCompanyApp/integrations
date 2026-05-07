<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Unvoids a transaction.
 *
 * Executes the official Avalara AvaTax REST API operation UnvoidTransaction.
 */
class AvalaraUnvoidTransaction extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_unvoid_transaction';
}
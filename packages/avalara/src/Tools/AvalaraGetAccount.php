<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single account.
 *
 * Executes the official Avalara AvaTax REST API operation GetAccount.
 */
class AvalaraGetAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_account';
}
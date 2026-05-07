<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single account.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateAccount.
 */
class AvalaraUpdateAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_account';
}
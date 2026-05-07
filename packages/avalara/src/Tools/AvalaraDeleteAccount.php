<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single account.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteAccount.
 */
class AvalaraDeleteAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_account';
}
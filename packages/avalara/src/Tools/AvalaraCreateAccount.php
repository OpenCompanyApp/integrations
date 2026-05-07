<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new account.
 *
 * Executes the official Avalara AvaTax REST API operation CreateAccount.
 */
class AvalaraCreateAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_account';
}
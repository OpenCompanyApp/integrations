<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Activate an account by accepting terms and conditions.
 *
 * Executes the official Avalara AvaTax REST API operation ActivateAccount.
 */
class AvalaraActivateAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_activate_account';
}
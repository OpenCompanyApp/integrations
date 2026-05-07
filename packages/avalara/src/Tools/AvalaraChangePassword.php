<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Change Password.
 *
 * Executes the official Avalara AvaTax REST API operation ChangePassword.
 */
class AvalaraChangePassword extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_change_password';
}
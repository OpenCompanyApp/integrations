<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Reset a user's password programmatically.
 *
 * Executes the official Avalara AvaTax REST API operation ResetPassword.
 */
class AvalaraResetPassword extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_reset_password';
}
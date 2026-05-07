<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a new GL account.
 *
 * Executes the official Avalara AvaTax REST API operation CreateGLAccount.
 */
class AvalaraCreateGLAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_gl_account';
}
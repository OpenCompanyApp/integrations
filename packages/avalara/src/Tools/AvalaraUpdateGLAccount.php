<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single GL account.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateGLAccount.
 */
class AvalaraUpdateGLAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_gl_account';
}
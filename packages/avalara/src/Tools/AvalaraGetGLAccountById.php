<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single GL account.
 *
 * Executes the official Avalara AvaTax REST API operation GetGLAccountById.
 */
class AvalaraGetGLAccountById extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_gl_account_by_id';
}
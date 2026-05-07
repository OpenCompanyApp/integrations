<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete the GL account associated with the given company ID and GL account ID.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteGLAccount.
 */
class AvalaraDeleteGLAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_gl_account';
}
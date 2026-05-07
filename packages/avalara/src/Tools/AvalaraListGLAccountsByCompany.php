<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve GL accounts for this company.
 *
 * Executes the official Avalara AvaTax REST API operation ListGLAccountsByCompany.
 */
class AvalaraListGLAccountsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_gl_accounts_by_company';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a list of MRS Companies with account.
 *
 * Executes the official Avalara AvaTax REST API operation ListMrsCompanies.
 */
class AvalaraListMrsCompanies extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_mrs_companies';
}
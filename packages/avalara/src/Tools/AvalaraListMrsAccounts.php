<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a list of MRS Accounts.
 *
 * Executes the official Avalara AvaTax REST API operation ListMrsAccounts.
 */
class AvalaraListMrsAccounts extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_mrs_accounts';
}
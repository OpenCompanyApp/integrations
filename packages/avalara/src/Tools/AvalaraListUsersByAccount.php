<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve users for this account.
 *
 * Executes the official Avalara AvaTax REST API operation ListUsersByAccount.
 */
class AvalaraListUsersByAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_users_by_account';
}
<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all accounts.
 *
 * Executes the official Avalara AvaTax REST API operation QueryAccounts.
 */
class AvalaraQueryAccounts extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_accounts';
}
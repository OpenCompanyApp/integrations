<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get configuration settings for this account.
 *
 * Executes the official Avalara AvaTax REST API operation GetAccountConfiguration.
 */
class AvalaraGetAccountConfiguration extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_account_configuration';
}
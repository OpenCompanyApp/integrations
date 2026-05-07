<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Change configuration settings for this account.
 *
 * Executes the official Avalara AvaTax REST API operation SetAccountConfiguration.
 */
class AvalaraSetAccountConfiguration extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_set_account_configuration';
}
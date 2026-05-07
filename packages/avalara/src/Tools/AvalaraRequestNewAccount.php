<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Request a new Avalara account.
 *
 * Executes the official Avalara AvaTax REST API operation RequestNewAccount.
 */
class AvalaraRequestNewAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_request_new_account';
}
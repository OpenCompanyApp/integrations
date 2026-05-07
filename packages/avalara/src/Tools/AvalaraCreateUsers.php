<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create new users.
 *
 * Executes the official Avalara AvaTax REST API operation CreateUsers.
 */
class AvalaraCreateUsers extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_users';
}
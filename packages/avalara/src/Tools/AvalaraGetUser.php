<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single user.
 *
 * Executes the official Avalara AvaTax REST API operation GetUser.
 */
class AvalaraGetUser extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_user';
}
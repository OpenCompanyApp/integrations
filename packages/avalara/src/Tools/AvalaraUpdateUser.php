<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single user.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateUser.
 */
class AvalaraUpdateUser extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_user';
}
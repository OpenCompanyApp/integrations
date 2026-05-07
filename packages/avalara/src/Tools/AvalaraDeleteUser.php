<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single user.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteUser.
 */
class AvalaraDeleteUser extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_user';
}
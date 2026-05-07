<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported permissions.
 *
 * Executes the official Avalara AvaTax REST API operation ListPermissions.
 */
class AvalaraListPermissions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_permissions';
}
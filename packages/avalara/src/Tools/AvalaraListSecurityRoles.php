<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported permissions.
 *
 * Executes the official Avalara AvaTax REST API operation ListSecurityRoles.
 */
class AvalaraListSecurityRoles extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_security_roles';
}
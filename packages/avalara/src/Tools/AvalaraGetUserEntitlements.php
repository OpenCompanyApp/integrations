<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all entitlements for a single user.
 *
 * Executes the official Avalara AvaTax REST API operation GetUserEntitlements.
 */
class AvalaraGetUserEntitlements extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_user_entitlements';
}
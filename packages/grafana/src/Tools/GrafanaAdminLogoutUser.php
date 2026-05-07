<?php

namespace OpenCompany\Integrations\Grafana\Tools;

/**
 * Logout user revokes all auth tokens (devices) for the user. User of issued auth tokens (devices)....
 *
 * Generated from the official Grafana OpenAPI operation adminLogoutUser.
 */
class GrafanaAdminLogoutUser extends AbstractGrafanaOperationTool
{
    protected const TOOL_NAME = 'grafana_admin_logout_user';
}

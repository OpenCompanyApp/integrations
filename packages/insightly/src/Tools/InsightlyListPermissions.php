<?php

namespace OpenCompany\Integrations\Insightly\Tools;

/**
 * List Insightly object permissions.
 */
class InsightlyListPermissions extends AbstractInsightlyEndpointTool
{
    protected string $toolName = 'insightly_list_permissions';
    protected string $toolDescription = 'List Insightly object permissions for the authenticated user.';
    protected string $path = '/v3.1/Permissions';
}

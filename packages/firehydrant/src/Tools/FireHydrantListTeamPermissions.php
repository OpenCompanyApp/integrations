<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get all permissions for a team.
 *
 * Maps to the official FireHydrant endpoint get /v1/permissions/team.
 */
class FireHydrantListTeamPermissions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_team_permissions';
    protected const DESCRIPTION = 'Get all permissions for a team

Official FireHydrant endpoint: GET /v1/permissions/team

Get all permissions for a team';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/permissions/team';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

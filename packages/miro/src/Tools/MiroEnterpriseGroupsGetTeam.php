<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves information of a team that the user group is a part of in an organization. Required scope organizations:groups:read organizations:teams:readRate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/groups/{group_id}/teams/{team_id}.
 */
class MiroEnterpriseGroupsGetTeam extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_groups_get_team';
    protected const DESCRIPTION = 'Retrieves information of a team that the user group is a part of in an organization. Required scope organizations:groups:read organizations:teams:readRate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/groups/{group_id}/teams/{team_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of an organization.',
        'required' => true,
      ),
      'group_id' => array (
        'type' => 'string',
        'description' => 'The ID of a user group.',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'The ID of a team.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/groups/{group_id}/teams/{team_id}';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'group_id' => 'group_id',
      'team_id' => 'team_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

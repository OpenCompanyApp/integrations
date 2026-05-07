<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves the list of teams that the user group is a part of. Required scope organizations:groups:read organizations:teams:readRate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/groups/{group_id}/teams.
 */
class MiroEnterpriseGroupsGetTeams extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_groups_get_teams';
    protected const DESCRIPTION = 'Retrieves the list of teams that the user group is a part of. Required scope organizations:groups:read organizations:teams:readRate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/groups/{group_id}/teams.';
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
      'limit' => array (
        'type' => 'integer',
        'description' => 'The maximum number of teams in the result list.',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'A representation of the position of a team in the full set of results. It is used to determine the first item of the resulting set. Leave empty to retrieve items from the beginning.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/groups/{group_id}/teams';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'group_id' => 'group_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'cursor' => 'cursor',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

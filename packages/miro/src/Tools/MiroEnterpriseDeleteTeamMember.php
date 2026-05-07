<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes team member from team by id. Required scope organizations:teams:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint DELETE /v2/orgs/{org_id}/teams/{team_id}/members/{member_id}.
 */
class MiroEnterpriseDeleteTeamMember extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_delete_team_member';
    protected const DESCRIPTION = 'Deletes team member from team by id. Required scope organizations:teams:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: DELETE /v2/orgs/{org_id}/teams/{team_id}/members/{member_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of an organization.',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'The ID of a team.',
        'required' => true,
      ),
      'member_id' => array (
        'type' => 'string',
        'description' => 'The id of the Team Member',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/members/{member_id}';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
      'member_id' => 'member_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

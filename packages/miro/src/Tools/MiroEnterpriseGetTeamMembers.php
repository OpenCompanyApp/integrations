<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves team members by cursor. Required scope organizations:teams:read Rate limiting Level 2 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/teams/{team_id}/members.
 */
class MiroEnterpriseGetTeamMembers extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_get_team_members';
    protected const DESCRIPTION = 'Retrieves team members by cursor. Required scope organizations:teams:read Rate limiting Level 2 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/teams/{team_id}/members.';
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
      'limit' => array (
        'type' => 'integer',
        'description' => 'limit parameter.',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'An indicator of the position of a page in the full set of results. To obtain the first page leave it empty. To obtain subsequent pages set it to the value returned in the cursor field of the previous request.',
        'required' => false,
      ),
      'role' => array (
        'type' => 'string',
        'description' => 'Role query. Filters members by role using full word match. Accepted values are: * "member": Team member with full member permissions. * "admin": Admin of a team. Team member with permission to manage team. * "non_team": External user, non-team user. * "team_guest": (Deprecated) Team-guest user, user with access only to a team without access to organization.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/members';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
    );
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'cursor' => 'cursor',
      'role' => 'role',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Adds a user group to a team in an organization. Required scope organizations:groups:read organizations:teams:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.'.
 *
 * Maps to the official Miro endpoint POST /v2/orgs/{org_id}/teams/{team_id}/groups.
 */
class MiroEnterpriseTeamsCreateGroup extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_teams_create_group';
    protected const DESCRIPTION = 'Adds a user group to a team in an organization. Required scope organizations:groups:read organizations:teams:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.\'

Official Miro endpoint: POST /v2/orgs/{org_id}/teams/{team_id}/groups.';
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
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/groups';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

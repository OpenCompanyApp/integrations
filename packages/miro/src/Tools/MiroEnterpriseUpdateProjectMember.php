<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates details of a project member, such as the member's role.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint PATCH /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}/members/{member_id}.
 */
class MiroEnterpriseUpdateProjectMember extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_update_project_member';
    protected const DESCRIPTION = 'Updates details of a project member, such as the member\'s role.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:write Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: PATCH /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}/members/{member_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization to which the project member belongs.',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'The ID of the team to which the project member belongs.',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'The ID of a Project.',
        'required' => true,
      ),
      'member_id' => array (
        'type' => 'string',
        'description' => 'The ID of the member whose details you want to update.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => true,
      ),
    );
    protected const METHOD = 'PATCH';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}/members/{member_id}';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
      'project_id' => 'project_id',
      'member_id' => 'member_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

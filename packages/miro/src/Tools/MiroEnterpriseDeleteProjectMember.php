<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Remove a member from a project. The user remains in the team even after the member is removed from a project.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:write Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint DELETE /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}/members/{member_id}.
 */
class MiroEnterpriseDeleteProjectMember extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_delete_project_member';
    protected const DESCRIPTION = 'Remove a member from a project. The user remains in the team even after the member is removed from a project.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:write Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: DELETE /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}/members/{member_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization to which the project belongs.',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'The ID of the team to which the project belongs.',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'The ID of the project from which you want to remove a member.',
        'required' => true,
      ),
      'member_id' => array (
        'type' => 'string',
        'description' => 'The ID of the member that you want to remove from a project.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

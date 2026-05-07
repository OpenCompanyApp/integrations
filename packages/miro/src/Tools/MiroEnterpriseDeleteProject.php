<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Deletes a project. After a project is deleted, all boards and users that belong to the project remain in the team.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:write Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint DELETE /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}.
 */
class MiroEnterpriseDeleteProject extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_delete_project';
    protected const DESCRIPTION = 'Deletes a project. After a project is deleted, all boards and users that belong to the project remain in the team.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:write Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: DELETE /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization from which you want to delete a project.',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'The ID of the team from which you want to delete a project.',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'The ID of the project that you want to delete.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
      'project_id' => 'project_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves project information, such as a name for an existing project.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:read Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}.
 */
class MiroEnterpriseGetProject extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_get_project';
    protected const DESCRIPTION = 'Retrieves project information, such as a name for an existing project.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:read Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'The ID of the organization from which you want to retrieve the project information.',
        'required' => true,
      ),
      'team_id' => array (
        'type' => 'string',
        'description' => 'The ID of the team from which you want to retrieve the project information.',
        'required' => true,
      ),
      'project_id' => array (
        'type' => 'string',
        'description' => 'The ID of the project for which you want to retrieve the information.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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

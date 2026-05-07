<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves the list of members for a specific project.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:read Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}/members.
 */
class MiroEnterpriseGetProjectMembers extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_get_project_members';
    protected const DESCRIPTION = 'Retrieves the list of members for a specific project.Note Projects have been renamed to Spaces, and the terms can be used interchangeably.Required scope projects:read Rate limiting Level 1 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}/members.';
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
        'description' => 'The ID of the project for which you want to retrieve the list of members.',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The maximum number of results to return per call. If the number of project members in the response is greater than the limit specified, the response returns the cursor parameter with a value.',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'An indicator of the position of a page in the full set of results. To obtain the first page leave it empty. To obtain subsequent pages set it to the value returned in the cursor field of the previous request.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/teams/{team_id}/projects/{project_id}/members';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'team_id' => 'team_id',
      'project_id' => 'project_id',
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

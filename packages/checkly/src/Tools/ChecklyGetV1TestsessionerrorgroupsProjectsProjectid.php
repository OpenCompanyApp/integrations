<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * List all test session error groups for a specific project..
 *
 * Maps to the official Checkly endpoint GET /v1/test-session-error-groups/projects/{projectId}.
 */
class ChecklyGetV1TestsessionerrorgroupsProjectsProjectid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_testsessionerrorgroups_projects_projectid';
    protected const DESCRIPTION = 'List all test session error groups for a specific project.

Official Checkly endpoint: GET /v1/test-session-error-groups/projects/{projectId}.';
    protected const PARAMETERS = array (
      'project_id' => array (
        'type' => 'string',
        'description' => 'projectId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/test-session-error-groups/projects/{projectId}';
    protected const PATH_PARAMS = array (
      'projectId' => 'project_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

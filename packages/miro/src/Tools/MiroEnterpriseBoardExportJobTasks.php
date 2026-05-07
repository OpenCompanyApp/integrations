<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves the list of tasks for the board export job. Required scope boards:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin and eDiscovery is enabled in the Settings. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/boards/export/jobs/{job_id}/tasks.
 */
class MiroEnterpriseBoardExportJobTasks extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_board_export_job_tasks';
    protected const DESCRIPTION = 'Retrieves the list of tasks for the board export job. Required scope boards:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin and eDiscovery is enabled in the Settings. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/boards/export/jobs/{job_id}/tasks.';
    protected const PARAMETERS = array (
      'org_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier of the organization.',
        'required' => true,
      ),
      'job_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier of the board export job.',
        'required' => true,
      ),
      'status' => array (
        'type' => 'array',
        'description' => 'Filters the list of board export tasks by their status. Accepts an array of statuses such as TASK_STATUS_CREATED, TASK_STATUS_CANCELLED, TASK_STATUS_SCHEDULED, TASK_STATUS_SUCCESS or TASK_STATUS_ERROR.',
        'required' => false,
      ),
      'cursor' => array (
        'type' => 'string',
        'description' => 'A cursor-paginated method returns a portion of the total set of results based on the limit specified and a cursor that points to the next portion of the results. To retrieve the next portion of the collection, set the cursor parameter equal to the cursor value you received in the response of the previous request.',
        'required' => false,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'The maximum number of results to return per call. If the number of tasks in the response is greater than the limit specified, the response returns the cursor parameter with a value.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/boards/export/jobs/{job_id}/tasks';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'job_id' => 'job_id',
    );
    protected const QUERY_PARAMS = array (
      'status' => 'status',
      'cursor' => 'cursor',
      'limit' => 'limit',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

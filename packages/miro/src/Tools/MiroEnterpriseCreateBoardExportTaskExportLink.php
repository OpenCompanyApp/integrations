<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Creates a link to download the results of a board export task. Required scope boards:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin and eDiscovery is enabled in the Settings. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint POST /v2/orgs/{org_id}/boards/export/jobs/{job_id}/tasks/{task_id}/export-link.
 */
class MiroEnterpriseCreateBoardExportTaskExportLink extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_create_board_export_task_export_link';
    protected const DESCRIPTION = 'Creates a link to download the results of a board export task. Required scope boards:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin and eDiscovery is enabled in the Settings. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: POST /v2/orgs/{org_id}/boards/export/jobs/{job_id}/tasks/{task_id}/export-link.';
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
      'task_id' => array (
        'type' => 'string',
        'description' => 'Unique identifier of the board export task.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v2/orgs/{org_id}/boards/export/jobs/{job_id}/tasks/{task_id}/export-link';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'job_id' => 'job_id',
      'task_id' => 'task_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

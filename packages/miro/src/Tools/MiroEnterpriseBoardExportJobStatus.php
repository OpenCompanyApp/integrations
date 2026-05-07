<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Retrieves the status of the board export job. Required scope boards:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin and eDiscovery is enabled in the Settings. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint GET /v2/orgs/{org_id}/boards/export/jobs/{job_id}.
 */
class MiroEnterpriseBoardExportJobStatus extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_board_export_job_status';
    protected const DESCRIPTION = 'Retrieves the status of the board export job. Required scope boards:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin and eDiscovery is enabled in the Settings. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: GET /v2/orgs/{org_id}/boards/export/jobs/{job_id}.';
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
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v2/orgs/{org_id}/boards/export/jobs/{job_id}';
    protected const PATH_PARAMS = array (
      'org_id' => 'org_id',
      'job_id' => 'job_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

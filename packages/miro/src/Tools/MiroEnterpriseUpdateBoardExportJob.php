<?php

namespace OpenCompany\Integrations\Miro\Tools;

/**
 * Updates the status of the board export job. Currently, only the cancellation of an ongoing export job is supported. Required scope boards:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin and eDiscovery is enabled in the Settings. You can request temporary access to Enterprise APIs using this form..
 *
 * Maps to the official Miro endpoint PUT /v2/orgs/{org_id}/boards/export/jobs/{job_id}/status.
 */
class MiroEnterpriseUpdateBoardExportJob extends AbstractMiroTool
{
    protected const NAME = 'miro_enterprise_update_board_export_job';
    protected const DESCRIPTION = 'Updates the status of the board export job. Currently, only the cancellation of an ongoing export job is supported. Required scope boards:export Rate limiting Level 4 Enterprise only This API is available only for Enterprise plan users. You can only use this endpoint if you have the role of a Company Admin and eDiscovery is enabled in the Settings. You can request temporary access to Enterprise APIs using this form.

Official Miro endpoint: PUT /v2/orgs/{org_id}/boards/export/jobs/{job_id}/status.';
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
      'body' => array (
        'type' => 'object',
        'description' => 'Request body matching the Miro API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/v2/orgs/{org_id}/boards/export/jobs/{job_id}/status';
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

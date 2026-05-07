<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Delete a status page..
 *
 * Maps to the official Checkly endpoint DELETE /v1/status-pages/{statusPageId}.
 */
class ChecklyDeleteV1StatuspagesStatuspageid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_statuspages_statuspageid';
    protected const DESCRIPTION = 'Delete a status page.

Official Checkly endpoint: DELETE /v1/status-pages/{statusPageId}.';
    protected const PARAMETERS = array (
      'status_page_id' => array (
        'type' => 'string',
        'description' => 'statusPageId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/status-pages/{statusPageId}';
    protected const PATH_PARAMS = array (
      'statusPageId' => 'status_page_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

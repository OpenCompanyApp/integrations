<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get status page data, including cards and services..
 *
 * Maps to the official Checkly endpoint GET /v1/status-pages/{statusPageId}.
 */
class ChecklyGetV1StatuspagesStatuspageid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_statuspages_statuspageid';
    protected const DESCRIPTION = 'Get status page data, including cards and services.

Official Checkly endpoint: GET /v1/status-pages/{statusPageId}.';
    protected const PARAMETERS = array (
      'status_page_id' => array (
        'type' => 'string',
        'description' => 'statusPageId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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

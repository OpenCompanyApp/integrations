<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Update a status page with its related services and cards..
 *
 * Maps to the official Checkly endpoint PUT /v1/status-pages/{statusPageId}.
 */
class ChecklyPutV1StatuspagesStatuspageid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_statuspages_statuspageid';
    protected const DESCRIPTION = 'Update a status page with its related services and cards.

Official Checkly endpoint: PUT /v1/status-pages/{statusPageId}.';
    protected const PARAMETERS = array (
      'status_page_id' => array (
        'type' => 'string',
        'description' => 'statusPageId parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
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

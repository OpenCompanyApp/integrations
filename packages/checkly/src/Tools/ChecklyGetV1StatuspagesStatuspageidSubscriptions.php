<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get all subscriptions for a specific status page.
 *
 * Maps to the official Checkly endpoint GET /v1/status-pages/{statusPageId}/subscriptions.
 */
class ChecklyGetV1StatuspagesStatuspageidSubscriptions extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_statuspages_statuspageid_subscriptions';
    protected const DESCRIPTION = 'Get all subscriptions for a specific status page

Official Checkly endpoint: GET /v1/status-pages/{statusPageId}/subscriptions.';
    protected const PARAMETERS = array (
      'status_page_id' => array (
        'type' => 'string',
        'description' => 'statusPageId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/status-pages/{statusPageId}/subscriptions';
    protected const PATH_PARAMS = array (
      'statusPageId' => 'status_page_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

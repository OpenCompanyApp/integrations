<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Bulk create subscriptions for a specific status page..
 *
 * Maps to the official Checkly endpoint POST /v1/status-pages/{statusPageId}/subscriptions/bulk.
 */
class ChecklyPostV1StatuspagesStatuspageidSubscriptionsBulk extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_statuspages_statuspageid_subscriptions_bulk';
    protected const DESCRIPTION = 'Bulk create subscriptions for a specific status page.

Official Checkly endpoint: POST /v1/status-pages/{statusPageId}/subscriptions/bulk.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/v1/status-pages/{statusPageId}/subscriptions/bulk';
    protected const PATH_PARAMS = array (
      'statusPageId' => 'status_page_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

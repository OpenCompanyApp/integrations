<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Delete a subscription belonging to a specific status page using the subscription id.
 *
 * Maps to the official Checkly endpoint DELETE /v1/status-pages/{statusPageId}/subscriptions/{subscriptionId}.
 */
class ChecklyDeleteV1StatuspagesStatuspageidSubscriptionsSubscriptionid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_statuspages_statuspageid_subscriptions_subscriptionid';
    protected const DESCRIPTION = 'Delete a subscription belonging to a specific status page using the subscription id

Official Checkly endpoint: DELETE /v1/status-pages/{statusPageId}/subscriptions/{subscriptionId}.';
    protected const PARAMETERS = array (
      'status_page_id' => array (
        'type' => 'string',
        'description' => 'statusPageId parameter.',
        'required' => true,
      ),
      'subscription_id' => array (
        'type' => 'string',
        'description' => 'subscriptionId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/status-pages/{statusPageId}/subscriptions/{subscriptionId}';
    protected const PATH_PARAMS = array (
      'statusPageId' => 'status_page_id',
      'subscriptionId' => 'subscription_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

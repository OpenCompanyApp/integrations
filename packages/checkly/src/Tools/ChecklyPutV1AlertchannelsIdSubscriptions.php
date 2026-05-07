<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Update the subscriptions of an alert channel. Use this to add a check to an alert channel so failure and recovery alerts are send out for that check. Note: when passing the subscription object, you can only specify a "checkId" or a "groupId, not both..
 *
 * Maps to the official Checkly endpoint PUT /v1/alert-channels/{id}/subscriptions.
 */
class ChecklyPutV1AlertchannelsIdSubscriptions extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_alertchannels_id_subscriptions';
    protected const DESCRIPTION = 'Update the subscriptions of an alert channel. Use this to add a check to an alert channel so failure and recovery alerts are send out for that check. Note: when passing the subscription object, you can only specify a "checkId" or a "groupId, not both.

Official Checkly endpoint: PUT /v1/alert-channels/{id}/subscriptions.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/alert-channels/{id}/subscriptions';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List events for an AWS CloudTrail batch.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/aws/cloudtrail_batches/{id}/events.
 */
class FireHydrantListAwsCloudtrailBatchEvents extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_aws_cloudtrail_batch_events';
    protected const DESCRIPTION = 'List events for an AWS CloudTrail batch

Official FireHydrant endpoint: GET /v1/integrations/aws/cloudtrail_batches/{id}/events

List events for an AWS CloudTrail batch';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/aws/cloudtrail_batches/{id}/events';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

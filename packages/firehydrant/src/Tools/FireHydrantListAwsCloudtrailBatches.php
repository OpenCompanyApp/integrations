<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List CloudTrail batches.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/aws/cloudtrail_batches.
 */
class FireHydrantListAwsCloudtrailBatches extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_aws_cloudtrail_batches';
    protected const DESCRIPTION = 'List CloudTrail batches

Official FireHydrant endpoint: GET /v1/integrations/aws/cloudtrail_batches

Lists CloudTrail batches for the authenticated organization.';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'AWS connection ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/aws/cloudtrail_batches';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'connection_id' => 'connection_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a CloudTrail batch.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/aws/cloudtrail_batches/{id}.
 */
class FireHydrantGetAwsCloudtrailBatch extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_aws_cloudtrail_batch';
    protected const DESCRIPTION = 'Get a CloudTrail batch

Official FireHydrant endpoint: GET /v1/integrations/aws/cloudtrail_batches/{id}

Retrieve a single CloudTrail batch.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/aws/cloudtrail_batches/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

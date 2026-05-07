<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a CloudTrail batch.
 *
 * Maps to the official FireHydrant endpoint patch /v1/integrations/aws/cloudtrail_batches/{id}.
 */
class FireHydrantUpdateAwsCloudtrailBatch extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_aws_cloudtrail_batch';
    protected const DESCRIPTION = 'Update a CloudTrail batch

Official FireHydrant endpoint: PATCH /v1/integrations/aws/cloudtrail_batches/{id}

Update a CloudTrail batch with new information.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/integrations/aws/cloudtrail_batches/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

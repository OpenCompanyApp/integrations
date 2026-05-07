<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List AWS connections.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/aws/connections.
 */
class FireHydrantListAwsConnections extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_aws_connections';
    protected const DESCRIPTION = 'List AWS connections

Official FireHydrant endpoint: GET /v1/integrations/aws/connections

Lists the available and configured AWS integration connections for the authenticated organization.';
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
  'aws_account_id' =>
  array (
    'type' => 'string',
    'description' => 'AWS account ID containing the role to be assumed',
  ),
  'target_arn' =>
  array (
    'type' => 'string',
    'description' => 'ARN of the role to be assumed',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'description' => 'The external ID supplied when assuming the role',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/aws/connections';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'aws_account_id' => 'aws_account_id',
  'target_arn' => 'target_arn',
  'external_id' => 'external_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

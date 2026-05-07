<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an AWS connection.
 *
 * Maps to the official FireHydrant endpoint patch /v1/integrations/aws/connections/{id}.
 */
class FireHydrantUpdateAwsConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_aws_connection';
    protected const DESCRIPTION = 'Update an AWS connection

Official FireHydrant endpoint: PATCH /v1/integrations/aws/connections/{id}

Update the AWS connection with the provided data.';
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
    protected const PATH = '/v1/integrations/aws/connections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an AWS connection.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/aws/connections/{id}.
 */
class FireHydrantGetAwsConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_aws_connection';
    protected const DESCRIPTION = 'Get an AWS connection

Official FireHydrant endpoint: GET /v1/integrations/aws/connections/{id}

Retrieves the information about the AWS connection.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/aws/connections/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

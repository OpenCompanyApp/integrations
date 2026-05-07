<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a severity.
 *
 * Maps to the official FireHydrant endpoint post /v1/severities.
 */
class FireHydrantCreateSeverity extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_severity';
    protected const DESCRIPTION = 'Create a severity

Official FireHydrant endpoint: POST /v1/severities

Create a new severity';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/severities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

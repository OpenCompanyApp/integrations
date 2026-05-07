<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create audience.
 *
 * Maps to the official FireHydrant endpoint post /v1/audiences.
 */
class FireHydrantCreateAudience extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_audience';
    protected const DESCRIPTION = 'Create audience

Official FireHydrant endpoint: POST /v1/audiences

Create a new audience';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/audiences';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get audience.
 *
 * Maps to the official FireHydrant endpoint get /v1/audiences/{audience_id}.
 */
class FireHydrantGetAudience extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_audience';
    protected const DESCRIPTION = 'Get audience

Official FireHydrant endpoint: GET /v1/audiences/{audience_id}

Get audience details';
    protected const PARAMETERS = array (
  'audience_id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the audience',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/audiences/{audience_id}';
    protected const PATH_PARAMS = array (
  'audience_id' => 'audience_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

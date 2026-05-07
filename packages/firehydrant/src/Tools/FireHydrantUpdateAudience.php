<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update audience.
 *
 * Maps to the official FireHydrant endpoint patch /v1/audiences/{audience_id}.
 */
class FireHydrantUpdateAudience extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_audience';
    protected const DESCRIPTION = 'Update audience

Official FireHydrant endpoint: PATCH /v1/audiences/{audience_id}

Update an existing audience';
    protected const PARAMETERS = array (
  'audience_id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the audience',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'patch';
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

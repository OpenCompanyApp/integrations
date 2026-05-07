<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a new change entry.
 *
 * Maps to the official FireHydrant endpoint post /v1/changes.
 */
class FireHydrantCreateChange extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_change';
    protected const DESCRIPTION = 'Create a new change entry

Official FireHydrant endpoint: POST /v1/changes

Create a new change entry';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/changes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a priority.
 *
 * Maps to the official FireHydrant endpoint get /v1/priorities/{priority_slug}.
 */
class FireHydrantGetPriority extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_priority';
    protected const DESCRIPTION = 'Get a priority

Official FireHydrant endpoint: GET /v1/priorities/{priority_slug}

Retrieve a specific priority';
    protected const PARAMETERS = array (
  'priority_slug' =>
  array (
    'type' => 'string',
    'description' => 'priority_slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/priorities/{priority_slug}';
    protected const PATH_PARAMS = array (
  'priority_slug' => 'priority_slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

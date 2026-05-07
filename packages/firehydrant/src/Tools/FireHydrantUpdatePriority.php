<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a priority.
 *
 * Maps to the official FireHydrant endpoint patch /v1/priorities/{priority_slug}.
 */
class FireHydrantUpdatePriority extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_priority';
    protected const DESCRIPTION = 'Update a priority

Official FireHydrant endpoint: PATCH /v1/priorities/{priority_slug}

Update a specific priority';
    protected const PARAMETERS = array (
  'priority_slug' =>
  array (
    'type' => 'string',
    'description' => 'priority_slug parameter.',
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
    protected const PATH = '/v1/priorities/{priority_slug}';
    protected const PATH_PARAMS = array (
  'priority_slug' => 'priority_slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

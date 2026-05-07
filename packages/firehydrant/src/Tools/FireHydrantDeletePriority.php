<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a priority.
 *
 * Maps to the official FireHydrant endpoint delete /v1/priorities/{priority_slug}.
 */
class FireHydrantDeletePriority extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_priority';
    protected const DESCRIPTION = 'Delete a priority

Official FireHydrant endpoint: DELETE /v1/priorities/{priority_slug}

Delete a specific priority';
    protected const PARAMETERS = array (
  'priority_slug' =>
  array (
    'type' => 'string',
    'description' => 'priority_slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

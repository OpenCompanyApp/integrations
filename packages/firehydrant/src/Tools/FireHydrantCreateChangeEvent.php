<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a change event.
 *
 * Maps to the official FireHydrant endpoint post /v1/changes/events.
 */
class FireHydrantCreateChangeEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_change_event';
    protected const DESCRIPTION = 'Create a change event

Official FireHydrant endpoint: POST /v1/changes/events

Create a change event';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/changes/events';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

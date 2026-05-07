<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a change entry.
 *
 * Maps to the official FireHydrant endpoint patch /v1/changes/{change_id}.
 */
class FireHydrantUpdateChange extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_change';
    protected const DESCRIPTION = 'Update a change entry

Official FireHydrant endpoint: PATCH /v1/changes/{change_id}

Update a change entry';
    protected const PARAMETERS = array (
  'change_id' =>
  array (
    'type' => 'string',
    'description' => 'change_id parameter.',
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
    protected const PATH = '/v1/changes/{change_id}';
    protected const PATH_PARAMS = array (
  'change_id' => 'change_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

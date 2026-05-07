<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive a change entry.
 *
 * Maps to the official FireHydrant endpoint delete /v1/changes/{change_id}.
 */
class FireHydrantDeleteChange extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_change';
    protected const DESCRIPTION = 'Archive a change entry

Official FireHydrant endpoint: DELETE /v1/changes/{change_id}

Archive a change entry';
    protected const PARAMETERS = array (
  'change_id' =>
  array (
    'type' => 'string',
    'description' => 'change_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/changes/{change_id}';
    protected const PATH_PARAMS = array (
  'change_id' => 'change_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

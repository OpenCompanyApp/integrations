<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an on call shadow configuration.
 *
 * Maps to the official Rootly endpoint delete /v1/on_call_shadows/{id}.
 */
class RootlyDeleteOnCallShadow extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_on_call_shadow';
    protected const DESCRIPTION = 'Delete an on call shadow configuration

Official Rootly endpoint: DELETE /v1/on_call_shadows/{id}

Delete a specific on call shadow configuration by id. Future shadows are hard-deleted. Active shadows (started in the past) have their end time truncated to preserve historical data.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/on_call_shadows/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

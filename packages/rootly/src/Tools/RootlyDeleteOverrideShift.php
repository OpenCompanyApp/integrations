<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an override shift.
 *
 * Maps to the official Rootly endpoint delete /v1/override_shifts/{id}.
 */
class RootlyDeleteOverrideShift extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_override_shift';
    protected const DESCRIPTION = 'Delete an override shift

Official Rootly endpoint: DELETE /v1/override_shifts/{id}

Delete a specific override shift by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/override_shifts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

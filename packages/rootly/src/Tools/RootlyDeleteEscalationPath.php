<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an escalation path.
 *
 * Maps to the official Rootly endpoint delete /v1/escalation_paths/{id}.
 */
class RootlyDeleteEscalationPath extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_escalation_path';
    protected const DESCRIPTION = 'Delete an escalation path

Official Rootly endpoint: DELETE /v1/escalation_paths/{id}

Delete a specific escalation path by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/escalation_paths/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

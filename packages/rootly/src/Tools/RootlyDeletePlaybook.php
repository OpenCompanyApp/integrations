<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a playbook.
 *
 * Maps to the official Rootly endpoint delete /v1/playbooks/{id}.
 */
class RootlyDeletePlaybook extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_playbook';
    protected const DESCRIPTION = 'Delete a playbook

Official Rootly endpoint: DELETE /v1/playbooks/{id}

Delete a specific playbook by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/playbooks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

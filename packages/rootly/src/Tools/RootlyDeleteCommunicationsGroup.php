<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Deletes a communications group.
 *
 * Maps to the official Rootly endpoint delete /v1/communications/groups/{id}.
 */
class RootlyDeleteCommunicationsGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_communications_group';
    protected const DESCRIPTION = 'Deletes a communications group

Official Rootly endpoint: DELETE /v1/communications/groups/{id}

Deletes a communications group';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Group ID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/communications/groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

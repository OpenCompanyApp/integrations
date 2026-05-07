<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Shows a communications group.
 *
 * Maps to the official Rootly endpoint get /v1/communications/groups/{id}.
 */
class RootlyGetCommunicationsGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_communications_group';
    protected const DESCRIPTION = 'Shows a communications group

Official Rootly endpoint: GET /v1/communications/groups/{id}

Shows details of a communications group';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Group ID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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

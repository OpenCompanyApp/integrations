<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Deletes a communications template.
 *
 * Maps to the official Rootly endpoint delete /v1/communications/templates/{id}.
 */
class RootlyDeleteCommunicationsTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_communications_template';
    protected const DESCRIPTION = 'Deletes a communications template

Official Rootly endpoint: DELETE /v1/communications/templates/{id}

Deletes a communications template';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Template ID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/communications/templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

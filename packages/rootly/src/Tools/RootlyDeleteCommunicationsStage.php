<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Deletes a communications stage.
 *
 * Maps to the official Rootly endpoint delete /v1/communications/stages/{id}.
 */
class RootlyDeleteCommunicationsStage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_communications_stage';
    protected const DESCRIPTION = 'Deletes a communications stage

Official Rootly endpoint: DELETE /v1/communications/stages/{id}

Deletes a communications stage';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Stage ID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/communications/stages/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

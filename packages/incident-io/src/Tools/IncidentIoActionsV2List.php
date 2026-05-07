<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Actions V2.
 *
 * Maps to the official incident.io endpoint get /v2/actions.
 */
class IncidentIoActionsV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_actions_v2_list';
    protected const DESCRIPTION = 'List Actions V2

Official incident.io endpoint: GET /v2/actions

List all actions for an organisation.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Find actions related to this incident',
  ),
  'incident_mode' =>
  array (
    'type' => 'string',
    'description' => 'Filter to actions from incidents of the given mode. If not set, only actions from `standard` and `retrospective` incidents are returned',
    'enum' =>
    array (
      0 => 'standard',
      1 => 'retrospective',
      2 => 'test',
      3 => 'tutorial',
      4 => 'stream',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/actions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'incident_id' => 'incident_id',
  'incident_mode' => 'incident_mode',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

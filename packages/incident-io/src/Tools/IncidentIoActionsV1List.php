<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Actions V1.
 *
 * Maps to the official incident.io endpoint get /v1/actions.
 */
class IncidentIoActionsV1List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_actions_v1_list';
    protected const DESCRIPTION = 'List Actions V1

Official incident.io endpoint: GET /v1/actions

List all actions for an organisation.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Find actions related to this incident',
  ),
  'is_follow_up' =>
  array (
    'type' => 'boolean',
    'description' => 'Filter to actions marked as being follow up actions',
  ),
  'incident_mode' =>
  array (
    'type' => 'string',
    'description' => 'Filter to actions from incidents of the given mode. If not set, only actions from `real` incidents are returned',
    'enum' =>
    array (
      0 => 'real',
      1 => 'test',
      2 => 'tutorial',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/actions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'incident_id' => 'incident_id',
  'is_follow_up' => 'is_follow_up',
  'incident_mode' => 'incident_mode',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Follow-ups V2.
 *
 * Maps to the official incident.io endpoint get /v2/follow_ups.
 */
class IncidentIoFollowUpsV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_follow_ups_v2_list';
    protected const DESCRIPTION = 'List Follow-ups V2

Official incident.io endpoint: GET /v2/follow_ups

List all follow-ups for an organisation.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'Find follow-ups related to this incident',
  ),
  'incident_mode' =>
  array (
    'type' => 'string',
    'description' => 'Filter to follow-ups from incidents of the given mode. If not set, only follow-ups from `standard` and `retrospective` incidents are returned',
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
    protected const PATH = '/v2/follow_ups';
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

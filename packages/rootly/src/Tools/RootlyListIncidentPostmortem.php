<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident retrospective.
 *
 * Maps to the official Rootly endpoint get /v1/post_mortems/{id}.
 */
class RootlyListIncidentPostmortem extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_postmortem';
    protected const DESCRIPTION = 'Retrieves an incident retrospective

Official Rootly endpoint: GET /v1/post_mortems/{id}

List incidents retrospectives';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/post_mortems/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

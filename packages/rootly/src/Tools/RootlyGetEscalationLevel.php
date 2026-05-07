<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an escalation level.
 *
 * Maps to the official Rootly endpoint get /v1/escalation_levels/{id}.
 */
class RootlyGetEscalationLevel extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_escalation_level';
    protected const DESCRIPTION = 'Retrieves an escalation level

Official Rootly endpoint: GET /v1/escalation_levels/{id}

Retrieves a specific escalation level by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/escalation_levels/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

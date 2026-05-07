<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdatePath Escalations V2.
 *
 * Maps to the official incident.io endpoint put /v2/escalation_paths/{id}.
 */
class IncidentIoEscalationsV2UpdatePath extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_escalations_v2_update_path';
    protected const DESCRIPTION = 'UpdatePath Escalations V2

Official incident.io endpoint: PUT /v2/escalation_paths/{id}

Updates an escalation path.

We recommend you create escalation paths in the incident.io dashboard where our path
builder makes it easy to use conditions and visualise the path.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for this escalation path.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/escalation_paths/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

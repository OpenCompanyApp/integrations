<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * DestroyPath Escalations V2.
 *
 * Maps to the official incident.io endpoint delete /v2/escalation_paths/{id}.
 */
class IncidentIoEscalationsV2DestroyPath extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_escalations_v2_destroy_path';
    protected const DESCRIPTION = 'DestroyPath Escalations V2

Official incident.io endpoint: DELETE /v2/escalation_paths/{id}

Archives an escalation path.

We recommend you create escalation paths in the incident.io dashboard where our path
builder makes it easy to use conditions and visualise the path.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for this escalation path.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v2/escalation_paths/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

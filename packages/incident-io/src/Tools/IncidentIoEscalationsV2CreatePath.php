<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * CreatePath Escalations V2.
 *
 * Maps to the official incident.io endpoint post /v2/escalation_paths.
 */
class IncidentIoEscalationsV2CreatePath extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_escalations_v2_create_path';
    protected const DESCRIPTION = 'CreatePath Escalations V2

Official incident.io endpoint: POST /v2/escalation_paths

Create an escalation path.

An escalation path is a series of steps that describe how a page should be escalated,
represented as graph, supporting conditional branches based on alert priority and working
intervals.

We recommend you create escalation paths in the incident.io dashboard where our path
builder makes it easy to use conditions and visualise the path.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/escalation_paths';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

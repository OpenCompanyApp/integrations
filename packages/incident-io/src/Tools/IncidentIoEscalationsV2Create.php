<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Escalations V2.
 *
 * Maps to the official incident.io endpoint post /v2/escalations.
 */
class IncidentIoEscalationsV2Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_escalations_v2_create';
    protected const DESCRIPTION = 'Create Escalations V2

Official incident.io endpoint: POST /v2/escalations

Create an escalation.

An escalation pages people, either according to an escalation path, or directly to
specific users. You must provide either an escalation_path_id OR user_ids, but not both.

When escalating via an escalation path, the escalation will follow the configured path
with its levels and timeouts, using your default [alert
priority](https://app.incident.io/~/settings/alerts/configuration/priorities).

When escalating directly to users, they will receive a high-urgency
notification, based on their notification rules.

This endpoint is rate-limited to 60 requests per minute, since it is intended for
interactive use cases (for example someone clicking a "escalate to team" button
in your internal developer platform). To escalate based on automated alerts, we
recommend sending events to an alert source instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/escalations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

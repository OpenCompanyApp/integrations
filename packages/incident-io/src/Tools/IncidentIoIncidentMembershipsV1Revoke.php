<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Revoke Incident Memberships V1.
 *
 * Maps to the official incident.io endpoint post /v1/incident_memberships/actions/revoke.
 */
class IncidentIoIncidentMembershipsV1Revoke extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_memberships_v1_revoke';
    protected const DESCRIPTION = 'Revoke Incident Memberships V1

Official incident.io endpoint: POST /v1/incident_memberships/actions/revoke

Revoke a user\'s membership of a private incident';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_memberships/actions/revoke';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

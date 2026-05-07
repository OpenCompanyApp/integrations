<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Incident Memberships V1.
 *
 * Maps to the official incident.io endpoint post /v1/incident_memberships.
 */
class IncidentIoIncidentMembershipsV1Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_incident_memberships_v1_create';
    protected const DESCRIPTION = 'Create Incident Memberships V1

Official incident.io endpoint: POST /v1/incident_memberships

Makes a user a member of a private incident';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_memberships';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateIPAllowlist IPAllowlists V1.
 *
 * Maps to the official incident.io endpoint put /v1/ip_allowlists.
 */
class IncidentIoIpallowlistsV1UpdateIpallowlist extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_ipallowlists_v1_update_ipallowlist';
    protected const DESCRIPTION = 'UpdateIPAllowlist IPAllowlists V1

Official incident.io endpoint: PUT /v1/ip_allowlists

Update the IP allowlist for your organisation';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/ip_allowlists';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

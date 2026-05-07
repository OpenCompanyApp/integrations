<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowIPAllowlist IPAllowlists V1.
 *
 * Maps to the official incident.io endpoint get /v1/ip_allowlists.
 */
class IncidentIoIpallowlistsV1ShowIpallowlist extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_ipallowlists_v1_show_ipallowlist';
    protected const DESCRIPTION = 'ShowIPAllowlist IPAllowlists V1

Official incident.io endpoint: GET /v1/ip_allowlists

Show the IP allowlist for your organisation';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ip_allowlists';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

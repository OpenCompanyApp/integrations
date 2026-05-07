<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Alert Sources V2.
 *
 * Maps to the official incident.io endpoint get /v2/alert_sources.
 */
class IncidentIoAlertSourcesV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_sources_v2_list';
    protected const DESCRIPTION = 'List Alert Sources V2

Official incident.io endpoint: GET /v2/alert_sources

List all alert sources in your account.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/alert_sources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

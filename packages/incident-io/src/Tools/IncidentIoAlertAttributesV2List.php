<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Alert Attributes V2.
 *
 * Maps to the official incident.io endpoint get /v2/alert_attributes.
 */
class IncidentIoAlertAttributesV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_attributes_v2_list';
    protected const DESCRIPTION = 'List Alert Attributes V2

Official incident.io endpoint: GET /v2/alert_attributes

List alert attributes.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/alert_attributes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

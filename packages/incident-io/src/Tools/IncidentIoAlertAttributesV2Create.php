<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Alert Attributes V2.
 *
 * Maps to the official incident.io endpoint post /v2/alert_attributes.
 */
class IncidentIoAlertAttributesV2Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_attributes_v2_create';
    protected const DESCRIPTION = 'Create Alert Attributes V2

Official incident.io endpoint: POST /v2/alert_attributes

Create a new alert attribute.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/alert_attributes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

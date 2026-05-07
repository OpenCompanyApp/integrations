<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * UpdateDataSource Telemetry V2.
 *
 * Maps to the official incident.io endpoint put /v2/telemetry/data_sources/{id}.
 */
class IncidentIoTelemetryV2UpdateDataSource extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_telemetry_v2_update_data_source';
    protected const DESCRIPTION = 'UpdateDataSource Telemetry V2

Official incident.io endpoint: PUT /v2/telemetry/data_sources/{id}

Update the credentials or configuration of a telemetry data source. Provide only the config block that matches your data source type (e.g. grafana_config for Grafana, datadog_config for Datadog). New credentials are validated against the provider before being saved.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Data source ID',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/telemetry/data_sources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

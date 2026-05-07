<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Get the current offsets for the connector. The offsets provide information on the point in the source system, from which the connector is pulling in data. The offsets of a connector are continuously observed periodically and are queryable via this API.
 */
class ConfluentGetConnectv1ConnectorOffsets extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_connectv1_connector_offsets';
}

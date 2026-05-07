<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Pause the connector and its tasks. Stops message processing until the connector is resumed. This call is asynchronous and the tasks will not transition to PAUSED state at the same time.
 */
class ConfluentPauseConnectv1Connector extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_pause_connectv1_connector';
}

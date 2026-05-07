<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Get current status of the connector. This includes whether it is running, failed, or paused. Also includes which worker it is assigned to, error information if it has failed, and the state of all its tasks.
 */
class ConfluentReadConnectv1ConnectorStatus extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_read_connectv1_connector_status';
}

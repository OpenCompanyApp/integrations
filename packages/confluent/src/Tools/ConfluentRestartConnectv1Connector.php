<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Previewhttps://img.shields.io/badge/Lifecycle%20Stage-Preview-%2300afbasection/Versioning/API-Lifecycle-Policy Restart the connector and its tasks. Stops message processing until the connector and tasks are restart. This call is asynchronous and the connector will not transition to another state at the same time.
 */
class ConfluentRestartConnectv1Connector extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_restart_connectv1_connector';
}

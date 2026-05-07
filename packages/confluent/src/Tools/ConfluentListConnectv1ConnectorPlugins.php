<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Return a list of Managed Connector plugins installed in the Kafka Connect cluster.
 */
class ConfluentListConnectv1ConnectorPlugins extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_connectv1_connector_plugins';
}

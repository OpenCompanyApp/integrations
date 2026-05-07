<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Create a new connector using the given configuration, or update the configuration for an existing connector. Returns information about the connector after the change has been made.
 */
class ConfluentCreateOrUpdateConnectv1ConnectorConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_create_or_update_connectv1_connector_config';
}

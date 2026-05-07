<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all custom connect plugins. If no cloud filter is specified, returns custom connect plugins from all clouds.
 */
class ConfluentListCcpmV1CustomConnectPlugins extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_ccpm_v1_custom_connect_plugins';
}

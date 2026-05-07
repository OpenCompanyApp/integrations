<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a list of "names" of the active connectors. You can then make a read requestoperation/readConnectv1Connector for a specific connector by name.
 */
class ConfluentListConnectv1Connectors extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_connectv1_connectors';
}

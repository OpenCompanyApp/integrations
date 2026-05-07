<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve an object with the queried expansions of all connectors. Without expand query parameter, this list connector's endpoint will return a list of only the connector namesoperation/listConnectv1Connectors.
 */
class ConfluentListConnectv1ConnectorsWithExpansions extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_connectv1_connectors_with_expansions';
}

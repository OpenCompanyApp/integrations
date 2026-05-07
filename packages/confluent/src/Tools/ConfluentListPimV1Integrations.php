<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all integrations. If no provider filter is specified, returns provider integrations from all clouds.
 */
class ConfluentListPimV1Integrations extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_pim_v1_integrations';
}

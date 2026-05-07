<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an integration. This request fails if existing workloads are using this CSP integration.
 */
class ConfluentDeletePimV1Integration extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_pim_v1_integration';
}

<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an environment. If successful, this request will also recursively delete all of the environment's associated resources, including all Kafka clusters, connectors, etc.
 */
class ConfluentDeleteOrgV2Environment extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_org_v2_environment';
}

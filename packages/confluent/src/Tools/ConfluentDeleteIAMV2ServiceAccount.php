<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a service account. If successful, this request will also recursively delete all of the service account's associated resources, including its cloud and cluster API keys.
 */
class ConfluentDeleteIAMV2ServiceAccount extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_iam_v2_service_account';
}

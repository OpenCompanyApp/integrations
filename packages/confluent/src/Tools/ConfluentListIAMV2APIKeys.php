<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Retrieve a sorted, filtered, paginated list of all API keys. This can show all keys for a single owner across resources - Kafka clusters, or all keys for a single resource across owners. If no owner or resource filters are specified, returns all API Keys in the organization. You will only see the keys that are accessible to the account making the API request.
 */
class ConfluentListIAMV2APIKeys extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_iam_v2_api_keys';
}

<?php

namespace OpenCompany\Integrations\CustomerIO;

/**
 * Official Customer.io API operation metadata.
 *
 * Generated from Customer.io's App, Track, and Pipelines OpenAPI JSON specs.
 */
class CustomerIOOperations
{
    /**
     * Return Customer.io operations keyed by tool slug.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                "slug" => "customerio_app_add_collection",
                "operation" => "addCollection",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppAddCollection",
                "method" => "POST",
                "path" => "/v1/collections",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create a collection",
                "description" => "Create a new collection and provide the data that you'll access from the collection or the url that you'll download CSV or JSON data from.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_broadcast_action_links",
                "operation" => "broadcastActionLinks",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppBroadcastActionLinks",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/actions/{action_id}/metrics/links",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get broadcast action link metrics",
                "description" => "Returns link click metrics for an individual broadcast action.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_broadcast_action_metrics",
                "operation" => "broadcastActionMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppBroadcastActionMetrics",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/actions/{action_id}/metrics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get broadcast action metrics",
                "description" => "Returns a list of metrics for an individual action both in total and in steps (days, weeks, etc) over a period of time.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_broadcast_actions",
                "operation" => "broadcastActions",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppBroadcastActions",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/actions",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List broadcast actions",
                "description" => "Returns the actions that occur as a part of a broadcast.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_broadcast_errors",
                "operation" => "broadcastErrors",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppBroadcastErrors",
                "method" => "GET",
                "path" => "/v1/campaigns/{broadcast_id}/triggers/{trigger_id}/errors",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get broadcast error descriptions",
                "description" => "If your broadcast produced validation errors, this endpoint can help you better understand what went wrong.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The ID of the broadcast that you want to return information about."
                    ],
                    [
                        "source" => "path",
                        "name" => "trigger_id",
                        "param" => "trigger_id",
                        "required" => true,
                        "description" => "The ID of the campaign trigger that you want to return information for."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_broadcast_links",
                "operation" => "broadcastLinks",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppBroadcastLinks",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/metrics/links",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get broadcast link metrics",
                "description" => "Returns metrics for link clicks within a broadcast, both in total and in series periods (days, weeks, etc).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "unique",
                        "param" => "unique",
                        "required" => false,
                        "description" => "If true, the response contains only unique customer results, i.e."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_broadcast_messages",
                "operation" => "broadcastMessages",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppBroadcastMessages",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/messages",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get messages for a broadcast",
                "description" => "Returns information about the deliveries (instances of messages sent to individual people) sent from an API-triggered broadcast.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "metric",
                        "param" => "metric",
                        "required" => false,
                        "description" => "Determines the metric(s) you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "state",
                        "param" => "state",
                        "required" => false,
                        "description" => "The state of a broadcast."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ],
                    [
                        "source" => "query",
                        "name" => "start_ts",
                        "param" => "start_ts",
                        "required" => false,
                        "description" => "The beginning timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "end_ts",
                        "param" => "end_ts",
                        "required" => false,
                        "description" => "The ending timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "get_tracked_responses",
                        "param" => "get_tracked_responses",
                        "required" => false,
                        "description" => "If true, the response includes tracked_responses for each messagean object containing tracked response option names for in-app survey responses."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_broadcast_metrics",
                "operation" => "broadcastMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppBroadcastMetrics",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/metrics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get broadcast metrics",
                "description" => "Returns a list of metrics for an individual broadcast in steps (days, weeks, etc).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_broadcast_status",
                "operation" => "broadcastStatus",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppBroadcastStatus",
                "method" => "GET",
                "path" => "/v1/campaigns/{broadcast_id}/triggers/{trigger_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get the status of a broadcast",
                "description" => "After triggering a broadcast you can retrieve the status of that broadcast using a GET of the trigger_id.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The ID of the broadcast that you want to return information about."
                    ],
                    [
                        "source" => "path",
                        "name" => "trigger_id",
                        "param" => "trigger_id",
                        "required" => true,
                        "description" => "The ID of the campaign trigger that you want to return information for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_campaign_action_links",
                "operation" => "campaignActionLinks",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCampaignActionLinks",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/actions/{action_id}/metrics/links",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get link metrics for an action",
                "description" => "Returns link click metrics for an individual action.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_campaign_action_metrics",
                "operation" => "campaignActionMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCampaignActionMetrics",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/actions/{action_id}/metrics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get campaign action metrics",
                "description" => "Returns a list of metrics for an individual action.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ],
                    [
                        "source" => "query",
                        "name" => "version",
                        "param" => "version",
                        "required" => true,
                        "description" => "The version of the metrics API to use."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ],
                    [
                        "source" => "query",
                        "name" => "res",
                        "param" => "res",
                        "required" => false,
                        "description" => "**Version 2 only.** Determines increment for metricshourly, daily, weekly, or monthly."
                    ],
                    [
                        "source" => "query",
                        "name" => "tz",
                        "param" => "tz",
                        "required" => false,
                        "description" => "**Version 2 only.** The time zone for the metrics you are requesting."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "**Version 2 only.** The unix timestamp for the beginning of your metrics."
                    ],
                    [
                        "source" => "query",
                        "name" => "end",
                        "param" => "end",
                        "required" => false,
                        "description" => "**Version 2 only.** The unix timestamp for the end of your metrics."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "**Version 1 only.** The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "**Version 1 only.** The number of periods you want to return."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_campaign_journey_metrics",
                "operation" => "campaignJourneyMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCampaignJourneyMetrics",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/journey_metrics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get campaign journey metrics",
                "description" => "Returns a list of Journey Metrics for your campaign.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => true,
                        "description" => "The unix timestamp for the beginning of your journey metrics report."
                    ],
                    [
                        "source" => "query",
                        "name" => "end",
                        "param" => "end",
                        "required" => true,
                        "description" => "The unix timestamp for the end of your journey metrics report."
                    ],
                    [
                        "source" => "query",
                        "name" => "res",
                        "param" => "res",
                        "required" => true,
                        "description" => "Determines increment for metricshourly, daily, weekly, or monthly."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_campaign_link_metrics",
                "operation" => "campaignLinkMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCampaignLinkMetrics",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/metrics/links",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get campaign link metrics",
                "description" => "Returns metrics for link clicks within a campaign, both in total and in series periods (days, weeks, etc).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "unique",
                        "param" => "unique",
                        "required" => false,
                        "description" => "If true, the response contains only unique customer results, i.e."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_campaign_metrics",
                "operation" => "campaignMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCampaignMetrics",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/metrics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get campaign metrics",
                "description" => "Returns a list of metrics for an individual campaign.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "query",
                        "name" => "version",
                        "param" => "version",
                        "required" => true,
                        "description" => "The version of the metrics API to use."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ],
                    [
                        "source" => "query",
                        "name" => "res",
                        "param" => "res",
                        "required" => false,
                        "description" => "**Version 2 only.** Determines increment for metricshourly, daily, weekly, or monthly."
                    ],
                    [
                        "source" => "query",
                        "name" => "tz",
                        "param" => "tz",
                        "required" => false,
                        "description" => "**Version 2 only.** The time zone for the metrics you are requesting."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "**Version 2 only.** The unix timestamp for the beginning of your metrics."
                    ],
                    [
                        "source" => "query",
                        "name" => "end",
                        "param" => "end",
                        "required" => false,
                        "description" => "**Version 2 only.** The unix timestamp for the end of your metrics."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "**Version 1 only.** The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "**Version 1 only.** The number of periods you want to return."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_create_asset",
                "operation" => "createAsset",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateAsset",
                "method" => "POST",
                "path" => "/v1/assets/files",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create a file asset",
                "description" => "Creates a new file asset.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "file"
                ],
                "content_type" => "multipart/form-data"
            ],
            [
                "slug" => "customerio_app_create_asset_folder",
                "operation" => "createAssetFolder",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateAssetFolder",
                "method" => "POST",
                "path" => "/v1/assets/folders",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create a folder",
                "description" => "Creates a new folder for organizing file assets.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "name"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_component",
                "operation" => "createComponent",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateComponent",
                "method" => "POST",
                "path" => "/v1/design_studio/components",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create a component",
                "description" => "Creates a custom component.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "name",
                    "tag",
                    "content"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_email",
                "operation" => "createEmail",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateEmail",
                "method" => "POST",
                "path" => "/v1/design_studio/emails",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create an email",
                "description" => "Create an email.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "name"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_email_translation",
                "operation" => "createEmailTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateEmailTranslation",
                "method" => "POST",
                "path" => "/v1/design_studio/emails/{id}/languages",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create an email translation",
                "description" => "Creates a new translation for an email.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the email."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "language"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_folder",
                "operation" => "createFolder",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateFolder",
                "method" => "POST",
                "path" => "/v1/design_studio/folders",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create a folder",
                "description" => "Create a new folder at the root level or under a parent folder.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "name"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_man_segment",
                "operation" => "createManSegment",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateManSegment",
                "method" => "POST",
                "path" => "/v1/segments",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create a manual segment",
                "description" => "Create a manual segment with a name and a description.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "segment"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_newsletter",
                "operation" => "createNewsletter",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateNewsletter",
                "method" => "POST",
                "path" => "/v1/newsletters",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create and send a newsletter",
                "description" => "Create a newsletter and optionally schedule it or send it immediately.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_newsletter_language_variant",
                "operation" => "createNewsletterLanguageVariant",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateNewsletterLanguageVariant",
                "method" => "POST",
                "path" => "/v1/newsletters/{newsletter_id}/language",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Add a translation to a newsletter",
                "description" => "Add a language variant to a newsletter.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_newsletter_test_group",
                "operation" => "createNewsletterTestGroup",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateNewsletterTestGroup",
                "method" => "POST",
                "path" => "/v1/newsletters/{newsletter_id}/test_groups",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create an A/B test group for a newsletter",
                "description" => "Create a new A/B test group for a newsletter.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_newsletter_test_language_variant",
                "operation" => "createNewsletterTestLanguageVariant",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateNewsletterTestLanguageVariant",
                "method" => "POST",
                "path" => "/v1/newsletters/{newsletter_id}/test_group/{test_group_id}/language",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Add a translation to a newsletter test group",
                "description" => "Add a language variant to a specific A/B test group in a newsletter.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "test_group_id",
                        "param" => "test_group_id",
                        "required" => true,
                        "description" => "The ID of the A/B test group."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_snippet",
                "operation" => "createSnippet",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateSnippet",
                "method" => "POST",
                "path" => "/v1/snippets",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create a snippet",
                "description" => "Create a new snippet.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "name",
                    "value"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_create_webhook",
                "operation" => "createWebhook",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppCreateWebhook",
                "method" => "POST",
                "path" => "/v1/reporting_webhooks",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Create a reporting webhook",
                "description" => "Create a new webhook configuration.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "name",
                    "endpoint",
                    "events"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_delete_asset",
                "operation" => "deleteAsset",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteAsset",
                "method" => "DELETE",
                "path" => "/v1/assets/files/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a file asset",
                "description" => "Soft-deletes a file asset by setting its deleted_at timestamp.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The unique identifier of the resource."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_asset_folder",
                "operation" => "deleteAssetFolder",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteAssetFolder",
                "method" => "DELETE",
                "path" => "/v1/assets/folders/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a folder",
                "description" => "Soft-deletes an empty folder.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The unique identifier of the resource."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_collection",
                "operation" => "deleteCollection",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteCollection",
                "method" => "DELETE",
                "path" => "/v1/collections/{collection_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a collection",
                "description" => "Remove a collection and associated contents.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collection_id",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "The identifier for a collection."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_component",
                "operation" => "deleteComponent",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteComponent",
                "method" => "DELETE",
                "path" => "/v1/design_studio/components/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a component",
                "description" => "Delete a component.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the component."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_email",
                "operation" => "deleteEmail",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteEmail",
                "method" => "DELETE",
                "path" => "/v1/design_studio/emails/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete an email",
                "description" => "Delete an email.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the email."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_email_translation",
                "operation" => "deleteEmailTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteEmailTranslation",
                "method" => "DELETE",
                "path" => "/v1/design_studio/emails/{id}/languages/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete an email translation",
                "description" => "Delete a specific language translation from an email.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the email."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A that indicates the language of your translated email."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_folder",
                "operation" => "deleteFolder",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteFolder",
                "method" => "DELETE",
                "path" => "/v1/design_studio/folders/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a folder",
                "description" => "Delete a folder **including subfolders and all file (components, templates, and emails)**.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the folder."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_man_segment",
                "operation" => "deleteManSegment",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteManSegment",
                "method" => "DELETE",
                "path" => "/v1/segments/{segment_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a segment",
                "description" => "Delete a manual segment.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "segment_id",
                        "param" => "segment_id",
                        "required" => true,
                        "description" => "The identifier for a segment."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_newsletter_language_variant",
                "operation" => "deleteNewsletterLanguageVariant",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteNewsletterLanguageVariant",
                "method" => "DELETE",
                "path" => "/v1/newsletters/{newsletter_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a translation of a newsletter",
                "description" => "Delete a specific language variant of a newsletter.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_newsletter_test_language_variant",
                "operation" => "deleteNewsletterTestLanguageVariant",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteNewsletterTestLanguageVariant",
                "method" => "DELETE",
                "path" => "/v1/newsletters/{newsletter_id}/test_group/{test_group_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a translation in a newsletter test group",
                "description" => "Delete a specific language variant of a newsletter in an A/B test group.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "test_group_id",
                        "param" => "test_group_id",
                        "required" => true,
                        "description" => "The ID of the A/B test group."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_newsletters",
                "operation" => "deleteNewsletters",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteNewsletters",
                "method" => "DELETE",
                "path" => "/v1/newsletters/{newsletter_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a newsletter",
                "description" => "Deletes an individual newsletter, including content, settings, and metrics.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_snippet",
                "operation" => "deleteSnippet",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteSnippet",
                "method" => "DELETE",
                "path" => "/v1/snippets/{snippet_name}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a snippet",
                "description" => "Remove a snippet.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "snippet_name",
                        "param" => "snippet_name",
                        "required" => true,
                        "description" => "The name of a snippet."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_suppression",
                "operation" => "deleteSuppression",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteSuppression",
                "method" => "DELETE",
                "path" => "/v1/esp/suppression/{suppression_type}/{email_address}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Un-suppress an ESP-suppressed address",
                "description" => "Remove an address from the ESP's suppression list.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "suppression_type",
                        "param" => "suppression_type",
                        "required" => true,
                        "description" => "The reason a person's email address was suppressed by the email service provider (ESP)."
                    ],
                    [
                        "source" => "path",
                        "name" => "email_address",
                        "param" => "email_address",
                        "required" => true,
                        "description" => "The email address of the person you want to look up."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_delete_webhook",
                "operation" => "deleteWebhook",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDeleteWebhook",
                "method" => "DELETE",
                "path" => "/v1/reporting_webhooks/{webhook_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Delete a reporting webhook",
                "description" => "Delete a reporting webhook's configuration.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "webhook_id",
                        "param" => "webhook_id",
                        "required" => true,
                        "description" => "The identifier of a webhook."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_download_export",
                "operation" => "downloadExport",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppDownloadExport",
                "method" => "GET",
                "path" => "/v1/exports/{export_id}/download",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Download an export",
                "description" => "This endpoint returns a signed link to download an export.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "export_id",
                        "param" => "export_id",
                        "required" => true,
                        "description" => "The export_id you want to access."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_export_deliveries_data",
                "operation" => "exportDeliveriesData",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppExportDeliveriesData",
                "method" => "POST",
                "path" => "/v1/exports/deliveries",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Export information about deliveries",
                "description" => "Provide filters for the newsletter, campaign, or action you want to return delivery information from.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_export_people_data",
                "operation" => "exportPeopleData",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppExportPeopleData",
                "method" => "POST",
                "path" => "/v1/exports/customers",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Export customer data",
                "description" => "Provide filters and attributes describing the customers you want to export.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "filters"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_get_archived_message",
                "operation" => "getArchivedMessage",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetArchivedMessage",
                "method" => "GET",
                "path" => "/v1/messages/{message_id}/archived_message",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get an archived message",
                "description" => "Returns the archived copy of a delivery, including the message body, recipient, and metrics.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "message_id",
                        "param" => "message_id",
                        "required" => true,
                        "description" => "The identifier of a message."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_asset",
                "operation" => "getAsset",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetAsset",
                "method" => "GET",
                "path" => "/v1/assets/files/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a file asset",
                "description" => "Retrieves a single file asset by its ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The unique identifier of the resource."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_asset_folder",
                "operation" => "getAssetFolder",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetAssetFolder",
                "method" => "GET",
                "path" => "/v1/assets/folders/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a folder",
                "description" => "Retrieves a single folder by its ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The unique identifier of the resource."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_broadcast",
                "operation" => "getBroadcast",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetBroadcast",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a broadcast",
                "description" => "Returns metadata for an individual broadcast.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_broadcast_action",
                "operation" => "getBroadcastAction",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetBroadcastAction",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/actions/{action_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a broadcast action",
                "description" => "Returns information about a specific action within a broadcast.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_broadcast_action_language",
                "operation" => "getBroadcastActionLanguage",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetBroadcastActionLanguage",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/actions/{action_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a translation of a broadcast message",
                "description" => "Returns information about a translation of message in a broadcast.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_campaign_action",
                "operation" => "getCampaignAction",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetCampaignAction",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/actions/{action_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a campaign action",
                "description" => "Returns information about a specific action in a campaign.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_campaign_action_translation",
                "operation" => "getCampaignActionTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetCampaignActionTranslation",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/actions/{action_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a translation of a campaign message",
                "description" => "Returns a translated version of a message in a campaign.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_campaign_messages",
                "operation" => "getCampaignMessages",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetCampaignMessages",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/messages",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get campaign message metadata",
                "description" => "Returns information about the deliveries (instances of messages sent to individual people) sent from a campaign.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ],
                    [
                        "source" => "query",
                        "name" => "metric",
                        "param" => "metric",
                        "required" => false,
                        "description" => "Determines the metric(s) you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "drafts",
                        "param" => "drafts",
                        "required" => false,
                        "description" => "If true, your request returns drafts rather than active/sent messages."
                    ],
                    [
                        "source" => "query",
                        "name" => "start_ts",
                        "param" => "start_ts",
                        "required" => false,
                        "description" => "The beginning timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "end_ts",
                        "param" => "end_ts",
                        "required" => false,
                        "description" => "The ending timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "get_tracked_responses",
                        "param" => "get_tracked_responses",
                        "required" => false,
                        "description" => "If true, the response includes tracked_responses for each messagean object containing tracked response option names for in-app survey responses."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_campaigns",
                "operation" => "getCampaigns",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetCampaigns",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a campaign",
                "description" => "Returns metadata for an individual campaign.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_channels",
                "operation" => "getChannels",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetChannels",
                "method" => "GET",
                "path" => "/v1/subscription_channels",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List subscription channels",
                "description" => "Returns a list of subscription channels available in your workspace.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_cio_allowlist",
                "operation" => "getCioAllowlist",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetCioAllowlist",
                "method" => "GET",
                "path" => "/v1/info/ip_addresses",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List IP addresses",
                "description" => "Returns a list of IP addresses that you need to allowlist if you're using a firewall or provider's IP access management settings to deny access to unknown IP addresses.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_collection",
                "operation" => "getCollection",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetCollection",
                "method" => "GET",
                "path" => "/v1/collections/{collection_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Lookup a collection",
                "description" => "Retrieves details about a collection, including the schema and name.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collection_id",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "The identifier for a collection."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_collection_contents",
                "operation" => "getCollectionContents",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetCollectionContents",
                "method" => "GET",
                "path" => "/v1/collections/{collection_id}/content",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Lookup collection contents",
                "description" => "Retrieve the contents of a collection (the data from when you created or updated a collection).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collection_id",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "The identifier for a collection."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_collections",
                "operation" => "getCollections",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetCollections",
                "method" => "GET",
                "path" => "/v1/collections",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List your collections",
                "description" => "Returns a list of all of your collections, including the name and schema for each collection.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_component",
                "operation" => "getComponent",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetComponent",
                "method" => "GET",
                "path" => "/v1/design_studio/components/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a component",
                "description" => "Returns a single component with its full content.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the component."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_domain_suppressions_by_type",
                "operation" => "getDomainSuppressionsByType",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetDomainSuppressionsByType",
                "method" => "GET",
                "path" => "/v1/esp/domains/{domain_name}/suppression/{suppression_type}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get ESP-suppressed emails by domain",
                "description" => "Find addresses suppressed by the Email Service Provider (ESP) for a particular reason on a specific sending domain.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "domain_name",
                        "param" => "domain_name",
                        "required" => true,
                        "description" => "The sending domain you want to look up suppressions for."
                    ],
                    [
                        "source" => "path",
                        "name" => "suppression_type",
                        "param" => "suppression_type",
                        "required" => true,
                        "description" => "The reason a person's email address was suppressed by the email service provider (ESP)."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "email",
                        "param" => "email",
                        "required" => false,
                        "description" => "Filter results to a specific email address."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_email",
                "operation" => "getEmail",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetEmail",
                "method" => "GET",
                "path" => "/v1/design_studio/emails/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get an email",
                "description" => "Returns a single email including content, envelope details, and transformers.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the email."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_email_translation",
                "operation" => "getEmailTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetEmailTranslation",
                "method" => "GET",
                "path" => "/v1/design_studio/emails/{id}/languages/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get an email translation",
                "description" => "Returns a single email translation by language code, including content, envelope, and transformers.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the email."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A that indicates the language of your translated email."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_export",
                "operation" => "getExport",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetExport",
                "method" => "GET",
                "path" => "/v1/exports/{export_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get an export",
                "description" => "Return information about a specific export.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "export_id",
                        "param" => "export_id",
                        "required" => true,
                        "description" => "The export_id you want to access."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_folder",
                "operation" => "getFolder",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetFolder",
                "method" => "GET",
                "path" => "/v1/design_studio/folders/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a folder",
                "description" => "Get a folder by its UUID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the folder."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_import",
                "operation" => "getImport",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetImport",
                "method" => "GET",
                "path" => "/v1/imports/{import_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Retrieve a bulk import",
                "description" => "This endpoint returns information about an \"import\"a CSV file containing a group of people or events you uploaded to using v1/imports endpoint.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "import_id",
                        "param" => "import_id",
                        "required" => true,
                        "description" => "The id of the import you want to lookup."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_message",
                "operation" => "getMessage",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetMessage",
                "method" => "GET",
                "path" => "/v1/messages/{message_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a message",
                "description" => "Return a information about, and metrics for, a deliverythe instance of a message intended for an individual recipient person.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "message_id",
                        "param" => "message_id",
                        "required" => true,
                        "description" => "The identifier of a message."
                    ],
                    [
                        "source" => "query",
                        "name" => "get_tracked_responses",
                        "param" => "get_tracked_responses",
                        "required" => false,
                        "description" => "If true, the response includes tracked_responses for each messagean object containing tracked response option names for in-app survey responses."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_newsletter_links",
                "operation" => "getNewsletterLinks",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetNewsletterLinks",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/metrics/links",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get click metrics for newsletter links",
                "description" => "Returns metrics for link clicks within a newsletter, both in total and in series periods (days, weeks, etc).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "unique",
                        "param" => "unique",
                        "required" => false,
                        "description" => "If true, the response contains only unique customer results, i.e."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_newsletter_metrics",
                "operation" => "getNewsletterMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetNewsletterMetrics",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/metrics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get newsletter metrics",
                "description" => "Returns a list of metrics for an individual newsletter in steps (days, weeks, etc).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_newsletter_msg_meta",
                "operation" => "getNewsletterMsgMeta",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetNewsletterMsgMeta",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/messages",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get delivery data for a newsletter",
                "description" => "Returns information about the \"deliveries\" (rendered messages) sent to your recipients for a specific newsletter.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "metric",
                        "param" => "metric",
                        "required" => false,
                        "description" => "Determines the metric(s) you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "start_ts",
                        "param" => "start_ts",
                        "required" => false,
                        "description" => "The beginning timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "end_ts",
                        "param" => "end_ts",
                        "required" => false,
                        "description" => "The ending timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "get_tracked_responses",
                        "param" => "get_tracked_responses",
                        "required" => false,
                        "description" => "If true, the response includes tracked_responses for each messagean object containing tracked response option names for in-app survey responses."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_newsletter_test_groups",
                "operation" => "getNewsletterTestGroups",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetNewsletterTestGroups",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/test_groups",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List a newsletter's A/B test groups",
                "description" => "Returns information about each test group in a newsletter, including content ids for each group.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_newsletter_variant",
                "operation" => "getNewsletterVariant",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetNewsletterVariant",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/contents/{content_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a newsletter variant",
                "description" => "Returns information about a specific variant of a newsletter, where a variant is either a language in a multi-language newsletter or a part of an A/B test.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "content_id",
                        "param" => "content_id",
                        "required" => true,
                        "description" => "The identifier of a message in a newsletter."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_newsletter_variant_translation",
                "operation" => "getNewsletterVariantTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetNewsletterVariantTranslation",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a newsletter translation",
                "description" => "Returns information about a specific language variant of a newsletter.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_newsletter_variant_translation_test",
                "operation" => "getNewsletterVariantTranslationTest",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetNewsletterVariantTranslationTest",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/test_group/{test_group_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a translation in a newsletter test group",
                "description" => "Returns information about a specific language variant of a newsletter in an A/B test group.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "test_group_id",
                        "param" => "test_group_id",
                        "required" => true,
                        "description" => "The ID of the A/B test group."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_newsletters",
                "operation" => "getNewsletters",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetNewsletters",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a newsletter",
                "description" => "Returns metadata for an individual newsletter.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_object_attributes",
                "operation" => "getObjectAttributes",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetObjectAttributes",
                "method" => "GET",
                "path" => "/v1/objects/{object_type_id}/{object_id}/attributes",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get Object Attributes",
                "description" => "Get a list of attributes for an object.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "object_type_id",
                        "param" => "object_type_id",
                        "required" => true,
                        "description" => "The object type an object belongs tolike \"Companies\" or \"Accounts\"."
                    ],
                    [
                        "source" => "path",
                        "name" => "object_id",
                        "param" => "object_id",
                        "required" => true,
                        "description" => "The object_id or cio_object_id of an object, depending on the id_type specified in query params."
                    ],
                    [
                        "source" => "query",
                        "name" => "id_type",
                        "param" => "id_type",
                        "required" => false,
                        "description" => "."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_object_relationships",
                "operation" => "getObjectRelationships",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetObjectRelationships",
                "method" => "GET",
                "path" => "/v1/objects/{object_type_id}/{object_id}/relationships",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get Object Relationships",
                "description" => "Get a list of people people related to an object.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "object_type_id",
                        "param" => "object_type_id",
                        "required" => true,
                        "description" => "The object type an object belongs tolike \"Companies\" or \"Accounts\"."
                    ],
                    [
                        "source" => "path",
                        "name" => "object_id",
                        "param" => "object_id",
                        "required" => true,
                        "description" => "The object_id or cio_object_id of an object, depending on the id_type specified in query params."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "id_type",
                        "param" => "id_type",
                        "required" => false,
                        "description" => "."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_object_types",
                "operation" => "getObjectTypes",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetObjectTypes",
                "method" => "GET",
                "path" => "/v1/object_types",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List object types",
                "description" => "Returns a list of object types in your system.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_objects_filter",
                "operation" => "getObjectsFilter",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetObjectsFilter",
                "method" => "POST",
                "path" => "/v1/objects",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Find objects",
                "description" => "Use a set of filter conditions to find objects in your workspace.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "object_type_id",
                    "filter"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_get_people_by_id",
                "operation" => "getPeopleById",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPeopleByID",
                "method" => "POST",
                "path" => "/v1/customers/attributes",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "List customers, attributes, and devices",
                "description" => "Return attributes and devices for up to 100 customers by ID.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "ids"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_get_people_email",
                "operation" => "getPeopleEmail",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPeopleEmail",
                "method" => "GET",
                "path" => "/v1/customers",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get customers by email",
                "description" => "Return a list of people in your workspace matching an email address.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "email",
                        "param" => "email",
                        "required" => true,
                        "description" => "The email address you want to search for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_people_filter",
                "operation" => "getPeopleFilter",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPeopleFilter",
                "method" => "POST",
                "path" => "/v1/customers",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Search for customers",
                "description" => "Provide a filter to search for people in your workspace.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "filter"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_get_person_activities",
                "operation" => "getPersonActivities",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPersonActivities",
                "method" => "GET",
                "path" => "/v1/customers/{customer_id}/activities",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Lookup a customer's activities",
                "description" => "Return a list of activities performed by, or for, a customer.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "customer_id",
                        "param" => "customer_id",
                        "required" => true,
                        "description" => "The ID of the customer you want to perform an operation against."
                    ],
                    [
                        "source" => "query",
                        "name" => "id_type",
                        "param" => "id_type",
                        "required" => false,
                        "description" => "The type of customer_id you want to use to reference a person."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of activity you want to search for."
                    ],
                    [
                        "source" => "query",
                        "name" => "name",
                        "param" => "name",
                        "required" => false,
                        "description" => "For event and attribute_update types, you can search by event or attribute name respectively."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_person_attributes",
                "operation" => "getPersonAttributes",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPersonAttributes",
                "method" => "GET",
                "path" => "/v1/customers/{customer_id}/attributes",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Lookup a customer's attributes",
                "description" => "Return a list of attributes for a customer profile.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "customer_id",
                        "param" => "customer_id",
                        "required" => true,
                        "description" => "The ID of the customer you want to perform an operation against."
                    ],
                    [
                        "source" => "query",
                        "name" => "id_type",
                        "param" => "id_type",
                        "required" => false,
                        "description" => "The type of customer_id you want to use to reference a person."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_person_messages",
                "operation" => "getPersonMessages",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPersonMessages",
                "method" => "GET",
                "path" => "/v1/customers/{customer_id}/messages",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Lookup messages sent to a customer",
                "description" => "Returns information about the deliveries sent to a person.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "customer_id",
                        "param" => "customer_id",
                        "required" => true,
                        "description" => "The ID of the customer you want to perform an operation against."
                    ],
                    [
                        "source" => "query",
                        "name" => "id_type",
                        "param" => "id_type",
                        "required" => false,
                        "description" => "The type of customer_id you want to use to reference a person."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "start_ts",
                        "param" => "start_ts",
                        "required" => false,
                        "description" => "The beginning timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "end_ts",
                        "param" => "end_ts",
                        "required" => false,
                        "description" => "The ending timestamp for your query."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_person_relationships",
                "operation" => "getPersonRelationships",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPersonRelationships",
                "method" => "GET",
                "path" => "/v1/customers/{customer_id}/relationships",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Lookup a customer's relationships",
                "description" => "Return a list of objects that a person is related to.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "customer_id",
                        "param" => "customer_id",
                        "required" => true,
                        "description" => "The ID of the customer you want to perform an operation against."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_person_segments",
                "operation" => "getPersonSegments",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPersonSegments",
                "method" => "GET",
                "path" => "/v1/customers/{customer_id}/segments",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Lookup a customer's segments",
                "description" => "Returns a list of segments that a customer profile belongs to.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "customer_id",
                        "param" => "customer_id",
                        "required" => true,
                        "description" => "The ID of the customer you want to perform an operation against."
                    ],
                    [
                        "source" => "query",
                        "name" => "id_type",
                        "param" => "id_type",
                        "required" => false,
                        "description" => "The type of customer_id you want to use to reference a person."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_person_subscription_preferences",
                "operation" => "getPersonSubscriptionPreferences",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetPersonSubscriptionPreferences",
                "method" => "GET",
                "path" => "/v1/customers/{customer_id}/subscription_preferences",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Lookup a customer's subscription preferences",
                "description" => "Returns a list of subscription preferences for a person, including the custom header of the subscription preferences page, topic names, and topic descriptions.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "customer_id",
                        "param" => "customer_id",
                        "required" => true,
                        "description" => "The ID of the customer you want to perform an operation against."
                    ],
                    [
                        "source" => "query",
                        "name" => "id_type",
                        "param" => "id_type",
                        "required" => false,
                        "description" => "The type of customer_id you want to use to reference a person."
                    ],
                    [
                        "source" => "query",
                        "name" => "language",
                        "param" => "language",
                        "required" => false,
                        "description" => "A you want the content translated in."
                    ],
                    [
                        "source" => "header",
                        "name" => "Accept-Language",
                        "param" => "accept_language",
                        "required" => false,
                        "description" => "."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_segment",
                "operation" => "getSegment",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSegment",
                "method" => "GET",
                "path" => "/v1/segments/{segment_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a segment",
                "description" => "Return information about a segment.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "segment_id",
                        "param" => "segment_id",
                        "required" => true,
                        "description" => "The identifier for a segment."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_segment_count",
                "operation" => "getSegmentCount",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSegmentCount",
                "method" => "GET",
                "path" => "/v1/segments/{segment_id}/customer_count",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a segment customer count",
                "description" => "Returns the membership count for a segment.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "segment_id",
                        "param" => "segment_id",
                        "required" => true,
                        "description" => "The identifier for a segment."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_segment_dependencies",
                "operation" => "getSegmentDependencies",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSegmentDependencies",
                "method" => "GET",
                "path" => "/v1/segments/{segment_id}/used_by",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a segment's dependencies",
                "description" => "Use this endpoint to find out which campaigns and newsletters use a segment.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "segment_id",
                        "param" => "segment_id",
                        "required" => true,
                        "description" => "The identifier for a segment."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_segment_membership",
                "operation" => "getSegmentMembership",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSegmentMembership",
                "method" => "GET",
                "path" => "/v1/segments/{segment_id}/membership",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List customers in a segment",
                "description" => "Returns customers in a segment.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "segment_id",
                        "param" => "segment_id",
                        "required" => true,
                        "description" => "The identifier for a segment."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_sender",
                "operation" => "getSender",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSender",
                "method" => "GET",
                "path" => "/v1/sender_identities/{sender_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a sender",
                "description" => "Returns information about a specific sender.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "sender_id",
                        "param" => "sender_id",
                        "required" => true,
                        "description" => "The identifier of a sender."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_sender_usage",
                "operation" => "getSenderUsage",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSenderUsage",
                "method" => "GET",
                "path" => "/v1/sender_identities/{sender_id}/used_by",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get sender usage data",
                "description" => "Returns lists of the campaigns and newsletters that use a sender.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "sender_id",
                        "param" => "sender_id",
                        "required" => true,
                        "description" => "The identifier of a sender."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_subscription_center_token",
                "operation" => "getSubscriptionCenterToken",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSubscriptionCenterToken",
                "method" => "GET",
                "path" => "/v1/subscription_center/{customer_id}/token",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Generate a subscription center token",
                "description" => "Generates a signed token and URL for a person's standalone subscription center page.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "customer_id",
                        "param" => "customer_id",
                        "required" => true,
                        "description" => "The identifier for a person in your workspacethe same value you'd use as an id or email to identify a person in Customer.io."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_suppression",
                "operation" => "getSuppression",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSuppression",
                "method" => "GET",
                "path" => "/v1/esp/search_suppression/{email_address}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Look up an ESP-suppressed address",
                "description" => "Look up an email address to learn if, and why, it was suppressed by the email service provider (ESP).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "email_address",
                        "param" => "email_address",
                        "required" => true,
                        "description" => "The email address of the person you want to look up."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_suppression_by_type",
                "operation" => "getSuppressionByType",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetSuppressionByType",
                "method" => "GET",
                "path" => "/v1/esp/suppression/{suppression_type}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get ESP-suppressed emails by type",
                "description" => "Find addresses suppressed by the Email Service Provider (ESP) for a particular reasonbounces, blocks, spam reports, or invalid email addresses.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "suppression_type",
                        "param" => "suppression_type",
                        "required" => true,
                        "description" => "The reason a person's email address was suppressed by the email service provider (ESP)."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "offset",
                        "param" => "offset",
                        "required" => false,
                        "description" => "The number of records to skip before retrieving results."
                    ],
                    [
                        "source" => "query",
                        "name" => "domain",
                        "param" => "domain",
                        "required" => false,
                        "description" => "Filter by sending domain."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_topics",
                "operation" => "getTopics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetTopics",
                "method" => "GET",
                "path" => "/v1/subscription_topics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List subscription topics",
                "description" => "Returns a list of subscription topics in your workspace.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_transactional",
                "operation" => "getTransactional",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetTransactional",
                "method" => "GET",
                "path" => "/v1/transactional/{transactional_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a transactional message",
                "description" => "Returns information about an individual transactional message.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "transactional_id",
                        "param" => "transactional_id",
                        "required" => true,
                        "description" => "The identifier of your transactional message."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_transactional_variant",
                "operation" => "getTransactionalVariant",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetTransactionalVariant",
                "method" => "GET",
                "path" => "/v1/transactional/{transactional_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a translation of a transactional message",
                "description" => "Returns information about a translation of an individual transactional message, including the message content.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "transactional_id",
                        "param" => "transactional_id",
                        "required" => true,
                        "description" => "The identifier of your transactional message."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_variant_links",
                "operation" => "getVariantLinks",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetVariantLinks",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/contents/{content_id}/metrics/links",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get click metrics for links in newsletter variants",
                "description" => "Returns link click metrics for an individual newsletter variantan individual language in a multi-language newsletter or a message in an A/B test.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "content_id",
                        "param" => "content_id",
                        "required" => true,
                        "description" => "The identifier of a message in a newsletter."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_variant_metrics",
                "operation" => "getVariantMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetVariantMetrics",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/contents/{content_id}/metrics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get metrics for a test or translation variant of a newsletter",
                "description" => "Returns a metrics for an individual newsletter varianteither an individual language in a multi-language newsletter or a message in an A/B test.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "content_id",
                        "param" => "content_id",
                        "required" => true,
                        "description" => "The identifier of a message in a newsletter."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_get_webhook",
                "operation" => "getWebhook",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppGetWebhook",
                "method" => "GET",
                "path" => "/v1/reporting_webhooks/{webhook_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get a reporting webhook",
                "description" => "Returns information about a specific reporting webhook.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "webhook_id",
                        "param" => "webhook_id",
                        "required" => true,
                        "description" => "The identifier of a webhook."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_import",
                "operation" => "import",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppImport",
                "method" => "POST",
                "path" => "/v1/imports",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Import items in bulk",
                "description" => "This endpoint lets you upload a CSV file containing people, events, objects, or relationships.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "import"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_list_activities",
                "operation" => "listActivities",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListActivities",
                "method" => "GET",
                "path" => "/v1/activities",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List activities",
                "description" => "This endpoint returns a list of \"activities\" for people, similar to your workspace's Activity Logs.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of activity you want to search for."
                    ],
                    [
                        "source" => "query",
                        "name" => "name",
                        "param" => "name",
                        "required" => false,
                        "description" => "The name of the event or attribute you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "deleted",
                        "param" => "deleted",
                        "required" => false,
                        "description" => "If true, return results for deleted people."
                    ],
                    [
                        "source" => "query",
                        "name" => "customer_id",
                        "param" => "customer_id",
                        "required" => false,
                        "description" => "The identifier of the person you want to look up."
                    ],
                    [
                        "source" => "query",
                        "name" => "id_type",
                        "param" => "id_type",
                        "required" => false,
                        "description" => "The type of customer_id you want to use to reference a person."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_asset_folders",
                "operation" => "listAssetFolders",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListAssetFolders",
                "method" => "GET",
                "path" => "/v1/assets/folders",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List folders",
                "description" => "Returns a paginated list of asset folders.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "parent_folder_id",
                        "param" => "parent_folder_id",
                        "required" => false,
                        "description" => "Filter results to a specific parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "direct_descendants_only",
                        "param" => "direct_descendants_only",
                        "required" => false,
                        "description" => "If true, this returns only children of the parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "page",
                        "param" => "page",
                        "required" => false,
                        "description" => "The page number of results you want to display."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "Limit the number of results per page."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_assets",
                "operation" => "listAssets",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListAssets",
                "method" => "GET",
                "path" => "/v1/assets",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List file assets",
                "description" => "Returns a paginated list of file assets.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "parent_folder_id",
                        "param" => "parent_folder_id",
                        "required" => false,
                        "description" => "Filter results to a specific parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "direct_descendants_only",
                        "param" => "direct_descendants_only",
                        "required" => false,
                        "description" => "If true, this returns only children of the parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "page",
                        "param" => "page",
                        "required" => false,
                        "description" => "The page number of results you want to display."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "Limit the number of results per page."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_broadcast_triggers",
                "operation" => "listBroadcastTriggers",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListBroadcastTriggers",
                "method" => "GET",
                "path" => "/v1/broadcasts/{broadcast_id}/triggers",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get broadcast triggers",
                "description" => "Returns a list of the triggers for a broadcast.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_broadcasts",
                "operation" => "listBroadcasts",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListBroadcasts",
                "method" => "GET",
                "path" => "/v1/broadcasts",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List broadcasts",
                "description" => "Returns a list of your API-triggered broadcasts and associated metadata.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_campaign_actions",
                "operation" => "listCampaignActions",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListCampaignActions",
                "method" => "GET",
                "path" => "/v1/campaigns/{campaign_id}/actions",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List campaign actions",
                "description" => "Returns the operations in a campaign workflow.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_campaigns",
                "operation" => "listCampaigns",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListCampaigns",
                "method" => "GET",
                "path" => "/v1/campaigns",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List campaigns",
                "description" => "Returns a list of your campaigns and associated metadata.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_components",
                "operation" => "listComponents",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListComponents",
                "method" => "GET",
                "path" => "/v1/design_studio/components",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List components",
                "description" => "Returns a paginated list of components and any folders in the result set.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "tag",
                        "param" => "tag",
                        "required" => false,
                        "description" => "Filter by component tag name."
                    ],
                    [
                        "source" => "query",
                        "name" => "page",
                        "param" => "page",
                        "required" => false,
                        "description" => "The page number of results you want to display."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "Limit the number of results per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "parent_folder_id",
                        "param" => "parent_folder_id",
                        "required" => false,
                        "description" => "Filter by parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "direct_descendants_only",
                        "param" => "direct_descendants_only",
                        "required" => false,
                        "description" => "If true, this returns only children of the parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_by",
                        "param" => "sort_by",
                        "required" => false,
                        "description" => "."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_order",
                        "param" => "sort_order",
                        "required" => false,
                        "description" => "."
                    ],
                    [
                        "source" => "query",
                        "name" => "created_before",
                        "param" => "created_before",
                        "required" => false,
                        "description" => "Return records created before this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "created_after",
                        "param" => "created_after",
                        "required" => false,
                        "description" => "Return records created after this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "updated_before",
                        "param" => "updated_before",
                        "required" => false,
                        "description" => "Return records updated before this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "updated_after",
                        "param" => "updated_after",
                        "required" => false,
                        "description" => "Return records updated after this time."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_email_translations",
                "operation" => "listEmailTranslations",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListEmailTranslations",
                "method" => "GET",
                "path" => "/v1/design_studio/emails/{id}/languages",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List email translations",
                "description" => "Returns all translations for an email.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the email."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_emails",
                "operation" => "listEmails",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListEmails",
                "method" => "GET",
                "path" => "/v1/design_studio/emails",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List emails",
                "description" => "Returns a paginated list of emails and a separate array of folders that the emails belong to.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "page",
                        "param" => "page",
                        "required" => false,
                        "description" => "The page number of results you want to display."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "Limit the number of results per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "parent_folder_id",
                        "param" => "parent_folder_id",
                        "required" => false,
                        "description" => "Filter by parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "direct_descendants_only",
                        "param" => "direct_descendants_only",
                        "required" => false,
                        "description" => "If true, this returns only children of the parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_by",
                        "param" => "sort_by",
                        "required" => false,
                        "description" => "."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_order",
                        "param" => "sort_order",
                        "required" => false,
                        "description" => "."
                    ],
                    [
                        "source" => "query",
                        "name" => "created_before",
                        "param" => "created_before",
                        "required" => false,
                        "description" => "Return records created before this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "created_after",
                        "param" => "created_after",
                        "required" => false,
                        "description" => "Return records created after this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "updated_before",
                        "param" => "updated_before",
                        "required" => false,
                        "description" => "Return records updated before this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "updated_after",
                        "param" => "updated_after",
                        "required" => false,
                        "description" => "Return records updated after this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "is_template",
                        "param" => "is_template",
                        "required" => false,
                        "description" => "Filter by whether the email is a template."
                    ],
                    [
                        "source" => "query",
                        "name" => "has_translations",
                        "param" => "has_translations",
                        "required" => false,
                        "description" => "Filter by whether the email has translations."
                    ],
                    [
                        "source" => "query",
                        "name" => "is_linked",
                        "param" => "is_linked",
                        "required" => false,
                        "description" => "Filter by whether the email is linked to a workflow (campaign, broadcast, etc)."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_exports",
                "operation" => "listExports",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListExports",
                "method" => "GET",
                "path" => "/v1/exports",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List exports",
                "description" => "Return a list of your exports.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_folders",
                "operation" => "listFolders",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListFolders",
                "method" => "GET",
                "path" => "/v1/design_studio/folders",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List folders",
                "description" => "Returns a paginated list of folders.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "page",
                        "param" => "page",
                        "required" => false,
                        "description" => "The page number of results you want to display."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "Limit the number of results per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "parent_folder_id",
                        "param" => "parent_folder_id",
                        "required" => false,
                        "description" => "Filter by parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "direct_descendants_only",
                        "param" => "direct_descendants_only",
                        "required" => false,
                        "description" => "If true, this returns only children of the parent folder."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_by",
                        "param" => "sort_by",
                        "required" => false,
                        "description" => "."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_order",
                        "param" => "sort_order",
                        "required" => false,
                        "description" => "."
                    ],
                    [
                        "source" => "query",
                        "name" => "created_before",
                        "param" => "created_before",
                        "required" => false,
                        "description" => "Return records created before this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "created_after",
                        "param" => "created_after",
                        "required" => false,
                        "description" => "Return records created after this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "updated_before",
                        "param" => "updated_before",
                        "required" => false,
                        "description" => "Return records updated before this time."
                    ],
                    [
                        "source" => "query",
                        "name" => "updated_after",
                        "param" => "updated_after",
                        "required" => false,
                        "description" => "Return records updated after this time."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_messages",
                "operation" => "listMessages",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListMessages",
                "method" => "GET",
                "path" => "/v1/messages",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List messages",
                "description" => "Return a list of deliveries, including metrics for each delivery, for messages in your workspace.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "type",
                        "param" => "type",
                        "required" => false,
                        "description" => "The type of item you want to return metrics for."
                    ],
                    [
                        "source" => "query",
                        "name" => "metric",
                        "param" => "metric",
                        "required" => false,
                        "description" => "Determines the metric(s) you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "drafts",
                        "param" => "drafts",
                        "required" => false,
                        "description" => "If true, your request returns drafts rather than active/sent messages."
                    ],
                    [
                        "source" => "query",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => false,
                        "description" => "The campaign you want to filter for."
                    ],
                    [
                        "source" => "query",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => false,
                        "description" => "The newsletter you want to filter for."
                    ],
                    [
                        "source" => "query",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => false,
                        "description" => "The action you want to filter for."
                    ],
                    [
                        "source" => "query",
                        "name" => "start_ts",
                        "param" => "start_ts",
                        "required" => false,
                        "description" => "The beginning timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "end_ts",
                        "param" => "end_ts",
                        "required" => false,
                        "description" => "The ending timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "get_tracked_responses",
                        "param" => "get_tracked_responses",
                        "required" => false,
                        "description" => "If true, the response includes tracked_responses for each messagean object containing tracked response option names for in-app survey responses."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_newsletter_variants",
                "operation" => "listNewsletterVariants",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListNewsletterVariants",
                "method" => "GET",
                "path" => "/v1/newsletters/{newsletter_id}/contents",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List newsletter variants",
                "description" => "Returns a newsletter's content variantsthese are either different languages in a multi-language newsletter or A/B tests.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_newsletters",
                "operation" => "listNewsletters",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListNewsletters",
                "method" => "GET",
                "path" => "/v1/newsletters",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List newsletters",
                "description" => "Returns a list of your newsletters and associated metadata.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort",
                        "param" => "sort",
                        "required" => false,
                        "description" => "Determine how you want to sort results, asc for chronological order and desc for reverse chronological order."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_segments",
                "operation" => "listSegments",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListSegments",
                "method" => "GET",
                "path" => "/v1/segments",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List segments",
                "description" => "Retrieve a list of all of your segments.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_senders",
                "operation" => "listSenders",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListSenders",
                "method" => "GET",
                "path" => "/v1/sender_identities",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List sender identities",
                "description" => "Returns a list of senders in your workspace.",
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort",
                        "param" => "sort",
                        "required" => false,
                        "description" => "Determine how you want to sort results, asc for chronological order and desc for reverse chronological order."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_snippets",
                "operation" => "listSnippets",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListSnippets",
                "method" => "GET",
                "path" => "/v1/snippets",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List snippets",
                "description" => "Returns a list of snippets in your workspace.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_transactional",
                "operation" => "listTransactional",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListTransactional",
                "method" => "GET",
                "path" => "/v1/transactional",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List transactional messages",
                "description" => "Returns a list of your transactional messagesthe transactional IDs that you use to trigger an individual transactional delivery.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_transactional_variants",
                "operation" => "listTransactionalVariants",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListTransactionalVariants",
                "method" => "GET",
                "path" => "/v1/transactional/{transactional_id}/contents",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List all variants of a transactional message",
                "description" => "Returns the content variants of a transactional message, where each variant represents a different language.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "transactional_id",
                        "param" => "transactional_id",
                        "required" => true,
                        "description" => "The identifier of your transactional message."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_webhooks",
                "operation" => "listWebhooks",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListWebhooks",
                "method" => "GET",
                "path" => "/v1/reporting_webhooks",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List reporting webhooks",
                "description" => "Return a list of all of your reporting webhooks.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_list_workspaces",
                "operation" => "listWorkspaces",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppListWorkspaces",
                "method" => "GET",
                "path" => "/v1/workspaces",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "List workspaces",
                "description" => "Returns a list of workspaces in your account.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_post_suppression",
                "operation" => "postSuppression",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppPostSuppression",
                "method" => "POST",
                "path" => "/v1/esp/suppression/{suppression_type}/{email_address}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Suppress an email at the ESP",
                "description" => "Suppress an email address at the email service provider (ESP).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "suppression_type",
                        "param" => "suppression_type",
                        "required" => true,
                        "description" => "The reason a person's email address was suppressed by the email service provider (ESP)."
                    ],
                    [
                        "source" => "path",
                        "name" => "email_address",
                        "param" => "email_address",
                        "required" => true,
                        "description" => "The email address of the person you want to look up."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_schedule_newsletter",
                "operation" => "scheduleNewsletter",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppScheduleNewsletter",
                "method" => "POST",
                "path" => "/v1/newsletters/{newsletter_id}/schedule",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Schedule a newsletter",
                "description" => "Schedule a newsletter to send at a specific time.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_send_email",
                "operation" => "sendEmail",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppSendEmail",
                "method" => "POST",
                "path" => "/v1/send/email",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Send a transactional email",
                "description" => "Send a transactional email.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_send_inbox_message",
                "operation" => "sendInboxMessage",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppSendInboxMessage",
                "method" => "POST",
                "path" => "/v1/send/inbox_message",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Send a transactional inbox message",
                "description" => "Send a transactional inbox message.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_send_newsletter",
                "operation" => "sendNewsletter",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppSendNewsletter",
                "method" => "POST",
                "path" => "/v1/newsletters/{newsletter_id}/send",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Send a newsletter",
                "description" => "Send a newsletter immediately.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_send_push",
                "operation" => "sendPush",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppSendPush",
                "method" => "POST",
                "path" => "/v1/send/push",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Send a transactional push",
                "description" => "Send a transactional push.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_send_sms",
                "operation" => "sendSMS",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppSendSMS",
                "method" => "POST",
                "path" => "/v1/send/sms",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Send a transactional SMS",
                "description" => "Send a transactional SMS message.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_transactional_links",
                "operation" => "transactionalLinks",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppTransactionalLinks",
                "method" => "GET",
                "path" => "/v1/transactional/{transactional_id}/metrics/links",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get transactional message link metrics",
                "description" => "Returns metrics for clicked links from a transactional message, both in total and in series periods (days, weeks, etc).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "transactional_id",
                        "param" => "transactional_id",
                        "required" => true,
                        "description" => "The identifier of your transactional message."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "unique",
                        "param" => "unique",
                        "required" => false,
                        "description" => "If true, the response contains only unique customer results, i.e."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_transactional_messages",
                "operation" => "transactionalMessages",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppTransactionalMessages",
                "method" => "GET",
                "path" => "/v1/transactional/{transactional_id}/messages",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get transactional message deliveries",
                "description" => "Returns information about the deliveries (instances of messages sent to individual people) from a transactional message.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "transactional_id",
                        "param" => "transactional_id",
                        "required" => true,
                        "description" => "The identifier of your transactional message."
                    ],
                    [
                        "source" => "query",
                        "name" => "start",
                        "param" => "start",
                        "required" => false,
                        "description" => "The token for the page of results you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The maximum number of results you want to retrieve per page."
                    ],
                    [
                        "source" => "query",
                        "name" => "metric",
                        "param" => "metric",
                        "required" => false,
                        "description" => "Determines the metric(s) you want to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "state",
                        "param" => "state",
                        "required" => false,
                        "description" => "The state of a broadcast."
                    ],
                    [
                        "source" => "query",
                        "name" => "start_ts",
                        "param" => "start_ts",
                        "required" => false,
                        "description" => "The beginning timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "end_ts",
                        "param" => "end_ts",
                        "required" => false,
                        "description" => "The ending timestamp for your query."
                    ],
                    [
                        "source" => "query",
                        "name" => "get_tracked_responses",
                        "param" => "get_tracked_responses",
                        "required" => false,
                        "description" => "If true, the response includes tracked_responses for each messagean object containing tracked response option names for in-app survey responses."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_transactional_metrics",
                "operation" => "transactionalMetrics",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppTransactionalMetrics",
                "method" => "GET",
                "path" => "/v1/transactional/{transactional_id}/metrics",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "read",
                "name" => "Get transactional message metrics",
                "description" => "Returns a list of metrics for a transactional message in steps (days, weeks, etc).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "transactional_id",
                        "param" => "transactional_id",
                        "required" => true,
                        "description" => "The identifier of your transactional message."
                    ],
                    [
                        "source" => "query",
                        "name" => "period",
                        "param" => "period",
                        "required" => false,
                        "description" => "The unit of time for your report."
                    ],
                    [
                        "source" => "query",
                        "name" => "steps",
                        "param" => "steps",
                        "required" => false,
                        "description" => "The number of periods you want to return."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_app_trigger_broadcast",
                "operation" => "triggerBroadcast",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppTriggerBroadcast",
                "method" => "POST",
                "path" => "/v1/campaigns/{broadcast_id}/triggers",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Send an API-triggered broadcast",
                "description" => "Trigger a broadcast (not a newsletter) and optionally provide data to populate liquid placeholders in the message.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The ID of the broadcast that you want to trigger."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_asset",
                "operation" => "updateAsset",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateAsset",
                "method" => "PUT",
                "path" => "/v1/assets/files/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a file asset",
                "description" => "Updates the name and/or parent folder of a file asset.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The unique identifier of the resource."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_asset_folder",
                "operation" => "updateAssetFolder",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateAssetFolder",
                "method" => "PUT",
                "path" => "/v1/assets/folders/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a folder",
                "description" => "Updates the name and/or parent folder of an existing folder.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The unique identifier of the resource."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_attribute_metadata",
                "operation" => "updateAttributeMetadata",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateAttributeMetadata",
                "method" => "POST",
                "path" => "/v1/data_index/attributes",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Add or update attributes",
                "description" => "Attributes are customer data like their name and email.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "attributes"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_broadcast_action",
                "operation" => "updateBroadcastAction",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateBroadcastAction",
                "method" => "PUT",
                "path" => "/v1/broadcasts/{broadcast_id}/actions/{action_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a broadcast action",
                "description" => "Update the contents of a broadcast action, including the body of messages or HTTP requests.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_broadcast_action_language",
                "operation" => "updateBroadcastActionLanguage",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateBroadcastActionLanguage",
                "method" => "PUT",
                "path" => "/v1/broadcasts/{broadcast_id}/actions/{action_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a translation of a broadcast message",
                "description" => "Update a translation of a specific broadcast action, including the body of messages or HTTP requests.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "broadcast_id",
                        "param" => "broadcast_id",
                        "required" => true,
                        "description" => "The identifier of a broadcast."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_campaign_action",
                "operation" => "updateCampaignAction",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateCampaignAction",
                "method" => "PUT",
                "path" => "/v1/campaigns/{campaign_id}/actions/{action_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a campaign action",
                "description" => "Update the contents of a campaign action, including the body of messages and HTTP requests.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_campaign_action_translation",
                "operation" => "updateCampaignActionTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateCampaignActionTranslation",
                "method" => "PUT",
                "path" => "/v1/campaigns/{campaign_id}/actions/{action_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a translation of a campaign message",
                "description" => "Update the contents of a language variant of a campaign action, including the body of the messages and HTTP requests.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "campaign_id",
                        "param" => "campaign_id",
                        "required" => true,
                        "description" => "The ID of the campaign that you want to trigger or return information about."
                    ],
                    [
                        "source" => "path",
                        "name" => "action_id",
                        "param" => "action_id",
                        "required" => true,
                        "description" => "The action you want to lookup or act on."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_collection",
                "operation" => "updateCollection",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateCollection",
                "method" => "PUT",
                "path" => "/v1/collections/{collection_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a collection",
                "description" => "Update the name or replace the contents of a collection.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collection_id",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "The identifier for a collection."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_collection_contents",
                "operation" => "updateCollectionContents",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateCollectionContents",
                "method" => "PUT",
                "path" => "/v1/collections/{collection_id}/content",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update the contents of a collection",
                "description" => "Replace the contents of a collection (the data from when you created or updated a collection).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collection_id",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "The identifier for a collection."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_component",
                "operation" => "updateComponent",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateComponent",
                "method" => "PUT",
                "path" => "/v1/design_studio/components/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a component",
                "description" => "Update part of a component: its name, tag, folder, or content.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the component."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_email",
                "operation" => "updateEmail",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateEmail",
                "method" => "PUT",
                "path" => "/v1/design_studio/emails/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update an email",
                "description" => "Update part of an email: an email's name, template status, folder, content, envelope, or transformers.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the email."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_email_translation",
                "operation" => "updateEmailTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateEmailTranslation",
                "method" => "PUT",
                "path" => "/v1/design_studio/emails/{id}/languages/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update an email translation",
                "description" => "Update part of an email translation: the content, envelope, or transformers for a specific email translation.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the email."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A that indicates the language of your translated email."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_event_metadata",
                "operation" => "updateEventMetadata",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateEventMetadata",
                "method" => "POST",
                "path" => "/v1/data_index/events",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Add or update events",
                "description" => "Events are actions your customers have performed.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [
                    "events"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_folder",
                "operation" => "updateFolder",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateFolder",
                "method" => "PUT",
                "path" => "/v1/design_studio/folders/{id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a folder",
                "description" => "Update part of a folder: the name and/or the folder it belongs to.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "The UUID of the folder."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_newsletter_test_translation",
                "operation" => "updateNewsletterTestTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateNewsletterTestTranslation",
                "method" => "PUT",
                "path" => "/v1/newsletters/{newsletter_id}/test_group/{test_group_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a translation in a newsletter test group",
                "description" => "Update the translation of a newsletter variant in an A/B test.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "test_group_id",
                        "param" => "test_group_id",
                        "required" => true,
                        "description" => "The ID of the A/B test group."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_newsletter_variant",
                "operation" => "updateNewsletterVariant",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateNewsletterVariant",
                "method" => "PUT",
                "path" => "/v1/newsletters/{newsletter_id}/contents/{content_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a newsletter variant",
                "description" => "Update the content of a newsletter: the default message, a test variant in an A/B test group, or a translation.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "content_id",
                        "param" => "content_id",
                        "required" => true,
                        "description" => "The identifier of a message in a newsletter."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_newsletter_variant_translation",
                "operation" => "updateNewsletterVariantTranslation",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateNewsletterVariantTranslation",
                "method" => "PUT",
                "path" => "/v1/newsletters/{newsletter_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a translation of a newsletter",
                "description" => "Update the translation of a newsletter variant.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "newsletter_id",
                        "param" => "newsletter_id",
                        "required" => true,
                        "description" => "The identifier of a newsletter."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_snippets",
                "operation" => "updateSnippets",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateSnippets",
                "method" => "PUT",
                "path" => "/v1/snippets",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update snippets",
                "description" => "In your payload, you'll pass a name and value.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "name",
                    "value"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_transactional",
                "operation" => "updateTransactional",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateTransactional",
                "method" => "PUT",
                "path" => "/v1/transactional/{transactional_id}/content/{content_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a transactional message",
                "description" => "Update the body of a transactional email.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "transactional_id",
                        "param" => "transactional_id",
                        "required" => true,
                        "description" => "The identifier of your transactional message."
                    ],
                    [
                        "source" => "path",
                        "name" => "content_id",
                        "param" => "content_id",
                        "required" => true,
                        "description" => "The content variant of your transactional message."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_transactional_variant",
                "operation" => "updateTransactionalVariant",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateTransactionalVariant",
                "method" => "PUT",
                "path" => "/v1/transactional/{transactional_id}/language/{language}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a translation of a transactional message",
                "description" => "Update the body and other data of a specific language variant for a transactional message.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "transactional_id",
                        "param" => "transactional_id",
                        "required" => true,
                        "description" => "The identifier of your transactional message."
                    ],
                    [
                        "source" => "path",
                        "name" => "language",
                        "param" => "language",
                        "required" => true,
                        "description" => "A of a language variant."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_app_update_webhook",
                "operation" => "updateWebhook",
                "api" => "app",
                "api_label" => "App API",
                "class" => "CustomerIOAppUpdateWebhook",
                "method" => "PUT",
                "path" => "/v1/reporting_webhooks/{webhook_id}",
                "base_url" => "https://api.customer.io",
                "auth" => "bearer",
                "type" => "write",
                "name" => "Update a webhook configuration",
                "description" => "Update the configuration of a reporting webhook.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "webhook_id",
                        "param" => "webhook_id",
                        "required" => true,
                        "description" => "The identifier of a webhook."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "name",
                    "endpoint",
                    "events"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_pipelines_alias",
                "operation" => "alias",
                "api" => "pipelines",
                "api_label" => "Pipelines API",
                "class" => "CustomerIOPipelinesAlias",
                "method" => "POST",
                "path" => "/alias",
                "base_url" => "https://cdp.customer.io/v1",
                "auth" => "pipeline_basic",
                "type" => "write",
                "name" => "Merge profiles",
                "description" => "*You **only** need to use this method to support a few select destinations like Mixpanel.* The alias method reconciles identifiers in systems that don't automatically handle identity changeslike when a person graduates f.",
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "X-Strict-Mode",
                        "param" => "x_strict_mode",
                        "required" => false,
                        "description" => "When set to 1, enables strict validation that returns proper HTTP error codes (400/401) for validation failures."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_pipelines_batch",
                "operation" => "batch",
                "api" => "pipelines",
                "api_label" => "Pipelines API",
                "class" => "CustomerIOPipelinesBatch",
                "method" => "POST",
                "path" => "/batch",
                "base_url" => "https://cdp.customer.io/v1",
                "auth" => "pipeline_basic",
                "type" => "write",
                "name" => "Batch requests",
                "description" => "The batch method helps you send an array of identify, group, track, page and/or screen requests in a single call, so you don't have to send multiple requests.",
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "X-Strict-Mode",
                        "param" => "x_strict_mode",
                        "required" => false,
                        "description" => "When set to 1, enables strict validation that returns proper HTTP error codes (400/401) for validation failures."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_pipelines_group",
                "operation" => "group",
                "api" => "pipelines",
                "api_label" => "Pipelines API",
                "class" => "CustomerIOPipelinesGroup",
                "method" => "POST",
                "path" => "/group",
                "base_url" => "https://cdp.customer.io/v1",
                "auth" => "pipeline_basic",
                "type" => "write",
                "name" => "Create objects and relationships",
                "description" => "Group calls add people to a group.",
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "X-Strict-Mode",
                        "param" => "x_strict_mode",
                        "required" => false,
                        "description" => "When set to 1, enables strict validation that returns proper HTTP error codes (400/401) for validation failures."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_pipelines_identify",
                "operation" => "identify",
                "api" => "pipelines",
                "api_label" => "Pipelines API",
                "class" => "CustomerIOPipelinesIdentify",
                "method" => "POST",
                "path" => "/identify",
                "base_url" => "https://cdp.customer.io/v1",
                "auth" => "pipeline_basic",
                "type" => "write",
                "name" => "Add and Update People",
                "description" => "Identifies a person and assigns traits to them.",
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "X-Strict-Mode",
                        "param" => "x_strict_mode",
                        "required" => false,
                        "description" => "When set to 1, enables strict validation that returns proper HTTP error codes (400/401) for validation failures."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_pipelines_page",
                "operation" => "page",
                "api" => "pipelines",
                "api_label" => "Pipelines API",
                "class" => "CustomerIOPipelinesPage",
                "method" => "POST",
                "path" => "/page",
                "base_url" => "https://cdp.customer.io/v1",
                "auth" => "pipeline_basic",
                "type" => "write",
                "name" => "Track pageviews",
                "description" => "Sends a page view event.",
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "X-Strict-Mode",
                        "param" => "x_strict_mode",
                        "required" => false,
                        "description" => "When set to 1, enables strict validation that returns proper HTTP error codes (400/401) for validation failures."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_pipelines_screen",
                "operation" => "screen",
                "api" => "pipelines",
                "api_label" => "Pipelines API",
                "class" => "CustomerIOPipelinesScreen",
                "method" => "POST",
                "path" => "/screen",
                "base_url" => "https://cdp.customer.io/v1",
                "auth" => "pipeline_basic",
                "type" => "write",
                "name" => "Track mobile screenviews",
                "description" => "Sends a screen view event for mobile devices.",
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "X-Strict-Mode",
                        "param" => "x_strict_mode",
                        "required" => false,
                        "description" => "When set to 1, enables strict validation that returns proper HTTP error codes (400/401) for validation failures."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_pipelines_track",
                "operation" => "track",
                "api" => "pipelines",
                "api_label" => "Pipelines API",
                "class" => "CustomerIOPipelinesTrack",
                "method" => "POST",
                "path" => "/track",
                "base_url" => "https://cdp.customer.io/v1",
                "auth" => "pipeline_basic",
                "type" => "write",
                "name" => "Track events",
                "description" => "Send an event associated with a person.",
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "X-Strict-Mode",
                        "param" => "x_strict_mode",
                        "required" => false,
                        "description" => "When set to 1, enables strict validation that returns proper HTTP error codes (400/401) for validation failures."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_add_device",
                "operation" => "add_device",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackAddDevice",
                "method" => "PUT",
                "path" => "/api/v1/customers/{identifier}/devices",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Add or update a customer device",
                "description" => "Customers can have more than one device.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "identifier",
                        "param" => "identifier",
                        "required" => true,
                        "description" => "Customer identifier."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "device"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_add_to_segment",
                "operation" => "add_to_segment",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackAddToSegment",
                "method" => "POST",
                "path" => "/api/v1/segments/{segment_id}/add_customers",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Add people to a manual segment",
                "description" => "Add people to a manual segment by ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "segment_id",
                        "param" => "segment_id",
                        "required" => true,
                        "description" => "Segment identifier."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "ids"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_batch",
                "operation" => "batch",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackBatch",
                "method" => "POST",
                "path" => "/api/v2/batch",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Send multiple requests",
                "description" => "This endpoint lets you batch requests for different people and objects in a single request.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_delete",
                "operation" => "delete",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackDelete",
                "method" => "DELETE",
                "path" => "/api/v1/customers/{identifier}",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Delete a customer",
                "description" => "Deleting a customer removes them, and all of their information, from Customer.io.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "identifier",
                        "param" => "identifier",
                        "required" => true,
                        "description" => "Customer identifier."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_track_delete_device",
                "operation" => "delete_device",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackDeleteDevice",
                "method" => "DELETE",
                "path" => "/api/v1/customers/{identifier}/devices/{device_id}",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Delete a customer device",
                "description" => "Remove a device from a customer profile.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "identifier",
                        "param" => "identifier",
                        "required" => true,
                        "description" => "Customer identifier."
                    ],
                    [
                        "source" => "path",
                        "name" => "device_id",
                        "param" => "device_id",
                        "required" => true,
                        "description" => "Device identifier."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_track_entity",
                "operation" => "entity",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackEntity",
                "method" => "POST",
                "path" => "/api/v2/entity",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Make a single request",
                "description" => "This endpoint lets you create, update, or delete a single person or objectincluding managing relationships between objects and people.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_get_region",
                "operation" => "getRegion",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackGetRegion",
                "method" => "GET",
                "path" => "/api/v1/accounts/region",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "read",
                "name" => "Find your account region",
                "description" => "This endpoint returns the appropriate region and URL for your Track API credentials.",
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_track_identify",
                "operation" => "identify",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackIdentify",
                "method" => "PUT",
                "path" => "/api/v1/customers/{identifier}",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Add or update a customer",
                "description" => "Adds or updates a person.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "identifier",
                        "param" => "identifier",
                        "required" => true,
                        "description" => "Customer identifier."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_merge",
                "operation" => "merge",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackMerge",
                "method" => "POST",
                "path" => "/api/v1/merge_customers",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Merge duplicate people",
                "description" => "Merge two customer profiles together.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "primary",
                    "secondary"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_metrics",
                "operation" => "metrics",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackMetrics",
                "method" => "POST",
                "path" => "/api/v1/metrics",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Report metrics",
                "description" => "This endpoint helps you report metrics from channels that aren't native to Customer.io or don't rely on our SDKs.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_push_metrics",
                "operation" => "pushMetrics",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackPushMetrics",
                "method" => "POST",
                "path" => "/api/v1/push/events",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Report push metrics",
                "description" => "While this endpoint still works, you should take advantage of our .",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_remove_from_segment",
                "operation" => "remove_from_segment",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackRemoveFromSegment",
                "method" => "POST",
                "path" => "/api/v1/segments/{segment_id}/remove_customers",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Remove people from a manual segment",
                "description" => "You can remove users from a manual segment by ID.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "segment_id",
                        "param" => "segment_id",
                        "required" => true,
                        "description" => "Segment identifier."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "ids"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_submit_form",
                "operation" => "submitForm",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackSubmitForm",
                "method" => "POST",
                "path" => "/api/v1/forms/{form_id}/submit",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Submit a form",
                "description" => "Submit a form response.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "form_id",
                        "param" => "form_id",
                        "required" => true,
                        "description" => "The identifier for a form."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [
                    "data"
                ],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_suppress",
                "operation" => "suppress",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackSuppress",
                "method" => "POST",
                "path" => "/api/v1/customers/{identifier}/suppress",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Suppress a customer profile",
                "description" => "Delete a customer profile and prevent the person's identifier(s) from being re-added to your workspace.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "identifier",
                        "param" => "identifier",
                        "required" => true,
                        "description" => "Customer identifier."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ],
            [
                "slug" => "customerio_track_track",
                "operation" => "track",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackTrack",
                "method" => "POST",
                "path" => "/api/v1/customers/{identifier}/events",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Track a customer event",
                "description" => "Send an event associated with a person, referenced by the identifier in the path.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "identifier",
                        "param" => "identifier",
                        "required" => true,
                        "description" => "Customer identifier."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_track_anonymous",
                "operation" => "trackAnonymous",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackTrackAnonymous",
                "method" => "POST",
                "path" => "/api/v1/events",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Track an anonymous event",
                "description" => "An anonymous event represents a person you haven't identified yet.",
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_unsubscribe",
                "operation" => "unsubscribe",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackUnsubscribe",
                "method" => "POST",
                "path" => "/unsubscribe/{delivery_id}",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Custom unsubscribe handling",
                "description" => "This endpoint lets you set a global unsubscribed status outside of the subscription pathways native to Customer.io.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "delivery_id",
                        "param" => "delivery_id",
                        "required" => true,
                        "description" => "Delivery identifier."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => "application/json"
            ],
            [
                "slug" => "customerio_track_unsuppress",
                "operation" => "unsuppress",
                "api" => "track",
                "api_label" => "Track API",
                "class" => "CustomerIOTrackUnsuppress",
                "method" => "POST",
                "path" => "/api/v1/customers/{identifier}/unsuppress",
                "base_url" => "https://track.customer.io",
                "auth" => "track_basic",
                "type" => "write",
                "name" => "Unsuppress a customer profile",
                "description" => "Unsuppressing a profile allows you to add the customer back to Customer.io.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "identifier",
                        "param" => "identifier",
                        "required" => true,
                        "description" => "Customer identifier."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "request_required_fields" => [],
                "content_type" => null
            ]
        ];
    }
}

<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieve callback request details starting from the newest..
 *
 * Maps to webhooks.json endpoint GET /subscriptions/{id}/callbacks-log.
 */
class SmartRecruitersWebhooksSubscriptionsSearchCallbackLog extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_webhooks_subscriptions_search_callback_log";
    protected const DESCRIPTION = "Retrieve callback request details starting from the newest.\n\nOfficial SmartRecruiters endpoint: GET /subscriptions/{id}/callbacks-log from webhooks.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "subscription identifier",
        ],
        "page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "identifier of the next page of subscriptions",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of elements to return",
        ],
        "callback_status" => [
            "type" => "string",
            "enum" => [
                "successful",
                "failed",
            ],
            "required" => false,
            "description" => "status of callback, when absent all statuses will be returned",
        ],
        "after" => [
            "type" => "string",
            "required" => false,
            "description" => "Requests sent after the timestamp. The minimum value is 30 days ago. Format ISO8601: yyyy-MM-ddTHH:mm:ss.SSSZZ",
        ],
        "before" => [
            "type" => "string",
            "required" => false,
            "description" => "Requests sent before timestamp. The minimum value is 30 days ago. Format ISO8601: yyyy-MM-ddTHH:mm:ss.SSSZZ",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/webhooks-api/v201907";
    protected const PATH = "/subscriptions/{id}/callbacks-log";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [
        "page_id" => "page_id",
        "limit" => "limit",
        "callbackStatus" => "callback_status",
        "after" => "after",
        "before" => "before",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

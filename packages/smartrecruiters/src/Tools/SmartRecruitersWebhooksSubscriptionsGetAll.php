<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieve webhook subscriptions..
 *
 * Maps to webhooks.json endpoint GET /subscriptions.
 */
class SmartRecruitersWebhooksSubscriptionsGetAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_webhooks_subscriptions_get_all";
    protected const DESCRIPTION = "Retrieve webhook subscriptions.\n\nOfficial SmartRecruiters endpoint: GET /subscriptions from webhooks.json.";
    protected const PARAMETERS = [
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
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/webhooks-api/v201907";
    protected const PATH = "/subscriptions";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "page_id" => "page_id",
        "limit" => "limit",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

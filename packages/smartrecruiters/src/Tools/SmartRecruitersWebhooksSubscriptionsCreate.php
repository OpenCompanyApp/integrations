<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Subscribe to a webhook..
 *
 * Maps to webhooks.json endpoint POST /subscriptions.
 */
class SmartRecruitersWebhooksSubscriptionsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_webhooks_subscriptions_create";
    protected const DESCRIPTION = "Subscribe to a webhook.\n\nOfficial SmartRecruiters endpoint: POST /subscriptions from webhooks.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters webhooks.json schema for Subscribe to a webhook..",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/webhooks-api/v201907";
    protected const PATH = "/subscriptions";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

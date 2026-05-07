<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieve single webhook subscription..
 *
 * Maps to webhooks.json endpoint GET /subscriptions/{id}.
 */
class SmartRecruitersWebhooksSubscriptionsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_webhooks_subscriptions_get";
    protected const DESCRIPTION = "Retrieve single webhook subscription.\n\nOfficial SmartRecruiters endpoint: GET /subscriptions/{id} from webhooks.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "subscription identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/webhooks-api/v201907";
    protected const PATH = "/subscriptions/{id}";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

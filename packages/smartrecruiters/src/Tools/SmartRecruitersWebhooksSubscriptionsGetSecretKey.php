<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieve subscription secret key.
 *
 * Maps to webhooks.json endpoint GET /subscriptions/{id}/secret-key.
 */
class SmartRecruitersWebhooksSubscriptionsGetSecretKey extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_webhooks_subscriptions_get_secret_key";
    protected const DESCRIPTION = "Retrieve subscription secret key\n\nOfficial SmartRecruiters endpoint: GET /subscriptions/{id}/secret-key from webhooks.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "subscription identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/webhooks-api/v201907";
    protected const PATH = "/subscriptions/{id}/secret-key";
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

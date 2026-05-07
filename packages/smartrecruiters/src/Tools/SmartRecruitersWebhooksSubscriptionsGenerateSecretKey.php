<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Generate a secret key for a webhook subscription..
 *
 * Maps to webhooks.json endpoint POST /subscriptions/{id}/secret-key.
 */
class SmartRecruitersWebhooksSubscriptionsGenerateSecretKey extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_webhooks_subscriptions_generate_secret_key";
    protected const DESCRIPTION = "Generate a secret key for a webhook subscription.\n\nOfficial SmartRecruiters endpoint: POST /subscriptions/{id}/secret-key from webhooks.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "subscription identifier",
        ],
    ];
    protected const METHOD = "POST";
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

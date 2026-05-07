<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Activate webhook subscription..
 *
 * Maps to webhooks.json endpoint PUT /subscriptions/{id}/activation.
 */
class SmartRecruitersWebhooksSubscriptionsActivate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_webhooks_subscriptions_activate";
    protected const DESCRIPTION = "Activate webhook subscription.\n\nOfficial SmartRecruiters endpoint: PUT /subscriptions/{id}/activation from webhooks.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "subscription identifier",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/webhooks-api/v201907";
    protected const PATH = "/subscriptions/{id}/activation";
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

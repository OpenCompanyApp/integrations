<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Enables integration.
 *
 * Maps to apps-integrations.json endpoint POST /partner-api/integrations.
 */
class SmartRecruitersAppsIntegrationsEnableIntegration extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_apps_integrations_enable_integration";
    protected const DESCRIPTION = "Enables integration\n\nOfficial SmartRecruiters endpoint: POST /partner-api/integrations from apps-integrations.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters apps-integrations.json schema for Enables integration.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/apps-integrations";
    protected const PATH = "/partner-api/integrations";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "bearer";
}

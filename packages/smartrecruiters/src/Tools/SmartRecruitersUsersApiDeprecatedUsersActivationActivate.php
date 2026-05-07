<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Activate a user.
 *
 * Maps to users-api-deprecated.json endpoint PUT /users/{id}/activation.
 */
class SmartRecruitersUsersApiDeprecatedUsersActivationActivate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_api_deprecated_users_activation_activate";
    protected const DESCRIPTION = "Activate a user\n\nOfficial SmartRecruiters endpoint: PUT /users/{id}/activation from users-api-deprecated.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/users/{id}/activation";
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

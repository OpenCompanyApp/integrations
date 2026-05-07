<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Send an activation email to a user.
 *
 * Maps to users-api-deprecated.json endpoint POST /users/{id}/activation-email.
 */
class SmartRecruitersUsersApiDeprecatedUsersActivationEmailSend extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_api_deprecated_users_activation_email_send";
    protected const DESCRIPTION = "Send an activation email to a user\n\nOfficial SmartRecruiters endpoint: POST /users/{id}/activation-email from users-api-deprecated.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/users/{id}/activation-email";
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

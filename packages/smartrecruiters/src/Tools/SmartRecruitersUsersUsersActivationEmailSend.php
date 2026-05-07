<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Send an activation email to a user.
 *
 * Maps to users-api.json endpoint POST /users/{id}/activation-email.
 */
class SmartRecruitersUsersUsersActivationEmailSend extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_users_activation_email_send";
    protected const DESCRIPTION = "Send an activation email to a user\n\nOfficial SmartRecruiters endpoint: POST /users/{id}/activation-email from users-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
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

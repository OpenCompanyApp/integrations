<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Deactivate a user.
 *
 * Maps to users-api.json endpoint DELETE /users/{id}/activation.
 */
class SmartRecruitersUsersUsersActivationDeactivate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_users_activation_deactivate";
    protected const DESCRIPTION = "Deactivate a user\n\nOfficial SmartRecruiters endpoint: DELETE /users/{id}/activation from users-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
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

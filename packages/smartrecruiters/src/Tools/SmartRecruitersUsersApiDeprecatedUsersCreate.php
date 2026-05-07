<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create a new user.
 *
 * Maps to users-api-deprecated.json endpoint POST /users.
 */
class SmartRecruitersUsersApiDeprecatedUsersCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_api_deprecated_users_create";
    protected const DESCRIPTION = "Create a new user\n\nOfficial SmartRecruiters endpoint: POST /users from users-api-deprecated.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "User object to be created",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/users";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

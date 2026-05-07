<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get details of a user with given id.
 *
 * Maps to users-api-deprecated.json endpoint GET /users/{id}.
 */
class SmartRecruitersUsersApiDeprecatedUsersGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_api_deprecated_users_get";
    protected const DESCRIPTION = "Get details of a user with given id\n\nOfficial SmartRecruiters endpoint: GET /users/{id} from users-api-deprecated.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/users/{id}";
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

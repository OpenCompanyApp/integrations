<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Deactivate a user.
 *
 * Maps to users-api-deprecated.json endpoint DELETE /users/{id}.
 */
class SmartRecruitersUsersApiDeprecatedUsersActivationDelete extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_api_deprecated_users_activation_delete";
    protected const DESCRIPTION = "Deactivate a user\n\nOfficial SmartRecruiters endpoint: DELETE /users/{id} from users-api-deprecated.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
    ];
    protected const METHOD = "DELETE";
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

<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update a user.
 *
 * Maps to users-api.json endpoint PATCH /users/{id}.
 */
class SmartRecruitersUsersUsersUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_users_update";
    protected const DESCRIPTION = "Update a user\n\nOfficial SmartRecruiters endpoint: PATCH /users/{id} from users-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "patch request (RFC 6902 - https://datatracker.ietf.org/doc/html/rfc6902)",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
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

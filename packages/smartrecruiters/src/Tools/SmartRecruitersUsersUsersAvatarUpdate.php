<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update user avatar.
 *
 * Maps to users-api.json endpoint PUT /users/{id}/avatar.
 */
class SmartRecruitersUsersUsersAvatarUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_users_avatar_update";
    protected const DESCRIPTION = "Update user avatar\n\nOfficial SmartRecruiters endpoint: PUT /users/{id}/avatar from users-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters users-api.json schema for Update user avatar.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
    protected const PATH = "/users/{id}/avatar";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "multipart";
    protected const AUTH_MODE = "either";
}

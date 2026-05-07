<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List users of your company.
 *
 * Maps to users-api.json endpoint GET /users.
 */
class SmartRecruitersUsersUsersAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_users_all";
    protected const DESCRIPTION = "List users of your company\n\nOfficial SmartRecruiters endpoint: GET /users from users-api.json.";
    protected const PARAMETERS = [
        "q" => [
            "type" => "string",
            "required" => false,
            "description" => "full-text search query based on firstName, lastName, email, externalData",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of elements to return. max value is 100",
        ],
        "page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Unique identifier for the next page of users",
        ],
        "updated_after" => [
            "type" => "string",
            "required" => false,
            "description" => "ISO8601-formatted time boundaries for the user update time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
    protected const PATH = "/users";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "q" => "q",
        "limit" => "limit",
        "pageId" => "page_id",
        "updatedAfter" => "updated_after",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

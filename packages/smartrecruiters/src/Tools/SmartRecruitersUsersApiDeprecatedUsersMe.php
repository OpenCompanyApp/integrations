<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get details of my user.
 *
 * Maps to users-api-deprecated.json endpoint GET /users/me.
 */
class SmartRecruitersUsersApiDeprecatedUsersMe extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_api_deprecated_users_me";
    protected const DESCRIPTION = "Get details of my user\n\nOfficial SmartRecruiters endpoint: GET /users/me from users-api-deprecated.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/users/me";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

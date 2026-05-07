<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List access groups configured in your company.
 *
 * Maps to users-api.json endpoint GET /access-groups.
 */
class SmartRecruitersUsersAccessGroupsAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_access_groups_all";
    protected const DESCRIPTION = "List access groups configured in your company\n\nOfficial SmartRecruiters endpoint: GET /access-groups from users-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
    protected const PATH = "/access-groups";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List system roles.
 *
 * Maps to users-api.json endpoint GET /system-roles.
 */
class SmartRecruitersUsersSystemRolesAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_system_roles_all";
    protected const DESCRIPTION = "List system roles\n\nOfficial SmartRecruiters endpoint: GET /system-roles from users-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
    protected const PATH = "/system-roles";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

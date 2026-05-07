<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Assign users to access group.
 *
 * Maps to users-api.json endpoint POST /access-groups/{accessGroupId}/users.
 */
class SmartRecruitersUsersAccessGroupsUsersAssign extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_access_groups_users_assign";
    protected const DESCRIPTION = "Assign users to access group\n\nOfficial SmartRecruiters endpoint: POST /access-groups/{accessGroupId}/users from users-api.json.";
    protected const PARAMETERS = [
        "access_group_id" => [
            "type" => "string",
            "required" => true,
            "description" => "access group identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters users-api.json schema for Assign users to access group.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
    protected const PATH = "/access-groups/{accessGroupId}/users";
    protected const PATH_PARAMS = [
        "accessGroupId" => "access_group_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

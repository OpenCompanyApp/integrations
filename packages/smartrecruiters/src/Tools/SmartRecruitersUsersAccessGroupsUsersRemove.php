<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Remove user from access group.
 *
 * Maps to users-api.json endpoint DELETE /access-groups/{accessGroupId}/users/{id}.
 */
class SmartRecruitersUsersAccessGroupsUsersRemove extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_users_access_groups_users_remove";
    protected const DESCRIPTION = "Remove user from access group\n\nOfficial SmartRecruiters endpoint: DELETE /access-groups/{accessGroupId}/users/{id} from users-api.json.";
    protected const PARAMETERS = [
        "access_group_id" => [
            "type" => "string",
            "required" => true,
            "description" => "access group identifier",
        ],
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "user identifier",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com/user-api/v201804";
    protected const PATH = "/access-groups/{accessGroupId}/users/{id}";
    protected const PATH_PARAMS = [
        "accessGroupId" => "access_group_id",
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

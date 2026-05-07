<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Delete access group.
 *
 * Maps to configuration-api.json endpoint DELETE /configuration/access-groups/{accessGroupId}.
 */
class SmartRecruitersConfigurationConfigurationAccessGroupDelete extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_access_group_delete";
    protected const DESCRIPTION = "Delete access group\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/access-groups/{accessGroupId} from configuration-api.json.";
    protected const PARAMETERS = [
        "access_group_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Access group identifier",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/access-groups/{accessGroupId}";
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

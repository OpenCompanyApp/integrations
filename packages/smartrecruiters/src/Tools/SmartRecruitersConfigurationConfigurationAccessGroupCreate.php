<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create access group.
 *
 * Maps to configuration-api.json endpoint POST /configuration/access-groups.
 */
class SmartRecruitersConfigurationConfigurationAccessGroupCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_access_group_create";
    protected const DESCRIPTION = "Create access group\n\nOfficial SmartRecruiters endpoint: POST /configuration/access-groups from configuration-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "## Access Group Request This request is used to **create/update an access group** by specifying its **name, description, and inclusion criteria**. ### Fields - **name (string, required)** The name of the access group. - **description (string, required)** A brief description of the access group. - **criteria (object, required)** Defines the conditions under which entities are included in the access group. - The **criteria** object **must contain exactly one include object**. - The **include** object contains multiple properties, where each property represents an active **job property** with category set to the **organization**. #### Each **job property** is referenced by its **ID** and includes the following attributes: - **all (boolean)** true Includes **all** values. false Includes **only** specified values. - **values (array)** A list of specific values to include (if all is set to false) or exclude (if all is set to true) ### Usage Examples - **Match all countries** all: true and an empty values array. - **Match specific countries** all: false and a list of country codes in values. - **Match all countries except certain ones** all: true with values specifying the excluded countries. To obtain a list of available **job properties** under the **organization** category, use the ****. The **job property ID** should be used as the key in the include object.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/access-groups";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

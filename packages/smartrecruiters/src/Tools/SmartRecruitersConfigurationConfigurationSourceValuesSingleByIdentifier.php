<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get a candidate source by identifier..
 *
 * Maps to configuration-api.json endpoint GET /configuration/sources/{sourceIdentifier}.
 */
class SmartRecruitersConfigurationConfigurationSourceValuesSingleByIdentifier extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_source_values_single_by_identifier";
    protected const DESCRIPTION = "Get a candidate source by identifier.\n\nOfficial SmartRecruiters endpoint: GET /configuration/sources/{sourceIdentifier} from configuration-api.json.";
    protected const PARAMETERS = [
        "source_identifier" => [
            "type" => "string",
            "required" => true,
            "description" => "Source identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/sources/{sourceIdentifier}";
    protected const PATH_PARAMS = [
        "sourceIdentifier" => "source_identifier",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

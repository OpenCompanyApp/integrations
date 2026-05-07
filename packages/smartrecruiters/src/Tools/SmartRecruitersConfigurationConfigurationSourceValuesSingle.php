<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get a candidate source.
 *
 * Maps to configuration-api.json endpoint GET /configuration/sources/{sourceType}/values/{sourceValueId}.
 */
class SmartRecruitersConfigurationConfigurationSourceValuesSingle extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_source_values_single";
    protected const DESCRIPTION = "Get a candidate source\n\nOfficial SmartRecruiters endpoint: GET /configuration/sources/{sourceType}/values/{sourceValueId} from configuration-api.json.";
    protected const PARAMETERS = [
        "source_type" => [
            "type" => "string",
            "required" => true,
            "description" => "Source type from /configuration/sources",
        ],
        "source_value_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Source id",
        ],
        "source_sub_type" => [
            "type" => "string",
            "required" => false,
            "description" => "Source SubType from /configuration/sources",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/sources/{sourceType}/values/{sourceValueId}";
    protected const PATH_PARAMS = [
        "sourceType" => "source_type",
        "sourceValueId" => "source_value_id",
    ];
    protected const QUERY_PARAMS = [
        "sourceSubType" => "source_sub_type",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

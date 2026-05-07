<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List candidate sources.
 *
 * Maps to configuration-api.json endpoint GET /configuration/sources/{sourceType}/values.
 */
class SmartRecruitersConfigurationConfigurationSourceValuesAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_source_values_all";
    protected const DESCRIPTION = "List candidate sources\n\nOfficial SmartRecruiters endpoint: GET /configuration/sources/{sourceType}/values from configuration-api.json.";
    protected const PARAMETERS = [
        "source_type" => [
            "type" => "string",
            "required" => true,
            "description" => "Source type from /configuration/sources",
        ],
        "source_sub_type" => [
            "type" => "string",
            "required" => false,
            "description" => "Source SubType from /configuration/sources",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of elements to return. max value is 100",
        ],
        "offset" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of elements to skip while processing result",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/sources/{sourceType}/values";
    protected const PATH_PARAMS = [
        "sourceType" => "source_type",
    ];
    protected const QUERY_PARAMS = [
        "sourceSubType" => "source_sub_type",
        "limit" => "limit",
        "offset" => "offset",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

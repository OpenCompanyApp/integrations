<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List candidate source types with subtypes.
 *
 * Maps to configuration-api.json endpoint GET /configuration/sources.
 */
class SmartRecruitersConfigurationConfigurationSourceTypes extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_source_types";
    protected const DESCRIPTION = "List candidate source types with subtypes\n\nOfficial SmartRecruiters endpoint: GET /configuration/sources from configuration-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/sources";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

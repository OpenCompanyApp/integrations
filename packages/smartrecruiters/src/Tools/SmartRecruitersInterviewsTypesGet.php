<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves interview types.
 *
 * Maps to interviews.json endpoint GET /interview-types.
 */
class SmartRecruitersInterviewsTypesGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_types_get";
    protected const DESCRIPTION = "Retrieves interview types\n\nOfficial SmartRecruiters endpoint: GET /interview-types from interviews.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interview-types";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

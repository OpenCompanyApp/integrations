<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Adds interview types to already existing ones.
 *
 * Maps to interviews.json endpoint PATCH /interview-types.
 */
class SmartRecruitersInterviewsTypesUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_types_update";
    protected const DESCRIPTION = "Adds interview types to already existing ones\n\nOfficial SmartRecruiters endpoint: PATCH /interview-types from interviews.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Interview types to be added",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interview-types";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

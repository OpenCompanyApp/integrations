<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add/update candidate properties values.
 *
 * Maps to candidates-api.json endpoint PUT /candidates/{id}/jobs/{jobId}/properties.
 */
class SmartRecruitersCandidatesCandidatesPropertiesValuesBatchUpdateForJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_properties_values_batch_update_for_job";
    protected const DESCRIPTION = "Add/update candidate properties values\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/jobs/{jobId}/properties from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Add/update candidate properties values.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/jobs/{jobId}/properties";
    protected const PATH_PARAMS = [
        "id" => "id",
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

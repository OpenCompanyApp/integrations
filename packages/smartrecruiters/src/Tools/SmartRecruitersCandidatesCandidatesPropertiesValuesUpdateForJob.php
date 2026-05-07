<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add/update candidate property value.
 *
 * Maps to candidates-api.json endpoint PUT /candidates/{id}/jobs/{jobId}/properties/{propertyId}.
 */
class SmartRecruitersCandidatesCandidatesPropertiesValuesUpdateForJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_properties_values_update_for_job";
    protected const DESCRIPTION = "Add/update candidate property value\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/jobs/{jobId}/properties/{propertyId} from candidates-api.json.";
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
        "property_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Candidate property id (uuid or key)",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Input value of the candidate property.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/jobs/{jobId}/properties/{propertyId}";
    protected const PATH_PARAMS = [
        "id" => "id",
        "jobId" => "job_id",
        "propertyId" => "property_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

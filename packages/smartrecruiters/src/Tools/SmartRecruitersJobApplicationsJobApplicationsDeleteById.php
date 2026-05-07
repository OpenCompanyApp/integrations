<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Delete a job application.
 *
 * Maps to job-applications-api.json endpoint DELETE /job-applications/{jobApplicationId}.
 */
class SmartRecruitersJobApplicationsJobApplicationsDeleteById extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_job_applications_job_applications_delete_by_id";
    protected const DESCRIPTION = "Delete a job application\n\nOfficial SmartRecruiters endpoint: DELETE /job-applications/{jobApplicationId} from job-applications-api.json.";
    protected const PARAMETERS = [
        "job_application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of job application",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com/job-applications-api/v202112";
    protected const PATH = "/job-applications/{jobApplicationId}";
    protected const PATH_PARAMS = [
        "jobApplicationId" => "job_application_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

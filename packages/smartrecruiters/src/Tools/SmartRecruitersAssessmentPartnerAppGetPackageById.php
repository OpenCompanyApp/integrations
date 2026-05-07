<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves a package by id.
 *
 * Maps to assessment-partner-app.json endpoint GET /packages/{assessmentPackageId}.
 */
class SmartRecruitersAssessmentPartnerAppGetPackageById extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_app_get_package_by_id";
    protected const DESCRIPTION = "Retrieves a package by id\n\nOfficial SmartRecruiters endpoint: GET /packages/{assessmentPackageId} from assessment-partner-app.json.";
    protected const PARAMETERS = [
        "assessment_package_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `assessmentPackageId`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://your.domain.com";
    protected const PATH = "/packages/{assessmentPackageId}";
    protected const PATH_PARAMS = [
        "assessmentPackageId" => "assessment_package_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "bearer";
}

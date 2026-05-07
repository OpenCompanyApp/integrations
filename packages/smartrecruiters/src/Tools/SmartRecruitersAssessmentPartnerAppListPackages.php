<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves a list of packages.
 *
 * Maps to assessment-partner-app.json endpoint GET /packages.
 */
class SmartRecruitersAssessmentPartnerAppListPackages extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_app_list_packages";
    protected const DESCRIPTION = "Retrieves a list of packages\n\nOfficial SmartRecruiters endpoint: GET /packages from assessment-partner-app.json.";
    protected const PARAMETERS = [
        "requester" => [
            "type" => "object",
            "required" => false,
            "description" => "Information about recruiter requesting list of packages",
        ],
        "country_code" => [
            "type" => "string",
            "required" => false,
            "description" => "country code",
        ],
        "region_abbr" => [
            "type" => "string",
            "required" => false,
            "description" => "region abbreviation",
        ],
        "city" => [
            "type" => "string",
            "required" => false,
            "description" => "city",
        ],
        "address" => [
            "type" => "string",
            "required" => false,
            "description" => "address",
        ],
        "postal_code" => [
            "type" => "string",
            "required" => false,
            "description" => "postal code",
        ],
        "remote" => [
            "type" => "boolean",
            "required" => false,
            "description" => "describe whether job is remote or not",
        ],
        "partner_field_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Example partner field. Partner defines list of allowed fields in configuration. Client binds job fields in his configuration. All fields with non-empty values will be included in this call.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://your.domain.com";
    protected const PATH = "/packages";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "country-code" => "country_code",
        "region-abbr" => "region_abbr",
        "city" => "city",
        "address" => "address",
        "postal-code" => "postal_code",
        "remote" => "remote",
        "partner-field-id" => "partner_field_id",
    ];
    protected const HEADER_PARAMS = [
        "requester" => "requester",
    ];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "bearer";
}

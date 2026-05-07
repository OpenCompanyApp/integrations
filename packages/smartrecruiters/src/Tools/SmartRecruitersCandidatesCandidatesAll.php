<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Search candidates.
 *
 * Maps to candidates-api.json endpoint GET /candidates.
 */
class SmartRecruitersCandidatesCandidatesAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_all";
    protected const DESCRIPTION = "Search candidates\n\nOfficial SmartRecruiters endpoint: GET /candidates from candidates-api.json.";
    protected const PARAMETERS = [
        "q" => [
            "type" => "string",
            "required" => false,
            "description" => "keyword search, for more information see",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "number of elements to return. max value is 100",
        ],
        "page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "page identifier of elements to return The pageId param can be used to fetch multiple page response, in case the number of results is higher than max number of elements to return (specified in the limit parameter). The pageId should not be present when requesting the first page of results. The pageId of the following page is returned either in the nextPageId property, or is available in the HTTP header Link value of relation type next. Example of the Link header: ; rel=\"next\"",
        ],
        "job_id" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "job filter to display candidates who applied for a job [id]; can be used repeatedly;",
        ],
        "location" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "location keyword search which looks up a string in a candidates location data; can be used repeatedly; case insensitive; e.g. Krakow",
        ],
        "average_rating" => [
            "type" => "array",
            "items" => [
                "type" => "integer",
            ],
            "required" => false,
            "description" => "average rating filter to display candidates with a specific average rating (integer); can be used repeatedly; e.g. 4",
        ],
        "status" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "LEAD",
                    "NEW",
                    "IN_REVIEW",
                    "INTERVIEW",
                    "OFFERED",
                    "HIRED",
                    "REJECTED",
                    "WITHDRAWN",
                    "TRANSFERRED",
                ],
            ],
            "required" => false,
            "description" => "candidates status filter in a context of a job; can be used repeatedly",
        ],
        "consent_status" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "REQUIRED",
                    "PENDING",
                    "ACQUIRED",
                ],
            ],
            "required" => false,
            "description" => "candidates consent status filter; can be used repeatedly",
        ],
        "sub_status" => [
            "type" => "string",
            "required" => false,
            "description" => "candidates sub-status filter in a context of a job. Works only in a correlation with a set value for the \"status\" field.",
        ],
        "tag" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "tag assigned to a candidate; can be used repeatedly; case insensitive; e.g. fluent english",
        ],
        "updated_after" => [
            "type" => "string",
            "required" => false,
            "description" => "ISO8601-formatted time boundaries for the candidate update time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ",
        ],
        "onboarding_status" => [
            "type" => "string",
            "enum" => [
                "READY_TO_ONBOARD",
                "ONBOARDING_SUCCESSFUL",
                "ONBOARDING_FAILED",
            ],
            "required" => false,
            "description" => "candidate's onboarding status",
        ],
        "property_id" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "candidate's property id (1-N). Currently it is only possible to filter by single-select application fields. Other application field type filtering is not possible.",
        ],
        "property_value_id" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "candidate's property value id (1-N)",
        ],
        "source_type" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "candidate's source type (1-N)",
        ],
        "source_sub_type" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "candidate's source subtype (1-N)",
        ],
        "source_value_id" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "candidate's source value id (1-N)",
        ],
        "question_category" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "screening question category (1-N)",
        ],
        "question_field_id" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "screening question field id (1-N)",
        ],
        "question_field_value_id" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "screening question field value id (1-N)",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "q" => "q",
        "limit" => "limit",
        "pageId" => "page_id",
        "jobId" => "job_id",
        "location" => "location",
        "averageRating" => "average_rating",
        "status" => "status",
        "consentStatus" => "consent_status",
        "subStatus" => "sub_status",
        "tag" => "tag",
        "updatedAfter" => "updated_after",
        "onboardingStatus" => "onboarding_status",
        "propertyId" => "property_id",
        "propertyValueId" => "property_value_id",
        "sourceType" => "source_type",
        "sourceSubType" => "source_sub_type",
        "sourceValueId" => "source_value_id",
        "questionCategory" => "question_category",
        "questionFieldId" => "question_field_id",
        "questionFieldValueId" => "question_field_value_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

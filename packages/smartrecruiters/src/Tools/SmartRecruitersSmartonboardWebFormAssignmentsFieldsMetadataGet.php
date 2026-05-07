<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns metadata for the fields that belong to a single Web Form Assignment.
 *
 * Maps to smartonboard.json endpoint GET /web-form-assignments/{webFormAssignmentId}/fields-metadata.
 */
class SmartRecruitersSmartonboardWebFormAssignmentsFieldsMetadataGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_web_form_assignments_fields_metadata_get";
    protected const DESCRIPTION = "Returns metadata for the fields that belong to a single Web Form Assignment\n\nOfficial SmartRecruiters endpoint: GET /web-form-assignments/{webFormAssignmentId}/fields-metadata from smartonboard.json.";
    protected const PARAMETERS = [
        "web_form_assignment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Web Form Assignment",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/web-form-assignments/{webFormAssignmentId}/fields-metadata";
    protected const PATH_PARAMS = [
        "webFormAssignmentId" => "web_form_assignment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

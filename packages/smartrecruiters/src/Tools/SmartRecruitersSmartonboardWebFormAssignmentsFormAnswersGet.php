<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns answers submitted for a single Web Form Assignment.
 *
 * Maps to smartonboard.json endpoint GET /web-form-assignments/{webFormAssignmentId}/form-answers.
 */
class SmartRecruitersSmartonboardWebFormAssignmentsFormAnswersGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_web_form_assignments_form_answers_get";
    protected const DESCRIPTION = "Returns answers submitted for a single Web Form Assignment\n\nOfficial SmartRecruiters endpoint: GET /web-form-assignments/{webFormAssignmentId}/form-answers from smartonboard.json.";
    protected const PARAMETERS = [
        "web_form_assignment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Web Form Assignment",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/web-form-assignments/{webFormAssignmentId}/form-answers";
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

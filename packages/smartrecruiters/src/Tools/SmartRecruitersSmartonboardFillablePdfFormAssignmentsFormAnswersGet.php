<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns answers submitted for a single Fillable PDF Form Assignment.
 *
 * Maps to smartonboard.json endpoint GET /fillable-pdf-form-assignments/{fillablePdfFormAssignmentId}/form-answers.
 */
class SmartRecruitersSmartonboardFillablePdfFormAssignmentsFormAnswersGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_fillable_pdf_form_assignments_form_answers_get";
    protected const DESCRIPTION = "Returns answers submitted for a single Fillable PDF Form Assignment\n\nOfficial SmartRecruiters endpoint: GET /fillable-pdf-form-assignments/{fillablePdfFormAssignmentId}/form-answers from smartonboard.json.";
    protected const PARAMETERS = [
        "fillable_pdf_form_assignment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Fillable PDF Form Assignment",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/fillable-pdf-form-assignments/{fillablePdfFormAssignmentId}/form-answers";
    protected const PATH_PARAMS = [
        "fillablePdfFormAssignmentId" => "fillable_pdf_form_assignment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

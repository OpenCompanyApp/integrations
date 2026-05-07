<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns list of Attachments submitted for a single Activity Assignment.
 *
 * Maps to smartonboard.json endpoint GET /activity-assignments/{activityAssignmentId}/attachments.
 */
class SmartRecruitersSmartonboardActivityAssignmentsAttachmentsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_activity_assignments_attachments_get";
    protected const DESCRIPTION = "Returns list of Attachments submitted for a single Activity Assignment\n\nOfficial SmartRecruiters endpoint: GET /activity-assignments/{activityAssignmentId}/attachments from smartonboard.json.";
    protected const PARAMETERS = [
        "activity_assignment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Activity Assignment",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/activity-assignments/{activityAssignmentId}/attachments";
    protected const PATH_PARAMS = [
        "activityAssignmentId" => "activity_assignment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

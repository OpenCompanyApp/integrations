<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns single Attachment for specific Activity Assignment.
 *
 * Maps to smartonboard.json endpoint GET /activity-assignments/{activityAssignmentId}/attachments/{attachmentId}.
 */
class SmartRecruitersSmartonboardActivityAssignmentsAttachmentsGetById extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_activity_assignments_attachments_get_by_id";
    protected const DESCRIPTION = "Returns single Attachment for specific Activity Assignment\n\nOfficial SmartRecruiters endpoint: GET /activity-assignments/{activityAssignmentId}/attachments/{attachmentId} from smartonboard.json.";
    protected const PARAMETERS = [
        "activity_assignment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Activity Assignment",
        ],
        "attachment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Attachment",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/activity-assignments/{activityAssignmentId}/attachments/{attachmentId}";
    protected const PATH_PARAMS = [
        "activityAssignmentId" => "activity_assignment_id",
        "attachmentId" => "attachment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

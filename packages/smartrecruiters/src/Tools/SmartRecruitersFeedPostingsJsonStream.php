<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get a list of postings.
 *
 * Maps to feed-api.json endpoint GET /publications.
 */
class SmartRecruitersFeedPostingsJsonStream extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_feed_postings_json_stream";
    protected const DESCRIPTION = "Get a list of postings\n\nOfficial SmartRecruiters endpoint: GET /publications from feed-api.json.";
    protected const PARAMETERS = [
        "updated_after" => [
            "type" => "string",
            "required" => false,
            "description" => "List postings created after the specified date.Date should be in ISO 8601 format: (e.g.: '2015-07-27T08:43:33.000Z').If no value is provided, only postings created in the last 30 days will be returned.",
        ],
        "status" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "Pending",
                    "UnderPosting",
                    "Active",
                    "toUnpost",
                    "Inactive",
                    "Error",
                ],
            ],
            "required" => false,
            "description" => "List of posting statuses separated by comma.Status definition:Pending - this is a new posting that is pending publication on your job board. You should always retrieve these postings, publish them, and then update the status via the PUT method.UnderPosting - this is a status that is only set by you. It indicates that a posting is currently being published but is not yet available on the job board. SmartRecruiters will never set this status ourselves.Active - this is a status that is only set by you. It indicates that the posting has been successfully published and is available on the job board. SmartRecruiters will never set this status ourselves.toUnpost - this posting has either expired or has manually been requested for removal by the client. As a job board, you should unpost these postings immediately, and then update the status to Inactive via the PUT method.Inactive - this is a status that is only set by you. It indicates that the posting has been successfully unpublished and is no longer available on the job board. SmartRecruiters will never set this status ourselves.Error - this is a status only set by you. It indicates that the posting could not be published. SmartRecruiters will never set this status ourselves.Example: status=Active,Error",
        ],
        "offset" => [
            "type" => "string",
            "required" => false,
            "description" => "Number of elements to skip while processing result.Allowed range: [0, 2^31-1].",
        ],
        "limit" => [
            "type" => "string",
            "required" => false,
            "description" => "Maximum number of postings returned.Allowed range: [0, 100].",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/feed";
    protected const PATH = "/publications";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "updatedAfter" => "updated_after",
        "status" => "status",
        "offset" => "offset",
        "limit" => "limit",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update posting information.
 *
 * Maps to feed-api.json endpoint PUT /publications/{postingId}.
 */
class SmartRecruitersFeedUpdatePostingUsingJson extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_feed_update_posting_using_json";
    protected const DESCRIPTION = "Update posting information\n\nOfficial SmartRecruiters endpoint: PUT /publications/{postingId} from feed-api.json.";
    protected const PARAMETERS = [
        "posting_id" => [
            "type" => "integer",
            "required" => true,
            "description" => "A single posting id. Allows updating information only for the defined postings.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters feed-api.json schema for Update posting information.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/feed";
    protected const PATH = "/publications/{postingId}";
    protected const PATH_PARAMS = [
        "postingId" => "posting_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

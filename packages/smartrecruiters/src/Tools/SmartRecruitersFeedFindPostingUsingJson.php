<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get posting by id.
 *
 * Maps to feed-api.json endpoint GET /publications/{postingId}.
 */
class SmartRecruitersFeedFindPostingUsingJson extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_feed_find_posting_using_json";
    protected const DESCRIPTION = "Get posting by id\n\nOfficial SmartRecruiters endpoint: GET /publications/{postingId} from feed-api.json.";
    protected const PARAMETERS = [
        "posting_id" => [
            "type" => "integer",
            "required" => true,
            "description" => "Posting id to find",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/feed";
    protected const PATH = "/publications/{postingId}";
    protected const PATH_PARAMS = [
        "postingId" => "posting_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

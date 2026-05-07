<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Fetch messages.
 *
 * Maps to messages-api.json endpoint GET /messages.
 */
class SmartRecruitersMessagesMessagesFetch extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_messages_messages_fetch";
    protected const DESCRIPTION = "Fetch messages\n\nOfficial SmartRecruiters endpoint: GET /messages from messages-api.json.";
    protected const PARAMETERS = [
        "candidate_id" => [
            "type" => "string",
            "required" => true,
            "description" => "identifier of a candidate",
        ],
        "job_id" => [
            "type" => "string",
            "required" => false,
            "description" => "identifier of a job",
        ],
        "page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "identifier of next page",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "limit",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/messages";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "candidateId" => "candidate_id",
        "jobId" => "job_id",
        "pageId" => "page_id",
        "limit" => "limit",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

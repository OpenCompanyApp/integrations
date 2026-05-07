<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Shares new messages on Hireloop with Users, Hiring Teams or Everyone and sends emails..
 *
 * Maps to messages-api.json endpoint POST /messages/shares.
 */
class SmartRecruitersMessagesMessagesSharesCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_messages_messages_shares_create";
    protected const DESCRIPTION = "Shares new messages on Hireloop with Users, Hiring Teams or Everyone and sends emails.\n\nOfficial SmartRecruiters endpoint: POST /messages/shares from messages-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Message to post",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/messages/shares";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

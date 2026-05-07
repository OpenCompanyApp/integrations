<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Delete a message.
 *
 * Maps to messages-api.json endpoint DELETE /messages/shares/{id}.
 */
class SmartRecruitersMessagesMessagesSharesDelete extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_messages_messages_shares_delete";
    protected const DESCRIPTION = "Delete a message\n\nOfficial SmartRecruiters endpoint: DELETE /messages/shares/{id} from messages-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "identifier of a message",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/messages/shares/{id}";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

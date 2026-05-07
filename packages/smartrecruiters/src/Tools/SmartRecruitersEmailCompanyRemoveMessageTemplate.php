<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Remove a message template by id..
 *
 * Maps to email-company.json endpoint DELETE /message-templates/{messageTemplateId}.
 */
class SmartRecruitersEmailCompanyRemoveMessageTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_email_company_remove_message_template";
    protected const DESCRIPTION = "Remove a message template by id.\n\nOfficial SmartRecruiters endpoint: DELETE /message-templates/{messageTemplateId} from email-company.json.";
    protected const PARAMETERS = [
        "message_template_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `messageTemplateId`.",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com/message-templates-api";
    protected const PATH = "/message-templates/{messageTemplateId}";
    protected const PATH_PARAMS = [
        "messageTemplateId" => "message_template_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

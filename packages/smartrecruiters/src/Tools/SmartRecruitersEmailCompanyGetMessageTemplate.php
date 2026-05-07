<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get a message template by id..
 *
 * Maps to email-company.json endpoint GET /message-templates/{messageTemplateId}.
 */
class SmartRecruitersEmailCompanyGetMessageTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_email_company_get_message_template";
    protected const DESCRIPTION = "Get a message template by id.\n\nOfficial SmartRecruiters endpoint: GET /message-templates/{messageTemplateId} from email-company.json.";
    protected const PARAMETERS = [
        "message_template_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `messageTemplateId`.",
        ],
    ];
    protected const METHOD = "GET";
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

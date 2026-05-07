<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update Message Template.
 *
 * Maps to email-company.json endpoint PUT /message-templates/{messageTemplateId}.
 */
class SmartRecruitersEmailCompanyUpdateMessageTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_email_company_update_message_template";
    protected const DESCRIPTION = "Update Message Template\n\nOfficial SmartRecruiters endpoint: PUT /message-templates/{messageTemplateId} from email-company.json.";
    protected const PARAMETERS = [
        "message_template_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `messageTemplateId`.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters email-company.json schema for Update Message Template.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/message-templates-api";
    protected const PATH = "/message-templates/{messageTemplateId}";
    protected const PATH_PARAMS = [
        "messageTemplateId" => "message_template_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

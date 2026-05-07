<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create Message Template.
 *
 * Maps to email-company.json endpoint POST /message-templates.
 */
class SmartRecruitersEmailCompanyCreateMessageTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_email_company_create_message_template";
    protected const DESCRIPTION = "Create Message Template\n\nOfficial SmartRecruiters endpoint: POST /message-templates from email-company.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters email-company.json schema for Create Message Template.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/message-templates-api";
    protected const PATH = "/message-templates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

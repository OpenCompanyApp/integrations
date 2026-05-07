<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get Message Templates.
 *
 * Maps to email-company.json endpoint GET /message-templates.
 */
class SmartRecruitersEmailCompanyGetMessageTemplates extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_email_company_get_message_templates";
    protected const DESCRIPTION = "Get Message Templates\n\nOfficial SmartRecruiters endpoint: GET /message-templates from email-company.json.";
    protected const PARAMETERS = [
        "type" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "INTERVIEW_INVITATION",
                    "JOB_OFFER",
                    "REJECTION",
                    "NORMAL_MESSAGE",
                    "NEW_APPLICANT_AUTO_RESPOND",
                    "NEW_INTERNAL_APPLICANT_AUTO_RESPOND",
                    "CAMPAIGN",
                    "SELF_SCHEDULE",
                    "NORMAL_PROSPECT_MESSAGE",
                    "WORKFLOWS_EMAIL_TO_EMPLOYEE",
                    "WORKFLOWS_EMAIL_TO_CANDIDATE",
                    "GROUP_EVENT_INVITATION",
                    "GROUP_EVENT_REMINDER",
                    "SESSION_SELF_SCHEDULE_CONFIRMATION",
                    "SESSION_MANUAL_SCHEDULE_CONFIRMATION",
                    "GROUP_EVENT_CANCELLED",
                    "SESSION_MANUAL_RESCHEDULE_CONFIRMATION",
                    "SESSION_UPDATE",
                    "AUTOMATED_SELF_SCHEDULE_INVITATION",
                    "INTERVIEW_INVITATION_CANCEL_NOTIFICATION",
                    "SELF_SCHEDULE_CANCEL_NOTIFICATION",
                    "INTERVIEW_REMINDER",
                    "INVITATION_TO_SELF_SCHEDULE_UPDATED",
                    "REQUEST_SELF_RESCHEDULE",
                    "AUTOMATED_GROUP_INTERVIEW_INVITATION",
                    "AUTOMATED_GROUP_INTERVIEW_REMINDER",
                    "AUTOMATED_GROUP_INTERVIEW_CONFIRMATION",
                    "GROUP_EVENT_CONFIRMATION",
                ],
            ],
            "required" => false,
            "description" => "query parameter `type`.",
        ],
        "channel" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "EMAIL",
                    "SMS_WHATSAPP",
                ],
            ],
            "required" => false,
            "description" => "query parameter `channel`.",
        ],
        "name" => [
            "type" => "string",
            "required" => false,
            "description" => "query parameter `name`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/message-templates-api";
    protected const PATH = "/message-templates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "type" => "type",
        "channel" => "channel",
        "name" => "name",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

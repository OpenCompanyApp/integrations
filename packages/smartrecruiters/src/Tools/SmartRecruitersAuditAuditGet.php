<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List audit events.
 *
 * Maps to audit-api.json endpoint GET /audit-events.
 */
class SmartRecruitersAuditAuditGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_audit_audit_get";
    protected const DESCRIPTION = "List audit events\n\nOfficial SmartRecruiters endpoint: GET /audit-events from audit-api.json.";
    protected const PARAMETERS = [
        "event_date_after" => [
            "type" => "string",
            "required" => false,
            "description" => "ISO8601-formatted time boundaries for the event time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ (example: 2023-01-21T12:50:02.594Z)",
        ],
        "event_date_before" => [
            "type" => "string",
            "required" => false,
            "description" => "ISO8601-formatted time boundaries for the event time, Format: yyyy-MM-ddTHH:mm:ss.SSSZZ (example: 2023-01-21T12:50:02.594Z)",
        ],
        "event_name" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "USER_ACCOUNT_ACTIVATED",
                    "USER_ACCOUNT_CREATED",
                    "USER_ACCOUNT_DEACTIVATED",
                    "USER_ACCOUNT_UPDATED",
                    "USER_AUTHENTICATION_INVALID_CREDENTIALS",
                    "USER_AUTHENTICATION_SUCCESS",
                    "USER_PASSWORD_CHANGED",
                    "USER_PASSWORD_RESET",
                    "USER_ROLE_CHANGED",
                    "USER_API_KEY_RENEWED",
                    "USER_LOGOUT",
                    "CREDENTIALS_CREATED",
                    "CREDENTIALS_CHANGED",
                    "CREDENTIALS_REVOKED",
                    "SEARCH",
                    "CANDIDATE_PERSONAL_DATA_MODIFIED",
                    "CANDIDATE_PROFILE_MODIFIED",
                    "CANDIDATE_DELETED",
                    "CANDIDATE_PROFILE_OPENED",
                    "CANDIDATE_PROFILE_UPDATED_DUE_TO_MERGE",
                    "CANDIDATE_DELETED_DUE_TO_MERGE",
                    "CANDIDATE_TAGS_MODIFIED",
                    "APPLICATION_PROPERTIES_UPDATED",
                    "APPLICATION_SOURCE_MODIFIED",
                    "ONBOARDING_STATUS_UPDATED",
                    "JOB_APPLICATION_CREATED",
                    "JOB_APPLICATION_STATE_MODIFIED",
                    "JOB_DELETED",
                    "HIRING_TEAM_MEMBER_ADDED",
                    "HIRING_TEAM_MEMBER_REMOVED",
                    "HIRING_TEAM_ROLE_UPDATED",
                    "APPROVAL_DELEGATION_FROM_USER_CREATED",
                    "APPROVAL_DELEGATION_FROM_USER_CANCELLED",
                    "APPROVAL_DELEGATION_TO_USER_CREATED",
                    "APPROVAL_DELEGATION_TO_USER_CANCELLED",
                    "JOB_APPROVAL_REQUESTED",
                    "JOB_APPROVAL_APPROVED",
                    "JOB_APPROVAL_REJECTED",
                    "JOB_APPROVAL_ABANDONED",
                    "JOB_APPROVAL_STEP_APPROVED",
                    "JOB_APPROVAL_STEP_REJECTED",
                    "JOB_APPROVAL_STEP_SKIPPED",
                    "JOB_APPROVAL_STEP_DELEGATED",
                    "OFFER_APPROVAL_APPROVED",
                    "OFFER_APPROVAL_REJECTED",
                    "OFFER_APPROVAL_ABANDONED",
                    "OFFER_APPROVAL_STEP_APPROVED",
                    "OFFER_APPROVAL_STEP_REJECTED",
                    "OFFER_APPROVAL_STEP_SKIPPED",
                    "OFFER_APPROVAL_STEP_DELEGATED",
                    "OFFER_ACCEPTED",
                    "OFFER_DECLINED",
                    "CANDIDATE_EEO_FILLED",
                    "LRSC_CONSENT_GIVEN",
                    "OAUTH_APPLICATION_ACCESS_GRANTED",
                    "JOB_PROPERTY_CREATED",
                    "JOB_PROPERTY_UPDATED",
                    "JOB_PROPERTY_ACTIVATED",
                    "JOB_PROPERTY_DEACTIVATED",
                    "JOB_PROPERTY_UPDATED_VALUES",
                    "JOB_PROPERTY_UPDATED_VALUE",
                    "JOB_PROPERTY_ADDED_VALUE",
                    "JOB_PROPERTY_ARCHIVED_VALUE",
                    "JOB_PROPERTY_DEPENDENT_PROPERTIES_UPDATED",
                    "JOB_PROPERTY_DEPENDENT_VALUES_UPDATED",
                    "JOB_PROPERTY_DEPENDENT_VALUES_MODIFIED",
                    "JOB_PROPERTIES_CHANGED",
                    "POSITION_UPDATED",
                    "POSITION_DELETED",
                    "POSITION_CREATED",
                    "POSITION_ASSIGNED",
                    "CANCEL_NOT_FILLED_POSITION",
                    "JOB_AD_CREATED",
                    "JOB_AD_UPDATED",
                    "JOB_AD_DELETED",
                    "ONBOARDING_PROCESS_DELETED",
                    "CUSTOMER_REPORT_DOWNLOADED",
                    "COMPANY_HIRING_TEAM_ROLE_CREATED",
                    "COMPANY_HIRING_TEAM_ROLE_UPDATED",
                    "COMPANY_HIRING_TEAM_ROLE_DELETED",
                    "COMPANY_HIRING_TEAM_ROLE_ACTIVATION_CHANGED",
                    "EMPLOYEE_FLAG_SET",
                    "EMPLOYEE_FLAG_REMOVED",
                    "EMPLOYEE_BADGE_ASSIGNED",
                    "EMPLOYEE_BADGE_REMOVED",
                    "WEB_SSO_CONFIGURATION_UPDATED",
                ],
            ],
            "required" => false,
            "description" => "Name of the event",
        ],
        "author_type" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "USER",
                    "SUPPORT_USER",
                    "SYSTEM",
                    "CANDIDATE",
                ],
            ],
            "required" => false,
            "description" => "Type of the author who generated the event",
        ],
        "author_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Unique identifier of the author",
        ],
        "entity_type" => [
            "type" => "array",
            "items" => [
                "type" => "string",
                "enum" => [
                    "USER",
                    "CANDIDATE",
                    "APPLICATION",
                    "OFFER",
                    "JOB",
                    "COMPANY",
                    "JOB_PROPERTY",
                    "JOB_AD",
                    "CREDENTIAL",
                    "REPORT_FILE",
                    "ONBOARDING_PROCESS",
                    "HIRING_TEAM_ROLE",
                ],
            ],
            "required" => false,
            "description" => "Type of the entity that the event is related to",
        ],
        "entity_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Unique identifier of the entity that the event is related to",
        ],
        "next_page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Unique identifier for the next page of events",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "Number of audit events to return. Maximum value is 100.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/audit-api/v201910";
    protected const PATH = "/audit-events";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "eventDateAfter" => "event_date_after",
        "eventDateBefore" => "event_date_before",
        "eventName" => "event_name",
        "authorType" => "author_type",
        "authorId" => "author_id",
        "entityType" => "entity_type",
        "entityId" => "entity_id",
        "nextPageId" => "next_page_id",
        "limit" => "limit",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Find all supported notification types along with applicable roles and channels they can be delivered..
 *
 * Maps to notifications-api.json endpoint GET /notification-types.
 */
class SmartRecruitersNotificationsFindAllNotificationTypes extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_notifications_find_all_notification_types";
    protected const DESCRIPTION = "Find all supported notification types along with applicable roles and channels they can be delivered.\n\nOfficial SmartRecruiters endpoint: GET /notification-types from notifications-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/notification-preferences";
    protected const PATH = "/notification-types";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}

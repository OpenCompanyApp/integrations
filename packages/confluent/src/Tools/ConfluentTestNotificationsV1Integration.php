<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Sends a test notification to validate the integration. This is supported only for Webhook, Slack and MsTeams targets
 */
class ConfluentTestNotificationsV1Integration extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_test_notifications_v1_integration';
}

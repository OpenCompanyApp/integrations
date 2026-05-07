<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Remove a notification for the authenticated user. Requires one of the following permissions: - Authentication if no login is provided; - System administration if a login is provided;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/notifications/remove.
 */
class SonarQubeNotificationsRemove extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_notifications_remove';
    protected const DESCRIPTION = 'Remove a notification for the authenticated user. Requires one of the following permissions: - Authentication if no login is provided; - System administration if a login is provided;

Official SonarQube Web API endpoint: POST /api/notifications/remove.';
    protected const PARAMETERS = array (
      'channel' => array (
        'type' => 'string',
        'description' => 'Channel through which the notification is sent. For example, notifications can be sent by email.',
        'required' => false,
        'enum' => array (
          'EmailNotificationChannel',
        ),
      ),
      'login' => array (
        'type' => 'string',
        'description' => 'User login',
        'required' => false,
      ),
      'project' => array (
        'type' => 'string',
        'description' => 'Project key',
        'required' => false,
      ),
      'type' => array (
        'type' => 'string',
        'description' => 'Notification type. Possible values are for: - Global notifications: CeReportTaskFailure, ChangesOnMyIssue, NewAlerts, QualityGateConditionsMismatch, SQ-MyNewIssues; - Per project notifications: CeReportTaskFailure, ChangesOnMyIssue, NewAlerts, NewFalsePositiveIssue, NewIssues, SQ-MyNewIssues;',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/api/notifications/remove';
    protected const PARAM_MAP = array (
      'channel' => 'channel',
      'login' => 'login',
      'project' => 'project',
      'type' => 'type',
    );
}

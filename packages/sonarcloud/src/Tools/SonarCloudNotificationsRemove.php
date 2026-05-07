<?php

namespace OpenCompany\Integrations\SonarCloud\Tools;

/**
 * Remove a notification for the authenticated user.
 *
 * Maps to the official SonarCloud Web API endpoint POST /api/notifications/remove.
 */
class SonarCloudNotificationsRemove extends AbstractSonarCloudTool
{
    protected const NAME = 'sonarcloud_notifications_remove';
    protected const DESCRIPTION = 'Remove a notification for the authenticated user

Official SonarCloud Web API endpoint: POST /api/notifications/remove.';
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
        'description' => 'Notification type. Possible values are for: - Global notifications: CeReportTaskFailure, ChangesOnMyIssue, SQ-MyNewIssues; - Per project notifications: CeReportTaskFailure, ChangesOnMyIssue, NewAlerts, NewFalsePositiveIssue, NewIssues, SQ-MyNewIssues;',
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

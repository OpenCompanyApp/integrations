<?php

namespace OpenCompany\Integrations\SonarQube\Tools;

/**
 * Add a notification for the authenticated user. Requires one of the following permissions: - Authentication if no login is provided. If a project is provided, requires the 'Browse' permission on the specified project.; - System administration if a login is provided. If a project is provided, requires the 'Browse' permission on the specified project.;.
 *
 * Maps to the official SonarQube Web API endpoint POST /api/notifications/add.
 */
class SonarQubeNotificationsAdd extends AbstractSonarQubeTool
{
    protected const NAME = 'sonarqube_notifications_add';
    protected const DESCRIPTION = 'Add a notification for the authenticated user. Requires one of the following permissions: - Authentication if no login is provided. If a project is provided, requires the \'Browse\' permission on the specified project.; - System administration if a login is provided. If a project is provided, requires the \'Browse\' permission on the specified project.;

Official SonarQube Web API endpoint: POST /api/notifications/add.';
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
    protected const PATH = '/api/notifications/add';
    protected const PARAM_MAP = array (
      'channel' => 'channel',
      'login' => 'login',
      'project' => 'project',
      'type' => 'type',
    );
}

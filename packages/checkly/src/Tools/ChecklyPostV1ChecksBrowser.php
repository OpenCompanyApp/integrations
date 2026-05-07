<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new browser check. Will return a `402` when you are over the limit of your plan. When using the `globalAlertSetting`, the `alertSetting` can be `null`.
 *
 * Maps to the official Checkly endpoint POST /v1/checks/browser.
 */
class ChecklyPostV1ChecksBrowser extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_checks_browser';
    protected const DESCRIPTION = 'Creates a new browser check. Will return a `402` when you are over the limit of your plan. When using the `globalAlertSetting`, the `alertSetting` can be `null`

Official Checkly endpoint: POST /v1/checks/browser.';
    protected const PARAMETERS = array (
      'auto_assign_alerts' => array (
        'type' => 'boolean',
        'description' => 'Determines whether a new check will automatically be added as a subscriber to all existing alert channels when it gets created.',
        'required' => false,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/checks/browser';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'autoAssignAlerts' => 'auto_assign_alerts',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Generate a widget token.
 *
 * Maps to the official WorkOS endpoint post /widgets/token.
 */
class WorkOSWidgetsPublicIssueWidgetSessionToken extends AbstractWorkOSTool
{
    protected const NAME = 'workos_widgets_public_issue_widget_session_token';
    protected const DESCRIPTION = 'Generate a widget token

Official WorkOS endpoint: POST /widgets/token

Generate a widget token scoped to an organization and user with the specified scopes.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/widgets/token';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

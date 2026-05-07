<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Get a user's delegation.
 *
 * Generated PagerDuty REST API tool for GET /users/{id}/oauth_delegations/{delegation_id}.
 */
class PagerdutyGetUserDelegation extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_user_delegation';
}
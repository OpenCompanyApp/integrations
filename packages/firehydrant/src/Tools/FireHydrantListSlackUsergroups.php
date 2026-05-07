<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List Slack user groups.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/slack/usergroups.
 */
class FireHydrantListSlackUsergroups extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_slack_usergroups';
    protected const DESCRIPTION = 'List Slack user groups

Official FireHydrant endpoint: GET /v1/integrations/slack/usergroups

Lists all Slack user groups';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/slack/usergroups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

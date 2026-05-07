<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Legacy alias for getting the authenticated Kit account.
 */
class ConvertKitGetCurrentUser extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_get_current_user';
    protected const TOOL_DESCRIPTION = 'Legacy alias for getting the authenticated Kit account.';
    protected const METHOD = 'GET';
    protected const PATH = '/account';
    protected const PATH_KEYS = [];
    protected const QUERY_KEYS = [];
    protected const BODY_KEYS = [];
    protected const PARAMETERS = [];
    protected const DYNAMIC_PATH = false;
}

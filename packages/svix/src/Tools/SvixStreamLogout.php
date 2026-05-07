<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Stream Logout using the official Svix API.
 */
class SvixStreamLogout extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.authentication.stream-logout';
}

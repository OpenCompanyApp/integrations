<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Logout using the official Svix API.
 */
class SvixLogout extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.authentication.logout';
}

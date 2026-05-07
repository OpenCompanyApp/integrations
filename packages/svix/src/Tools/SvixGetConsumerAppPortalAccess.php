<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Consumer App Portal Access using the official Svix API.
 */
class SvixGetConsumerAppPortalAccess extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.authentication.app-portal-access';
}

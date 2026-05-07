<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Integration Key using the official Svix API.
 */
class SvixGetIntegrationKey extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.integration.get-key';
}

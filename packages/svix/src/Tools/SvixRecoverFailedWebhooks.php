<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Recover Failed Webhooks using the official Svix API.
 */
class SvixRecoverFailedWebhooks extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.recover';
}

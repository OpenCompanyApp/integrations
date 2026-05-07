<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Rotate Integration Key using the official Svix API.
 */
class SvixRotateIntegrationKey extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.integration.rotate-key';
}

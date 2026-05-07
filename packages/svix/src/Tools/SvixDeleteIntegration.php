<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Integration using the official Svix API.
 */
class SvixDeleteIntegration extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.integration.delete';
}

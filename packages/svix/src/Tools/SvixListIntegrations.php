<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Integrations using the official Svix API.
 */
class SvixListIntegrations extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.integration.list';
}

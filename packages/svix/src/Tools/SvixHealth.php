<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Health using the official Svix API.
 */
class SvixHealth extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.health.get';
}

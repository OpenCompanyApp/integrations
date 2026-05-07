<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Import Environment Configuration using the official Svix API.
 */
class SvixImportEnvironmentConfiguration extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.environment.import';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Export Environment Configuration using the official Svix API.
 */
class SvixExportEnvironmentConfiguration extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.environment.export';
}

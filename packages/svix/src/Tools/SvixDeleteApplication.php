<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Application using the official Svix API.
 */
class SvixDeleteApplication extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.application.delete';
}

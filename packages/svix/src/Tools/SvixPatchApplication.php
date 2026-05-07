<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Application using the official Svix API.
 */
class SvixPatchApplication extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.application.patch';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Applications using the official Svix API.
 */
class SvixListApplications extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.application.list';
}

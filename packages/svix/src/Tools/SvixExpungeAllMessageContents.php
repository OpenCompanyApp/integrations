<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Expunge all message contents using the official Svix API.
 */
class SvixExpungeAllMessageContents extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.expunge-all-contents';
}

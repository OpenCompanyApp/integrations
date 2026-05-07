<?php

namespace OpenCompany\Integrations\Crisp\Tools;

/**
 * Flush Last Active Website Operators using the official Crisp REST API.
 */
class CrispFlushLastActiveWebsiteOperators extends AbstractCrispOperationTool
{
    protected const OPERATION = 'flush_last_active_website_operators';
}

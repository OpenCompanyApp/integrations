<?php

namespace OpenCompany\Integrations\Akismet\Tools;

/**
 * Retrieve monthly API usage and throttling status.
 */
class AkismetUsageLimit extends AbstractAkismetTool
{
    protected const NAME = 'akismet_usage_limit';
    protected const DESCRIPTION = 'Retrieve current-month Akismet usage, limit, percentage, and throttling status.';
    protected const METHOD = 'usageLimit';
}

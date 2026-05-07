<?php

namespace OpenCompany\Integrations\Appetize\Tools;

/** Get Appetize usage summary. */
class AppetizeGetUsageSummary extends AbstractAppetizeTool { protected const NAME = 'appetize_get_usage_summary'; protected const DESCRIPTION = 'Get Appetize account usage summary with optional nextKey and startMonth query values.'; protected const METHOD = 'getUsageSummary'; protected const USE_QUERY = true; }

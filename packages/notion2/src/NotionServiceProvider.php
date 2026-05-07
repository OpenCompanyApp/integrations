<?php

namespace OpenCompany\Integrations\Notion2;

/**
 * Legacy alias for the canonical Notion service provider.
 *
 * Loading this package registers the maintained `notion` integration instead
 * of a duplicate `notion2` catalog entry.
 */
class NotionServiceProvider extends \OpenCompany\Integrations\Notion\NotionServiceProvider
{
}

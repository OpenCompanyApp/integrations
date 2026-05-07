<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Execute a safe relative BrowserStack API GET call. */
class BrowserStackApiGet extends AbstractBrowserStackTool { protected const NAME = 'browserstack_api_get'; protected const DESCRIPTION = 'Call a safe relative BrowserStack GET path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiGet'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }

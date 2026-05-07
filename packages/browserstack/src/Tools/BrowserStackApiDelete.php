<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Execute a safe relative BrowserStack API DELETE call. */
class BrowserStackApiDelete extends AbstractBrowserStackTool { protected const NAME = 'browserstack_api_delete'; protected const DESCRIPTION = 'Call a safe relative BrowserStack DELETE path for endpoints not covered by first-class tools.'; protected const METHOD = 'apiDelete'; protected const ARGUMENTS = ['path']; protected const USE_QUERY = true; }

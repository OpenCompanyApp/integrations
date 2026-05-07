<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** List BrowserStack Automate builds. */
class BrowserStackListBuilds extends AbstractBrowserStackTool { protected const NAME = 'browserstack_list_builds'; protected const DESCRIPTION = 'List BrowserStack Automate builds with optional limit, offset, status, or projectId filters.'; protected const METHOD = 'listBuilds'; protected const USE_QUERY = true; }

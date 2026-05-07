<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Delete multiple BrowserStack Automate builds. */
class BrowserStackDeleteBuilds extends AbstractBrowserStackTool { protected const NAME = 'browserstack_delete_builds'; protected const DESCRIPTION = 'Delete multiple BrowserStack Automate builds using buildId query values.'; protected const METHOD = 'deleteBuilds'; protected const REQUIRED = ['query']; protected const USE_QUERY = true; }

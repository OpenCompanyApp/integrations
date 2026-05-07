<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** List recently uploaded BrowserStack App Automate apps. */
class BrowserStackListRecentApps extends AbstractBrowserStackTool { protected const NAME = 'browserstack_list_recent_apps'; protected const DESCRIPTION = 'List recently uploaded App Automate apps, optionally filtered by custom_id.'; protected const METHOD = 'listRecentApps'; protected const ARGUMENTS = ['custom_id']; protected const OPTIONAL = ['custom_id']; }

<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** List sessions in a BrowserStack Automate build. */
class BrowserStackListBuildSessions extends AbstractBrowserStackTool { protected const NAME = 'browserstack_list_build_sessions'; protected const DESCRIPTION = 'List BrowserStack Automate sessions in a build.'; protected const METHOD = 'listBuildSessions'; protected const ARGUMENTS = ['build_id']; protected const USE_QUERY = true; }

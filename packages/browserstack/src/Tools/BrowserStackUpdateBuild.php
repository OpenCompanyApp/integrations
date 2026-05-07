<?php

namespace OpenCompany\Integrations\BrowserStack\Tools;

/** Update a BrowserStack Automate build. */
class BrowserStackUpdateBuild extends AbstractBrowserStackTool { protected const NAME = 'browserstack_update_build'; protected const DESCRIPTION = 'Update BrowserStack Automate build name or build_tag.'; protected const METHOD = 'updateBuild'; protected const ARGUMENTS = ['build_id']; protected const REQUIRED = ['build_id', 'payload']; protected const USE_PAYLOAD = true; }
